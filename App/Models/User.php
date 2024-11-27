<?php

namespace TomTroc\App\Models;

class User extends AbstractEntity
{
    private string $pseudo;
    private string $password;
    private string $email;
    private string $photo;
    private ?\DateTime $dateCreation;

    public function setPseudo(string $pseudo) : void
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo() : string
    {
        return $this->pseudo;
    }

    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setPhoto(string $photo = null) : void
    {
        if (isset($photo))
        {
            $this->photo = $photo;
        }
        else
        {
            $this->photo = "";
        }
    }

    public function getPhoto() : string
    {
        return $this->photo;
    }

    public function setDateCreationDateTime(\DateTime $dateCreation) : void
    {
        $this->dateCreation = $dateCreation;
    }
    
    public function setDateCreation(string $dateCreation) : void
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $dateCreation);
        $this->dateCreation = $dateTime;
    }

    public function getDateCreation() : string
    {
        return $this->dateCreation->format('Y-m-d H:i:s');
    }
}