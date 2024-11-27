<?php

namespace TomTroc\Front\Components;

class Component
{

    public static function render(array $params)
    {
        extract($params);
        if (isset($component))
        {
            require($component . ".php");
        }
    }

    public static function header(bool $isConnected)
    { 
        
        ob_start();
        require('header.php');
        echo ob_get_clean();
    }
}