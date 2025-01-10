<?php

namespace TomTroc\App\Models;

class Message extends AbstractEntity
{
    private string $content;
    private ?\DateTime $dateCreation;
    private int $expediteurId;
    private int $conversationId;

    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setDateCreation(\DateTime $dateCreation) : void
    {
        $this->dateCreation = $dateCreation;
    }

    public function setDateCreationString(string $dateCreation) : void
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $dateCreation);
        $this->dateCreation = $dateTime;
    }

    public function getDateCreation() : string
    {
        return $this->dateCreation->format('Y-m-d H:i:s');
    }
   
    public function getDateCreationDateTime() : \DateTime
    {
        return $this->dateCreation;
    }

    public function setExpediteurId(int $expediteurId) : void
    {
        $this->expediteurId = $expediteurId;
    }

    public function getExpediteurId() : int
    {
        return $this->expediteurId;
    }
    
    public function setConversationId(int $conversationId) : void
    {
        $this->conversationId = $conversationId;
    }

    public function getConversationId() : int
    {
        return $this->conversationId;
    }
}