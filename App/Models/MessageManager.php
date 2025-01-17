<?php

namespace TomTroc\App\Models;
use TomTroc\Services as Services;

class MessageManager extends AbstractEntityManager
{
    /**
     * Permet de récupérer toutes les conversations d'un utilisateur
     * @param int $userId: id de l'utilisateur
     * @param ?int $idSelectedConv: id de la conversation selectionné, peut etre null
     * @return array: liste de toutes les conversations
     */
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

    /**
     * Permet de récupérer le dernier message d'une conversation
     * @param int $idConv: id de la conversation
     * @return ?Message: le dernier message, null si aucun message dans la conversation
     */
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

    /**
     * Permet de récupérer tous les messages d'une conversation
     * @param Conversation $conv: conversation dont on veux les messages
     * @return Conversation: la conversation avec tous les messages
     */
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

    /**
     * Permet de créer une conversation
     * @param array $users: les utilisateurs de la conversation
     * @return void
     */
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

    /**
     * Permet de savoir si une conversation existe
     * @param int $idUser1: id du premier utilisateur
     * @param int $idUser2: id du second utilisateur
     * @return int: retourne -1 si la conversation n'éxiste pas, sinon reoturne l'id de la conversation
     */
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

    /**
     * Permet d'envoyer un message
     * @param Message $message: mesage à envoyer
     * @return void
     */
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

    /**
     * Permet de récupérer l'id de la dernière conversation d'un utilisateur
     * @param int $userId: id de l'utilisateur
     * @return int: id de la dernière conversation
     */
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

    /**
     * Permet de récupérer le nombre de message non lu d'un utilisateur
     * @param int $userId: id de l'utilisateur
     * @return int: nombre de message non lu
     */
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

    /**
     * Permet de mettre à jour la lecture d'un message
     * @param int $idUser: id de l'utilisateur
     * @param int $idConv: id de la conversation
     * @return void
     */
    public function updateReadMessage(int $idUser, int $idConv) : void
    {
        $sql = "UPDATE message SET read_statut = true WHERE conversation_id = :conversation_id AND id_expediteur != :idUser";
        $this->db->query($sql, ["conversation_id" => $idConv, "idUser" => $idUser]);
    }
}