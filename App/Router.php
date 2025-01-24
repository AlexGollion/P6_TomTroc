<?php

namespace TomTroc\App;
use TomTroc\App\Middleware as Middleware;
use TomTroc\App\Controller as Controller;

class Router 
{
    private static array $routes = [];

    public static function AddRoute(string $action, $controller, bool $logged) : void
    {
        $class = 'TomTroc\App\Controller\AbstractController';
        if ($controller instanceof $class)
        {
            $controllerClass = get_class($controller);
            self::$routes[$action] = array ("action" => $action, "controller" => $controllerClass, "logged" => $logged);
        }
        else 
        {
            throw new \Exception('Problème');
        }
    }

    public static function getRoutes() : void
    {
        echo '<pre>';
        var_dump(self::$routes);
        echo '<pre>';
    }

    public static function chooseRoute(string $action) : void
    {
        array_key_exists($action, self::$routes) ? self::middlewareCheck($action) : throw new \Exception('Erreur 404: Routes inconnue');;
    }
    
    private static function middlewareCheck(string $action)
    {
        $middleware = new Middleware\Middleware();

        self::headerMessagerie();
    
        if (self::$routes[$action]["logged"])
        {
            if ($middleware->isLogged())
            {
                self::redirect($action);
            }
            else 
            {
                self::redirect("showConnexion");
            }
        }
        else 
        {
            self::redirect($action);           
        }
    }
    
    private static function redirect(string $action)
    {
        self::header($action);
        self::callController(self::$routes[$action]["action"], self::$routes[$action]["controller"]);
    }

    private static function callController(string $action, $controllerClass) : void
    {
        $newController = new $controllerClass();
        $newController->$action();
    }

    private static function header(string $action)
    {
        switch ($action) {
            case "home" : 
                $_SESSION["header"] = "home";
                break;
            case "showAllLivres" :
                $_SESSION["header"] = "showAllLivres";
                break;
            case "showConnexion" :
                $_SESSION["header"] = "showConnexion";
                break;
            case "monCompte" :
                $_SESSION["header"] = "monCompte";
                break;
            case "messagerie" :
                $_SESSION["header"] = "messagerie";
                break;
            default :
                break;
        }
    }

    private static function headerMessagerie() 
    {
        $middleware = new Middleware\Middleware();
         
        if ($middleware->isLogged())
        {
            $messagerieController = new Controller\MessagerieController();
            $messagerieController->headerMessagerie();
        }
    }
}