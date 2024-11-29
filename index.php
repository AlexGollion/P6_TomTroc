<?php 

require_once 'Config/config.php';
require_once 'Config/autoload.php';

$livreController = new TomTroc\App\Controller\LivreController();
$userController = new TomTroc\App\Controller\UserController();

$action = TomTroc\Services\Utils::request('action', 'home');

TomTroc\App\Router::addRoute('home', $livreController);
TomTroc\App\Router::addRoute('showinscription', $userController);
TomTroc\App\Router::addRoute('showconnexion', $userController);
TomTroc\App\Router::addRoute('inscription', $userController);
TomTroc\App\Router::addRoute('connexion', $userController);
TomTroc\App\Router::addRoute('deconnexion', $userController);
TomTroc\App\Router::addRoute('moncompte', $userController);
TomTroc\App\Router::addRoute('showaddlivre', $livreController);
TomTroc\App\Router::addRoute('addlivre', $livreController);
//TomTroc\App\Router::getRoutes();
try {
    TomTroc\App\Router::chooseRoute($action);
} catch (Exception $e) {
    $errorView = new TomTroc\Front\Views\View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
