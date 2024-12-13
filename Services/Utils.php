<?php

namespace TomTroc\Services;

class Utils
{
    public static function request(string $variableName, mixed $defaultValue = null) : mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

    public static function changeColor(int $i) : string
    {
        $res;
        if ($i%2 == 0)
        {
            $res = "tableauColorA";
        }
        else
        {
            $res = "tableauColorB";
        }
        return $res;
    }

    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }
}