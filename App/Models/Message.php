<?php

class Message extends AbstractEntity
{
    private string $content;
    private ?DateTime $dateCreation;
    private int $expediteurId;
    private int $destinataireId;

    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setDateCreation(DateTime $dateCreation) : void
    {
        $this->dateCreation = $dateCreation;
    }

    public function getDateCreation() : DateTime
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
    
    public function setDestinataireId(int $destinataireId) : void
    {
        $this->destinataireId = $destinataireId;
    }

    public function getDestinataireId() : int
    {
        return $this->destinataireId;
    }
}