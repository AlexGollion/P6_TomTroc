<?php 

require_once 'Config/config.php';
require_once 'Config/autoload.php';

$livreController = new TomTroc\App\Controller\LivreController();

//var_dump($livreController);

//echo $livreController instanceof TomTroc\App\Models\Livre;
TomTroc\App\Router::addRoute('home', $livreController);
//TomTroc\App\Router::getRoutes();
TomTroc\App\Router::chooseRoute('home');