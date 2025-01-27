<?php

spl_autoload_register(function($className)
{
    //echo $className;
    $classPath = explode("TomTroc", $className);
    
    if (count($classPath) == 2)
    {
        $path = PATH . $classPath[1] . '.php';
        //echo $path;
        if (file_exists($path))
        {
            require $path;
        }
        else
        {
            throw new \Exception('Erreur autoload 1');
        }
    }
    else if (count($classPath) == 3)
    {
        $path = PATH . $classPath[2] . '.php';
        //echo $path;
        if (file_exists($path))
        {
            require $path;
        }
        else
        {
            throw new \Exception('Erreur autoload 2');
        }
    }
    else
    {
        throw new \Exception('Erreur autoload 3');
    }
});
