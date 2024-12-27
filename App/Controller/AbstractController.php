<?php

namespace TomTroc\App\Controller;

abstract class AbstractController
{
    protected function view(string $viewName, string $templateName, array $params = [])
    {
        $view = new \TomTroc\Front\Views\View($viewName);
        $view->render($templateName, $params);
    }

    public function dump($var)
    {
        echo '<pre style="margin: 20px;background:#EEE;border:1px solid #DDD">';
        var_dump($var);
        echo '</pre>';
    }

    public function dd($var)
    {
        $this->dump($var);
        die();
    }
}