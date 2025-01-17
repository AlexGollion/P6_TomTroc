<?php

namespace TomTroc\App\Models;

class LivreManager extends AbstractEntityManager
{
    /**
     * Créer un nouveau livre
     * @param Livre $newLivre: le nouveau livre à ajouter
     * @return void
     */
    public function addLivre(Livre $newLivre) : void
    {
        $sql = "INSERT INTO livre (titre, auteur, image, description, statut, user_id, date_creation)
            VALUES (:titre, :auteur, :image, :description, :statut, :user_id, :date_creation)";
        $this->db->query($sql, [
            'titre' => $newLivre->getTitre(),
            'auteur' => $newLivre->getAuteur(),
            'image' => $newLivre->getImage(),
            'description' => $newLivre->getDescription(),
            'statut' => $newLivre->getStatutBool(),
            'user_id' => $newLivre->getUserId(),
            'date_creation' => $newLivre->getDateCreation()
        ]);
    }

    /**
     * Récupère tous les livres
     * @return array: liste de tous les livres
     */
    public function getAllLivres() : array
    {
        $sql = "SELECT L.auteur, L.titre, L.id, L.image, U.pseudo FROM livre L INNER JOIN user U ON L.user_id = U.id";
        $result = $this->db->query($sql);
        $livres = [];
        while ($data = $result->fetch())
        {
            $livre = new Livre($data);
            array_push($livres, ["livre" => $livre, "user" => $data["pseudo"]]);
        }
        return $livres;
    }

    /**
     * Permet de récupérer tous livres d'un utilisateur
     * @param int $userId: id de l'utilisateur
     * @return array: liste de tous les livres de cet utilisateur
     */
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

    /**
     * Permet de récupérer un livre par son id
     * @param int $id: id du livre à récupérer
     * @return ?Livre : retourne le livre si il éxiste, sinon retourne null
     */
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

    /**
     * Permet de récupérer un livre et son utilisateur
     * @param int $id: id du livre à récupérer
     * @return array: livre et utilisateur 
     */
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

    /**
     * Permet de supprimer un livre
     * @param int $id: id du livre à supprimer 
     * @return void
     */
    public function deleteLivreById(int $id) : void
    {
        $sql = "DELETE FROM livre WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Permet de mettre à jour un livre
     * @param Livre $livre: nouvelle informations du livre
     * @return void
     */
    public function updateLivre(Livre $livre) : void
    {
        $sql = "UPDATE livre SET titre = :titre, auteur = :auteur, image = :image, description = :description, statut = :statut WHERE id = :id";
        $this->db->query($sql, [
            'titre' => $livre->getTitre(),
            'auteur' => $livre->getAuteur(),
            'image' => $livre->getImage(),
            'description' => $livre->getDescription(),
            'statut' => $livre->getStatutBool(),
            'id' => $livre->getId()
        ]);
    }

    /**
     * Permet de récupérer un ou plusieurs livre en fonction de leur nom
     * @param string $title: nom du livre (partiel ou complet)
     * @return array: liste de tous les livres correspondant au titre
     */
    public function getLivresByName(string $title) : array
    {
        $sql = "SELECT L.auteur, L.titre, L.id, L.image, U.pseudo FROM livre L INNER JOIN user U ON L.user_id = U.id
            WHERE L.titre LIKE CONCAT ('%',:titre,'%')";
        $res = $this->db->query($sql, [
            'titre' => $title
        ]);

        $livres = [];
        while ($data = $res->fetch())
        {
            $livre = new Livre($data);
            array_push($livres, ["livre" => $livre, "user" => $data["pseudo"]]);
        }
        return $livres;
    }

    /**
     * Permet de récupérer les 4 derniers livres ajoutés
     * @return array: liste des 4 derniers livres ajoutés
     */
    public function getLivreHome() : array 
    {
        $sql = "SELECT L.auteur, L.titre, L.id, L.image, U.pseudo FROM livre L INNER JOIN user U ON L.user_id = U.id
            ORDER BY L.date_creation DESC LIMIT 4";
        $result = $this->db->query($sql);
        $livres = [];
        while ($data = $result->fetch())
        {
            $livre = new Livre($data);
            array_push($livres, ["livre" => $livre, "user" => $data["pseudo"]]);
        }
        return $livres;    
    }
}