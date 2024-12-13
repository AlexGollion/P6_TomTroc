<?php

namespace TomTroc\App\Models;

class Livre extends AbstractEntity
{
    private string $titre;
    private string $auteur;
    private string $image;
    private string $description;
    private bool $statut;
    private int $userId;

    public function setTitre(string $titre) : void
    {
        $this->titre = $titre;
    }

    public function getTitre() : string
    {
        return $this->titre;
    }

    public function setAuteur(string $auteur) : void
    {
        $this->auteur = $auteur;
    }

    public function getAuteur() : string
    {
        return $this->auteur;
    }

    public function setImage(string $image) : void
    {
        $this->image = $image;
    }

    public function getImage() : string
    {
        return $this->image;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setStatut(bool $statut) : void
    {
        $this->statut = $statut;
    }

    public function getStatut() : string
    {
        if ($this->statut)
        {
            return "disponible";
        }
        else
        {
            return "non dispo.";
        }
    }

    public function getStatutBool() : bool
    {
        return $this->statut;
    }
    
    public function setUserId(int $userId) : void
    {
        $this->userId = $userId;
    }

    public function getUserId() : int
    {
        return $this->userId;
    }
}