<?php

namespace TomTroc\App\Controller;

abstract class AbstractController
{
    protected function view(string $viewName, string $templateName, array $params = [])
    {
        $view = new \TomTroc\Front\Views\View($viewName);
        $view->render($templateName, $params);
    }
}