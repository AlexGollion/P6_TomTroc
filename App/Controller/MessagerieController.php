<?php

namespace TomTroc\App\Controller;
use TomTroc\App\Models as Models;
use TomTroc\Services as Services;

class MessagerieController extends AbstractController
{
    public function messagerie() : void
    {
        $this->view('Messagerie', 'messagerie');
    }
}