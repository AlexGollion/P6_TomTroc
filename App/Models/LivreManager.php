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
        $sql = "SELECT L.auteur, L.titre, L.id, L.image, U.pseudo FROM livre L INNER JOIN user U ON L.user_id = U.id;";
        $result = $this->db->query($sql);
        $livres = [];
        while ($data = $result->fetch())
        {
            $livre = new Livre($data);
            array_push($livres, ["livre" => $livre, "user" => $data["pseudo"]]);
        }
        return $livres;
    }

    public function getLivresByUserId(int $userId) : array
    {
        $sql = "SELECT * FROM livre WHERE user_id = :user_id";
        $result = $this->db->query($sql, ['user_id' => $userId]);
        $livres = [];
        while ($data = $result->fetch())
        {
            $livre = new Livre($data);
            array_push($livres, $livre);
        }
        return $livres;
    }

    public function getLivreById(int $id) : ?Livre
    {
        $sql = "SELECT * FROM livre WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $res = $result->fetch();
        if ($res)
        {
            $livre = new Livre($res);
            return $livre;
        }
        return null;
    }

    public function getLivreAndUserById(int $id) : array
    {
        $sql = "SELECT L.id as livre_id, titre, auteur, description, image, U.id as user_id, pseudo, photo  FROM livre L INNER JOIN user U on L.user_id = U.id
            WHERE L.id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $res = $result->fetch();
        $data = [];
        if ($res)
        {
            $livre = new Livre($res);
            $user = new User($res);
            $livre->setId($res["livre_id"]);
            $user->setId($res["user_id"]);
            array_push($data, ["user" => $user, "livre" => $livre]);
            return $data;
        }
        return null;
    }

    public function deleteLivreById(int $id) : void
    {
        $sql = "DELETE FROM livre WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    public function updateLivre(Livre $livre) : void
    {
        $sql = "UPDATE livre SET titre = :titre, auteur = :auteur, image = :image, description = :description, statut = :statut WHERE id = :id";
        $this->db->query($sql, [
            'titre' => $livre->getTitre(),
            'auteur' => $livre->getAuteur(),
            'image' => $livre->getImage(),
            'description' => $livre->getDescription(),
            'statut' => $livre->getStatut(),
            'id' => $livre->getId()
        ]);
    }
}