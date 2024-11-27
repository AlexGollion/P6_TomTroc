<?php

namespace TomTroc\App\Models;

abstract class AbstractEntityManager
{
    protected $db;

    public function __construct()
    {
        $this->db = DBManager::getInstance();
    }
}

?>