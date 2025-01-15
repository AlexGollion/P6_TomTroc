<?php

namespace TomTroc\Front\Components;

class Component
{
    const ICON_PATH = PATH . "\Front\images\icons";

    public static function render(array $params)
    {
        extract($params);
        if (isset($component))
        {
            require($component . ".php");
        }
    }

    public static function renderIcon(string $nameIcon)
    {
        $icon = PATH . "\Front\images\icons\\" . $nameIcon . ".php";
        require("icon.php");
    }
}