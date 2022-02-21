<?php

namespace App\Controllers;

use \App\Config;

class AuthController
{
//    private $app;
//
//    public function __construct($app)
//    {
//        $this->app = $app;
//    }

    public function login()
    {
        $data = [
            'href_action' => \App\Url::make(['route' => 'auth/login']),
            'href_register' => \App\Url::make(['route' => 'auth/register'])
        ];

        echo \App\View::render('page_login', $data);
    }

    public function register()
    {
        $data = [
            'href_login' => \App\Url::make(['route' => 'auth/login']),
            'href_register' => \App\Url::make(['route' => 'auth/register'])
        ];

        echo \App\View::render('page_register', $data);
    }
}