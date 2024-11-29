<?php

namespace TomTroc\App\Models;

class LivreManager extends AbstractEntityManager
{
    public function addLivre(Livre $newLivre) : void
    {
        $sql = "INSERT INTO livre (titre, auteur, image, description, statut, user_id) VALUES (:titre, :auteur, :image, :description, :statut, :user_id)";
        $this->db->query($sql, [
            'titre' => $newLivre->getTitre(),
            'auteur' => $newLivre->getAuteur(),
            'image' => $newLivre->getImage(),
            'description' => $newLivre->getDescription(),
            'statut' => $newLivre->getStatut(),
            'user_id' => $newLivre->getUserId()
        ]);
    }

    public function getAllLivres() : array
    {
        $sql = "SELECT * FROM livre";
        $result = $this->db->query($sql);
        $livres = $result->fetchAll();
        return $livres;
    }
}