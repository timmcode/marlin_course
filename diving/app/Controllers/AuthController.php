<?php

namespace App\Controllers;

class AuthController
{
    public function login()
    {
        $data = [
            'href_login' => \App\Url::make(['route' => 'auth/login']),
            'href_register' => \App\Url::make(['route' => 'auth/register']),
            'flash' => \App\Flash::get()
        ];

        echo \App\View::render('page_login', $data);
    }

    public function register()
    {
        $data = [];

        if(!empty(\App\Request::$post['email']) && !empty(\App\Request::$post['password'])){
            $result = \App\DB::select('SELECT * FROM `users` WHERE `email` = ?',[\App\Request::$post['email']]);
            if(empty($result)){
                \App\DB::insert('INSERT INTO `users` SET `email` = ?, `password` = ?',[\App\Request::$post['email'], password_hash(\App\Request::$post['password'], PASSWORD_DEFAULT)]);
                \App\Flash::set('Пользователь зарегистрирован');
                redirect(\App\Url::make(['route' => 'auth/login']));
            } else {
                \App\Flash::set('<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
            }
        }

        $data['href_login'] = \App\Url::make(['route' => 'auth/login']);
        $data['href_register'] = \App\Url::make(['route' => 'auth/register']);
        $data['flash'] = \App\Flash::get();

        echo \App\View::render('page_register', $data);
    }
}