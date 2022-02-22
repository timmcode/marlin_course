<?php

namespace App\Controllers;

class HomeController{
    public function index()
    {
        redirect(\App\Url::make(['route' => 'user/list']));
    }
}