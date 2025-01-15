<?php

namespace TomTroc\App\Models;
use TomTroc\Services as Services;

class MessageManager extends AbstractEntityManager
{
    public function getAllConversation(int $userId, ?int $idSelectedConv): array
    {
        $sqlPivot = "SELECT * FROM conversation C 
            INNER JOIN pivot_conversation P ON C.id = P.id_conversation 
            WHERE P.id_user = :id";
        $res = $this->db->query($sqlPivot, ['id' => $userId]);

        $return = [];

        while ($data = $res->fetch())
        {
            $conversation = new Conversation();
            $conversation->setId($data['id']);
            $conversation->setNom($data['nom']);

            if ($conversation->getId() == $idSelectedConv)
            {
                $conversation = $this->getAllMessages($conversation);
            }
            else
            {
                $lastMessageConv = $this->lastMessage($conversation->getId());
                if(isset($lastMessageConv))
                {
                    $conversation->addMessage($lastMessageConv);
                }
            }

            
            $sqlUser = "SELECT id_user FROM pivot_conversation WHERE id_conversation = :id";
            $userId = $this->db->query($sqlUser, ['id' => $data['id']]);
            while ($id = $userId->fetch())
            {
                $temp = $this->getUser($id);
                if (!empty($temp))
                {
                    $conversation->addUser($temp);
                }
            }

            array_push($return, $conversation);
        }

        return $return;
    }

    private function lastMessage(int $idConv) : ?Message
    {
        $sql = "SELECT * FROM Message M INNER JOIN Conversation C ON C.id = M.conversation_id WHERE M.conversation_id = :id
            ORDER BY M.date_creation DESC LIMIT 1";
        $res = $this->db->query($sql, ["id" => $idConv]);
        $dataMessage = $res->fetch();
        if(empty($dataMessage))
        {
            return null;
        }
        else
        {
            $message = $this->createMessage($dataMessage);
            return $message;
        }
    }

    private function getAllMessages(Conversation $conv) : Conversation
    {
        $sql = "SELECT * FROM Message M INNER JOIN Conversation C ON C.id = M.conversation_id WHERE M.conversation_id = :id
            ORDER BY M.date_creation DESC ";
        $res = $this->db->query($sql, ["id" => $conv->getId()]);
        while ($dataMessage =  $res->fetch())
        {
            $message = $this->createMessage($dataMessage);
            $conv->addMessage($message);
        }
        return $conv;
    }

    private function createMessage(array $data) : Message
    {
        $message = new Message();
        $message->setId($data['id']);
        $message->setContent($data['content']);
        $message->setDateCreationString($data['date_creation']);
        $message->setExpediteurId($data['id_expediteur']);
        $message->setConversationId($data['conversation_id']);
        return $message;
    }

    private function getUser(array $data) : ?User
    {
        $userManager = new UserManager();
        $user = $userManager->getUserById($data['id_user']);
        return $user;
    }

    public function createConversation(array $users) : void
    {
        $sqlConv = "INSERT INTO conversation (nom) VALUES (:nom)";
        $this->db->query($sqlConv, [
            'nom' => $this->createNameConversation($users),
        ]);
        $sqlPivot = "INSERT INTO pivot_conversation (id_conversation, id_user) VALUES (LAST_INSERT_ID(), :id)";
        $i = 0;
        while ($i < count($users))
        {
            $this->db->query($sqlPivot, [
                'id' => $users[$i]->getId(),
            ]);
            $i++;
        }
    }

    private function createNameConversation(array $users) : string
    {
        $i = 0;
        $res = "";
        while ($i < count($users))
        {
            $res = $res . $users[$i]->getPseudo();
            if (!($i < (count($users) - 1)))
            {
                $res = $res . "_";
            }
            $i++;
        }
        return $res;
    }

    public function checkIfConvExist(int $idUser1, int $idUser2) : int
    {
        $sql = "SELECT id_conversation FROM pivot_conversation WHERE id_user = :id";
        $resUser1 = $this->db->query($sql, ['id' => $idUser1]);
        $resUser2 = $this->db->query($sql, ['id' => $idUser2]);
        $dataUser1 = $resUser1->fetchAll();
        $dataUser2 = $resUser2->fetchAll();
        $id = -1;
        foreach ($dataUser1 as $user1) 
        {
            foreach ($dataUser2 as $user2)
            {
                if ($user1['id_conversation'] == $user2['id_conversation'])
                {
                    $id = $user1['id_conversation'];
                }
            }
        }
        return $id;
    }

    public function sendMessage(Message $message) : void
    {
        $sql = "INSERT INTO message (content, date_creation, conversation_id, id_expediteur) VALUES (:content, :date_creation, :conversation_id, :id_expediteur)";
        $this->db->query($sql, [
            'content' => $message->getContent(),
            'date_creation' => $message->getDateCreation(),
            'conversation_id' => $message->getConversationId(),
            'id_expediteur' => $message->getExpediteurId()
        ]);
    }

    public function getLastConversationId(int $userId) : int
    {
        $sqlPivot = "SELECT * FROM conversation C 
            INNER JOIN pivot_conversation P ON C.id = P.id_conversation 
            WHERE P.id_user = :id";
        $res = $this->db->query($sqlPivot, ['id' => $userId]);

        $return = [];

        while ($data = $res->fetch())
        {
            $conversation = new Conversation();
            $conversation->setId($data['id']);
            $lastMessageConv = $this->lastMessage($conversation->getId());
            if(isset($lastMessageConv))
            {
                $dateMessage = \DateTime::createFromFormat('Y-m-d H:i:s', $lastMessageConv->getDateCreation());
            }
            else
            {
                $dateMessage = null;
            }

            array_push($return, ["idConv" => $conversation->getId(), "dateMessage" => $dateMessage]);
        }

        usort($return, function($a, $b) {
            return $a["dateMessage"]<=>$b["dateMessage"];
        });

        if(empty($return))
        {
            return -1;
        }
        else
        {
            return $return[0]["idConv"];
        }
    }

    public function headerMessagerie(int $userId) : int
    {
        $sql = "SELECT COUNT(M.id) as nbMessage FROM conversation C 
            INNER JOIN pivot_conversation P ON C.id = P.id_conversation 
            INNER JOIN message M ON M.conversation_id = C.id
            WHERE P.id_user = :id AND M.read_statut = false AND M.id_expediteur != :id";
        $res = $this->db->query($sql, ['id' => $userId]);
        $nbMessage = $res->fetch();
        return $nbMessage["nbMessage"];
    }

    public function updateReadMessage(int $idUser, int $idConv) : void
    {
        $sql = "UPDATE message SET read_statut = true WHERE conversation_id = :conversation_id AND id_expediteur != :idUser";
        $this->db->query($sql, ["conversation_id" => $idConv, "idUser" => $idUser]);
    }
}