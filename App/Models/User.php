<?php

class User extends AbstractEntity
{
    private string $pseudo;
    private string $password;
    private string $email;
    private string $photo;
    private ?DateTime $dateCreation;

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

    public function setPhoto(string $photo) : void
    {
        $this->photo = $photo;
    }

    public function getPhoto() : string
    {
        return $this->photo;
    }

    public function setDateCreation(DateTime $dateCreation) : void
    {
        $this->dateCreation = $dateCreation;
    }

    public function getDateCreation() : DateTime
    {
        return $this->dateCreation;
    }
}