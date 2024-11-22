<?php 

require_once 'Config/config.php';
require_once 'Config/autoload.php';

$livreController = new TomTroc\App\Controller\LivreController();

$action = TomTroc\Services\Utils::request('action', 'home');

TomTroc\App\Router::addRoute('home', $livreController);
TomTroc\App\Router::chooseRoute($action);