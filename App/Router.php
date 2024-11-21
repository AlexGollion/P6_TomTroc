<?php

namespace TomTroc\App;

class Router 
{
    private static array $routes = [];

    public static function AddRoute(string $action, $controller) : void
    {
        $class = 'TomTroc\App\Controller\AbstractController';
        if ($controller instanceof $class)
        {
            $controllerClass = get_class($controller);
            self::$routes[$action] = array ("action" => $action, "controller" => $controllerClass);
        }
        else 
        {
            echo "non";
        }
    }

    public static function getRoutes() : void
    {
        var_dump(self::$routes);
    }

    public static function chooseRoute(string $action)
    {
        if (array_key_exists($action, self::$routes))
        {
            self::callController(self::$routes[$action]["action"], self::$routes[$action]["controller"]);
        }
        else
        {
            echo "non";
        }
    }

    private static function callController(string $action, $controllerClass)
    {
        $newController = new $controllerClass();
        $newController->$action();
    }
}