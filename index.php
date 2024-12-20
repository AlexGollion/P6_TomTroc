<?php 

require_once 'Config/config.php';
require_once 'Config/autoload.php';

$livreController = new TomTroc\App\Controller\LivreController();
$userController = new TomTroc\App\Controller\UserController();
$messagerieController = new TomTroc\App\Controller\MessagerieController();

$action = TomTroc\Services\Utils::request('action', 'home');

TomTroc\App\Router::addRoute('showInscription', $userController);
TomTroc\App\Router::addRoute('showConnexion', $userController);
TomTroc\App\Router::addRoute('inscription', $userController);
TomTroc\App\Router::addRoute('connexion', $userController);
TomTroc\App\Router::addRoute('deconnexion', $userController);
TomTroc\App\Router::addRoute('monCompte', $userController);
TomTroc\App\Router::addRoute('comptePublic', $userController);
TomTroc\App\Router::addRoute('changeInfo', $userController);

TomTroc\App\Router::addRoute('home', $livreController);
TomTroc\App\Router::addRoute('showAddLivre', $livreController);
TomTroc\App\Router::addRoute('addLivre', $livreController);
TomTroc\App\Router::addRoute('deleteLivre', $livreController);
TomTroc\App\Router::addRoute('showAllLivres', $livreController);
TomTroc\App\Router::addRoute('detailLivre', $livreController);
TomTroc\App\Router::addRoute('editLivre', $livreController);
TomTroc\App\Router::addRoute('updateLivre', $livreController);
TomTroc\App\Router::addRoute('searchLivres', $livreController);

TomTroc\App\Router::addRoute('messagerie', $messagerieController);
TomTroc\App\Router::addRoute('newMessagerie', $messagerieController);
TomTroc\App\Router::addRoute('sendMessage', $messagerieController);

//TomTroc\App\Router::getRoutes();
try {
    TomTroc\App\Router::chooseRoute($action);
} catch (Exception $e) {
    $errorView = new TomTroc\Front\Views\View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
