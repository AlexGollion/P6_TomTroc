<?php

namespace TomTroc\Services;

class Utils
{
    public static function request(string $variableName, mixed $defaultValue = null) : mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

    public static function changeColorTableau(int $i) : string
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

    public static function changeColorMessage(int $id) : string
    {
        $res;
        if ($id == $_SESSION['idUser'])
        {
            $res = "messageEnvoyer";
        }
        else
        {
            $res = "messageRecu";
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

    public static function dump($var)
    {
        echo '<pre style="margin: 20px;background:#EEE;border:1px solid #DDD">';
        var_dump($var);
        echo '</pre>';
    }

    public static function dd($var)
    {
        self::dump($var);
        die();
    }

    public static function headerMessagerieSplit() : string
    {
        $nbMessage = $_SESSION["headerMessagerie"];
        $array = str_split($nbMessage);
        $res = '<i class="fa-regular fa-comment"></i> Messagerie ';
        foreach ($array as $number)
        {
            $res .= '<i class="fa-solid fa-' . $number . '"></i>';
        }
        return $res;
    }
}