<?php 

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class UserController extends AbstractController
{
    public function showinscription() : void
    {
        $this->view('Inscrption', 'connexion', ["inscription" => true]);
    }
    
    public function showconnexion() : void
    {
        $this->view('Connexion', 'connexion', ["inscription" => false]);
    }

    public function inscription() : void
    {
        $pseudo = Services\Utils::request('pseudo');
        $email = Services\Utils::request('email');
        $password = Services\Utils::request('password');

        if (empty($pseudo) || empty($email) || empty($password))
        {
            throw new \Exception("Tous les champs sont obligatoires. 1");
        }

        $newUser = new Models\User();

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $newUser->setPseudo($pseudo);
        $newUser->setEmail($email);
        $newUser->setPassword($hashPassword);
        $dateCreation = new \DateTime();
        $newUser->setDateCreation($dateCreation);

        $userManager = new Models\UserManager();
        $userManager->createUser($newUser);

        
        $_SESSION['user'] = $newUser;
        $_SESSION['idUser'] = $newUser->getId();

        $this->view('Accueil', 'home');
    }

    public function connexion() : void
    {
        $pseudo = Services\Utils::request('pseudo');
        $password = Services\Utils::request('password');

        if (empty($pseudo) || empty($password))
        {
            throw new \Exception("Tous les champs sont obligatoires. 1");
        }

        $userManager = new Models\UserManager();
        $user = $userManager->getUserByLogin($pseudo);

        if (!$user)
        {
            throw new \Exception("L'utilisateur demandé n'existe pas.");
        }

        if (!password_verify($password, $user->getPassword()))
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new \Exception("Le mot de passe est incorrect : $hash");
        }

        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();
    
        $this->view('Accueil', 'home');
    }

    public function deconnexion() : void
    {
        unset($_SESSION['user']);

        $this->view('Accueil', 'home');
    }

    public function moncompte() : void
    {
        $id = $_SESSION['idUser'];
        
        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        $userManager = new Models\UserManager();
        $user = $userManager->getUserById($id);

        if (!$user)
        {
            throw new \Exception("L'utilisateur demandé n'existe pas.");
        }

        $livreManager = new Models\LivreManager();
        $livres = $livreManager->getAllLivres();

        $this->view('Mon compte', 'monCompte', ["user" => $user, "livres" => $livres]);
    }
}

?>