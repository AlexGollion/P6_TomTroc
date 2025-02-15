<?php 

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class UserController extends AbstractController
{
    /**
     * Affiche la page d'inscription
     * @return void
     */
    public function showInscription() : void
    {
        $this->view('Inscrption', 'connexion', ["inscription" => true]);
    }
    
    /**
     * Affiche la page de connexion
     * @return void
     */
    public function showConnexion() : void
    {
        $this->view('Connexion', 'connexion', ["inscription" => false]);
    }

    /**
     * Créer un nouvelle utilisateur 
     * @return void
     */
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
        $user = $userManager->getUserByEmail($email);

        
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        header("Location: home");
        exit();
    }

    /**
     * Permet de se connecter en tant qu'utilisateur
     * @return void
     */
    public function connexion() : void
    {
        $email = Services\Utils::request('email');
        $password = Services\Utils::request('password');

        if (empty($email) || empty($password))
        {
            throw new \Exception("Tous les champs sont obligatoires. 1");
        }

        $userManager = new Models\UserManager();
        $user = $userManager->getUserByEmail($email);

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
    
        header("Location: home");
        exit();
    }

    /**
     * Permet de se déconnecter
     * @return void
     */
    public function deconnexion() : void
    {
        unset($_SESSION['user']);
        unset($_SESSION['idUser']);
        unset($_SESSION["headerMessagerie"]);

        header("Location: home");
        exit();
    }

    /**
     * Affiche la page mon compte
     * @return void
     */
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

    /**
     * Affiche la page de compte public d'un utilisateur
     * @return void
     */
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

    /**
     * Permet de mettre à jour les informations d'un utilisateur
     * @return void
     */
    public function changeInfo() : void
    {
        $id = $_SESSION['idUser'];
        $pseudo = Services\Utils::request('pseudo');
        $password = Services\Utils::request('password');
        $email = Services\Utils::request('email');
        
        $userManager = new Models\UserManager();
        $oldDataUser = $userManager->getUserById($id);
        if (isset($_FILES['image']))
        {
            $photo = $_FILES['image'];
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

        if (!isset($id))
        {
            throw new \Exception("L'utilisateur n'a pas d'id");
        }

        if ($pseudo == null && $nameImage == null && $password == null && $email == null)
        {
            header("Location: monCompte");
            exit();
        }
        else 
        {
            if ($password != null)
            {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            }
            $userManager->updateUser($id, $pseudo, $hashPassword, $nameImage, $email);
            header("Location: monCompte");
            exit();
        }
    }
}

?>