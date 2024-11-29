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
}

?>