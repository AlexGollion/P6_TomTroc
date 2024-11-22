<?php

namespace TomTroc\Front\Views;

class View 
{
    private string $title;
    
    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render(string $viewName, array $params = []) : void
    {
        $viewPath = $this->buildViewPath($viewName);

        $content = $this->renderViewFromTemplate($viewPath, $params);
        $title = $this->title;
        ob_start();
        require(MAIN_VIEW_PATH);
        echo ob_get_clean();
    }

    private function buildViewPath(string $viewName) : string
    {
        return TEMPLATE_VIEW_PATH . $viewName . '.php';
    }

    private function renderViewFromTemplate(string $viewPath, array $params = []) : string
    {
        if (file_exists($viewPath))
        {
            extract($params);
            ob_start();
            require($viewPath);
            return ob_get_clean();
        }
        else
        {
            throw new Exception("La vue '$viewPath' est introuvable.");
            
        }
    }
}