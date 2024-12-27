<?php 

    namespace TomTroc\App\Middleware;

    class Middleware {

        private ?int $idSession;

        public function __construct()
        {
            isset($_SESSION['idUser']) ? $this->idSession = $_SESSION['idUser'] : $this->idSession = null;
        }

        public function isLogged() : bool
        {
           return isset($this->idSession) ?  true :  false;
        }
    }

?>