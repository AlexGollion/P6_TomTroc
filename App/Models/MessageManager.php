<?php

namespace TomTroc\App\Models;

class MessageManager extends AbstractEntityManager
{
    public function getAllConversation(int $id): array
    {
        $sqlPivot = "SELECT * FROM conversation C 
            INNER JOIN pivot_conversation P ON C.id = P.id_conversation 
            WHERE P.id_user = :id";
        $res = $this->db->query($sqlPivot, ['id' => $id]);

        $return = [];

        while ($data = $res->fetch())
        {
            $conversation = new Conversation();
            $conversation->setId($data['id']);
            $conversation->setNom($data['nom']);

            $sqlMsg = "SELECT * FROM conversation C 
                INNER JOIN Message M ON C.id = M.conversation_id
                WHERE M.conversation_id = :id";
            $messageData = $this->db->query($sqlMsg, ['id' => $data['id']]);
            while ($message = $messageData->fetch())
            {
                $temp = $this->createMessage($message);
                if (!empty($temp))
                {
                    $conversation->addMessage($temp);
                }
            }
            
            $sqlUser = "SELECT id_user FROM pivot_conversation WHERE id_conversation = :id";
            $userId = $this->db->query($sqlMsg, ['id' => $data['id']]);
            while ($user = $userId->fetch())
            {
                $temp = $this->getUser($user);
                if (!empty($temp))
                {
                    $conversation->addUser($temp);
                }
            }

            array_push($return, $conversation);
        }

        return $return;
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
        $user = $userManager->getUserById($data['id']);
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

    public function getConversationById(int $idConv) : Conversation
    {
        $conversation = new Conversation();
        $conversation->setId($idConv);

        $sqlMsg = "SELECT * FROM conversation C 
            INNER JOIN Message M ON C.id = M.conversation_id
            WHERE M.conversation_id = :id";
        $messageData = $this->db->query($sqlMsg, ['id' => $idConv]);
        while ($message = $messageData->fetch())
        {
            $temp = $this->createMessage($message);
            if (!empty($temp))
            {
                $conversation->addMessage($temp);
            }
        }
            
        $sqlUser = "SELECT id_user FROM pivot_conversation WHERE id_conversation = :id";
        $userId = $this->db->query($sqlMsg, ['id' => $idConv]);
        while ($user = $userId->fetch())
        {
            $temp = $this->getUser($user);
            if (!empty($temp))
            {
                $conversation->addUser($temp);
            }
        }

        return $conversation;
    }
}