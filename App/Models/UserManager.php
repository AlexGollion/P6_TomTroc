<?php

namespace TomTroc\App\Models;

class UserManager extends AbstractEntityManager
{
    public function createUser(User $user) : void
    {
        $sql = "INSERT INTO user (pseudo, email, password, date_creation) VALUES (:pseudo, :email, :password, :date_creation)";
        $this->db->query($sql, [
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'date_creation' => $user->getDateCreation()
        ]);
    }

    public function getUserByLogin(string $pseudo) : ?User
    {
        $sql = "SELECT * FROM user WHERE pseudo = :pseudo";
        $result = $this->db->query($sql, ['pseudo' => $pseudo]);
        $user = $result->fetch();
        if ($user)
        {
            return new User($user);
        }
        return null;
    }
    
    public function getUserById(int $id) : ?User
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $user = $result->fetch();
        if ($user)
        {
            return new User($user);
        }
        return null;
    }

    public function updateUser(int $id, string $pseudo = null, string $password = null, string $image = null, string $email = null) : void
    {
        $nbParams = $this->compteInfo([$pseudo, $password, $image, $email]);
        $sql = "UPDATE user SET ";
        $sql .= $this->checkInfo(["pseudo" => $pseudo, "password" => $password, "photo" => $image, "email" => $email], $nbParams);
        $sql = $sql . " WHERE id = :id";
        $dataSql = [];
        $dataSql = $this->addInfo(["pseudo" => $pseudo, "password" => $password, "photo" => $image, "email" => $email]);
        $dataSql['id'] = $id;
        echo $sql;

        $this->db->query($sql, $dataSql);
        
    }

    private function compteInfo(array $params) : int
    {
        $res = 0;
        foreach($params as $index => $data)
        {
            if (!($data == null))
            {
                $res++;
            }
        }
        return $res;
    }

    private function checkInfo(array $data, int $nbParams) : string
    {
        $res = ""; 
        $i = 0;
        foreach($data as $key => $newData)
        {
            if (!($newData == null))
            {
                $res .= $key . " = :" . $key;
                $i++;
                if ($i < $nbParams)
                {
                    $res .= ", ";
                }
                else if ($i == $nbParams)
                {
                    $res .= " ";
                }
            }
        }
        return $res;
    }

    private function addInfo(array $data) : array
    {
        $res = []; 
        foreach($data as $key => $newData)
        {
            if (!($newData == null))
            {
                $res[$key] = $newData;
            }
        }
        return $res;
    }
}

?>