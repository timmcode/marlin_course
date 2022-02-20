<?php

namespace App;

class User
{
    private $db;
    private $user;

    function __construct($app)
    {
//        $this->db = $app->db;
    }

    public function isLogged()
    {
        return !empty($_SESSION['user']);
    }
}