<?php

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class LivreController extends AbstractController
{
    /**
     * Affiche la page d'acceuil
     * @return void
     */
    public function home() : void
    {
        $livreManager = new Models\LivreManager();
        $livres = $livreManager->getLivreHome();
        $this->view('Acceuil', 'home', ["livres" => $livres]);
    }

    /** 
     * Affiche la page d'ajout de livre
     * @return void
     */
    public function showAddLivre() : void
    {
        $this->view('Show addLivre', 'addLivre');
    }


    /**
     * Permet d'ajouter un livre
     * @return void
     */
    public function addLivre() : void
    {
        $titre = Services\Utils::request('titre');
        $auteur = Services\Utils::request('auteur'); 
        $image = $_FILES['image'];
        $description = Services\Utils::request('description');
        $statut = (int)Services\Utils::request('statut');

        $id = $_SESSION['idUser'];
        
        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
        $nameImage = $titre . " " . $auteur . " " . time() . '.' . $extension;
        $nameImage = str_replace(" ", "_", $nameImage);

        $livre = new Models\Livre();
        $livre->setTitre($titre);
        $livre->setAuteur($auteur);
        $livre->setImage($nameImage);
        $livre->setDescription($description);
        $livre->setStatut($statut);
        $livre->setUserId($id);
        $dateCreation = new \DateTime();
        $livre->setDateCreationDateTime($dateCreation);

        $livreManager = new Models\LivreManager();
        $livreManager->addLivre($livre);

        if (!move_uploaded_file($image['tmp_name'], "./Front/images/livres/" . $nameImage))
        {
            throw new \Exception("Le livre n'a pas été mis dans le dossier");
        }

        header("Location: monCompte");
        exit();
    }

    /**
     * Permet de supprimer un livre
     * @return void
     */
    public function deleteLivre() : void
    {
        $id = $_SESSION['idUser'];

        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        $idLivre = Services\Utils::request('idLivre');
        $image = Services\Utils::request('image');

        $livreManager = new Models\LivreManager();
        $livreManager->deleteLivreById($idLivre);

        unlink("./Front/images/livres/" . $image);

        $userManager = new Models\UserManager();
        $user = $userManager->getUserById($id);

        if (!$user)
        {
            throw new \Exception("L'utilisateur demandé n'existe pas.");
        }

        $livreManager = new Models\LivreManager();
        $livres = $livreManager->getLivresByUserId($id);

        $this->view('Mon compte', 'monCompte', ["user" => $user, "livres" => $livres]);
    }

    /**
     * Affiche la page nos livres à l'échange
     *  @return void
     */
    public function showAllLivres() : void
    {
        $livreManager = new Models\LivreManager();
        $livres = $livreManager->getAllLivres();

        $this->view("Livre à l'échange", 'allLivres', ["livres" => $livres]);
    }

    /**
     * Affiche la page de détail d'un livre
     * @return void
     */
    public function detailLivre() : void
    {
        $idLivre = Services\Utils::request('idLivre');

        if (!isset($idLivre))
        {
            throw new \Exception("Le livre n'a pas d'id");
        }

        $livreManager = new Models\LivreManager();
        $data = $livreManager->getLivreAndUserById($idLivre);
        $this->view("Detail livre", "detailLivre", ["livre" => $data[0]["livre"], "user" => $data[0]["user"]]);
    }

    /**
     * Affiche la page d'édition d'un livre
     * @return void
     */
    public function editLivre() : void
    {
        $idLivre = Services\Utils::request('idLivre');

        if (!isset($idLivre))
        {
            throw new \Exception("Le livre n'a pas d'id");
        }

        $livreManager = new Models\LivreManager();
        $livre = $livreManager->getLivreById($idLivre);

        $this->view("Modifier un livre", "editLivre", ["livre" => $livre]);
    }

    /**
     * Permet de mettre à jour un livre
     * @return void
     */
    public function updateLivre() : void
    {
        $idLivre = Services\Utils::request('idLivre');
        $titre = Services\Utils::request('titre');
        $auteur = Services\Utils::request('auteur'); 
        $description = Services\Utils::request('description');
        $statut = (int)Services\Utils::request('statut');

        $id = $_SESSION['idUser'];
        
        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        
        $newLivre = new Models\Livre();
        $newLivre->setId($idLivre);
        $newLivre->setTitre($titre);
        $newLivre->setAuteur($auteur);
        $newLivre->setDescription($description);
        $newLivre->setStatut($statut);
        $newLivre->setUserId($id);
        
        $livreManager = new Models\LivreManager();
        $oldLivre = $livreManager->getLivreById($idLivre);
        
        if (isset($_FILES['image']))
        {
            $image = $_FILES['image'];
            $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
            $nameImage = $titre . " " . $auteur . " " . time() . '.' . $extension;
            $nameImage = str_replace(" ", "_", $nameImage);
            $newLivre->setImage($nameImage);
            unlink("./Front/images/livres/" . $oldLivre->getImage());
            if (!move_uploaded_file($image['tmp_name'], "./Front/images/livres/" . $nameImage))
            {
                throw new \Exception("Le livre n'a pas été mis dans le dossier");
            }
        }
        else
        {
            $image = $oldLivre->getImage();
            $newLivre->setImage($image);
        }

        $livreManager->updateLivre($newLivre);


        $userManager = new Models\UserManager();
        $user = $userManager->getUserById($id);

        if (!$user)
        {
            throw new \Exception("L'utilisateur demandé n'existe pas.");
        }

        header("Location: monCompte");
        exit();
    }

    /**
     * Permet de rechercher un livre puis redirige vers nos livres à l'échange
     * @return void
     */
    public function searchLivres() : void
    {
        $titleLivre = Services\Utils::request('searchBar');
        
        if ($titleLivre == null)
        {
            header("Location: showAllLivres");
            exit();
        }
        else
        {
            $livreManager = new Models\LivreManager();
            $livres = $livreManager->getLivresByName($titleLivre);
            $this->view("Livre à l'échange", 'allLivres', ["livres" => $livres]);
        }

    } 
}