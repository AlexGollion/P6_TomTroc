<?php

spl_autoload_register(function($className)
{
    $path = PATH . "\\" . $className . '.php';

    if (file_exists($path))
    {
        require $path;
    }
});
