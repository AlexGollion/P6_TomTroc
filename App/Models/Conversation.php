<?php

namespace TomTroc\App\Models;


class Conversation extends AbstractEntity
{
    private $users = [];
    private $messages = [];
    private string $nom;

    public function addUser(User $user) : void
    {
        array_push($this->users, $user);
    }

    public function getUsers() : array
    {
        return $this->users;
    }

    public function addMessage(Message $message) : void
    {
        array_push($this->messages, $message);
    }

    public function getMessages() : array
    {
        return $this->messages;
    }

    public function setNom(string $nom) : void
    {
        $this->nom = $nom;
    }

    public function getNom() : string
    {
        return $this->nom;
    }
    
    /*public function getLastMessage() : Message
    {
        
    }*/
}