<?php

namespace App\Controllers;

use \App\Config;

class Auth
{
//    private $app;
//
//    public function __construct($app)
//    {
//        $this->app = $app;
//    }

    public function login()
    {
        echo \App\View::render('page_login', ['action' => 'test_action']);
    }
}