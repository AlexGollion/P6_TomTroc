<?php 

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class UserController extends AbstractController
{
    public function showInscription() : void
    {
        $this->view('Inscrption', 'connexion', ["inscription" => true]);
    }
    
    public function showConnexion() : void
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
        $newUser->setDateCreationDateTime($dateCreation);

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
        unset($_SESSION['idUser']);

        $this->view('Accueil', 'home');
    }

    public function monCompte() : void
    {
        $id = $_SESSION['idUser'];
        
        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        $data = $this->compte($id);

        $this->view('Mon compte', 'monCompte', $data);
    }

    public function comptePublic() : void
    {
        $id = Services\Utils::request('userId');

        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        $data = $this->compte($id);

        $this->view('Compte public', 'comptePublic', $data);
    }

    private function compte(int $id) : array
    {
        $userManager = new Models\UserManager();
        $user = $userManager->getUserById($id);

        if (!$user)
        {
            throw new \Exception("L'utilisateur demandé n'existe pas.");
        }

        $livreManager = new Models\LivreManager();
        $livres = $livreManager->getLivresByUserId($id);

        return ["livres" => $livres, "user" => $user];
    }

    public function changeInfo() : void
    {
        $id = $_SESSION['idUser'];
        $pseudo = Services\Utils::request('pseudo');
        $password = Services\Utils::request('password');
        
        $userManager = new Models\UserManager();
        $oldDataUser = $userManager->getUserById($id);
        if (isset($_FILES['photo']))
        {
            $photo = $_FILES['photo'];
            $extension = pathinfo($photo["name"], PATHINFO_EXTENSION);
            if ($pseudo != null)
            {
                $nameImage = $pseudo . " " . time() . '.' . $extension;
            }
            else
            {
                $nameImage = $oldDataUser->getPseudo() . " " . time() . '.' . $extension;
            }
            $nameImage = str_replace(" ", "_", $nameImage);
            unlink("./Front/images/profils/" . $oldDataUser->getPhoto());
            if (!move_uploaded_file($photo['tmp_name'], "./Front/images/profils/" . $nameImage))
            {
                throw new \Exception("La photo de profil n'a pas été mis dans le dossier");
            }
        }
        else 
        {
            $nameImage = null;
        }
        $email = Services\Utils::request('password');

        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        $userManager->updateUser($id, $pseudo, $password, $nameImage, $email);

        header("Location: monCompte");
        exit();
    }
}

?>