<?php

namespace TomTroc\App\Controller;

class LivreController extends AbstractController
{

    public function home()
    {
        $this->view('Acceuil', 'home');
    }
}