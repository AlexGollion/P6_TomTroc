<?php 

require_once 'Config/config.php';
require_once 'Config/autoload.php';

$livreController = new TomTroc\App\Controller\LivreController();
$userController = new TomTroc\App\Controller\UserController();
$messagerieController = new TomTroc\App\Controller\MessagerieController();

$action = TomTroc\Services\Utils::request('action', 'home');

TomTroc\App\Router::addRoute('showInscription', $userController, false);
TomTroc\App\Router::addRoute('showConnexion', $userController, false);
TomTroc\App\Router::addRoute('inscription', $userController, false);
TomTroc\App\Router::addRoute('connexion', $userController, false);
TomTroc\App\Router::addRoute('deconnexion', $userController, true);
TomTroc\App\Router::addRoute('monCompte', $userController, true);
TomTroc\App\Router::addRoute('comptePublic', $userController, false);
TomTroc\App\Router::addRoute('changeInfo', $userController, true);

TomTroc\App\Router::addRoute('home', $livreController, false);
TomTroc\App\Router::addRoute('showAddLivre', $livreController, true);
TomTroc\App\Router::addRoute('addLivre', $livreController, true);
TomTroc\App\Router::addRoute('deleteLivre', $livreController, true);
TomTroc\App\Router::addRoute('showAllLivres', $livreController, false);
TomTroc\App\Router::addRoute('detailLivre', $livreController, false);
TomTroc\App\Router::addRoute('editLivre', $livreController, true);
TomTroc\App\Router::addRoute('updateLivre', $livreController, true);
TomTroc\App\Router::addRoute('searchLivres', $livreController, false);

TomTroc\App\Router::addRoute('messagerie', $messagerieController, true);
TomTroc\App\Router::addRoute('newMessagerie', $messagerieController, true);
TomTroc\App\Router::addRoute('sendMessage', $messagerieController, true);

//TomTroc\App\Router::getRoutes();
try {
    TomTroc\App\Router::chooseRoute($action);
} catch (Exception $e) {
    $errorView = new TomTroc\Front\Views\View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
