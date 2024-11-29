<?php

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class LivreController extends AbstractController
{

    public function home() : void
    {
        $this->view('Acceuil', 'home');
    }

    public function showaddlivre() : void
    {
        $this->view('Show addLivre', 'addLivre');
    }

    public function addlivre() : void
    {
        $titre = Services\Utils::request('titre');
        $auteur = Services\Utils::request('auteur'); 
        $image = $_FILES['image'];
        $description = Services\Utils::request('description');
        $statut = Services\Utils::request('statut');

        $id = $_SESSION['idUser'];
        
        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        $livre = new Models\Livre();
        $livre->setTitre($titre);
        $livre->setAuteur($auteur);
        $livre->setImage($image["name"]);
        $livre->setDescription($description);
        $livre->setStatut($statut);
        $livre->setUserId($id);

        $livreManager = new Models\LivreManager();
        $livreManager->addLivre($livre);

        if (!move_uploaded_file($image['tmp_name'], "./Front/images/livres/" . $image['name']))
        {
            throw new \Exception("Le livre n'a pas été mis dans le dossier");
        }

        $userManager = new Models\UserManager();
        $user = $userManager->getUserById($id);

        if (!$user)
        {
            throw new \Exception("L'utilisateur demandé n'existe pas.");
        }

        $this->view('Mon compte', 'monCompte', ['user' => $user]);
    }
}