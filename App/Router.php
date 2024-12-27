<?php

namespace TomTroc\App;
use TomTroc\App\Middleware as Middleware;

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
        array_key_exists($action, self::$routes) ? self::middlewareCheck($action) : throw new \Exception('Routes inconnue');;
    }
    
    private static function middlewareCheck(string $action)
    {
        $middleware = new Middleware\Middleware();
    
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
        self::callController(self::$routes[$action]["action"], self::$routes[$action]["controller"]);
    }

    private static function callController(string $action, $controllerClass) : void
    {
        $newController = new $controllerClass();
        $newController->$action();
    }
}