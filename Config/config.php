<?php

session_start();


define('PATH', dirname(__DIR__));
define('TEMPLATE_VIEW_PATH', './Front/Views/Templates/');
define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php');

define('DB_HOST', 'localhost');
define('DB_NAME', 'tomtroc');
define('DB_USER', 'root');
define('DB_PASS', '');