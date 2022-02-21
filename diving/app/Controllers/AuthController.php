<?php

namespace App\Controllers;

class AuthController
{
    public function register()
    {
        $data = [];

        if(\App\User::isLogged())
            redirect(\App\Url::make());

        if(!empty(\App\Request::$post['email']) && !empty(\App\Request::$post['password'])){
            $result = \App\User::getUserByEmail(\App\Request::$post['email']);
            if(empty($result)){
                if(\App\User::addNewUser(\App\Request::$post['email'], \App\Request::$post['password'])){
                    \App\Flash::set('Пользователь зарегистрирован');
                    redirect(\App\Url::make(['route' => 'auth/login']));
                }
            } else {
                \App\Flash::set('<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
            }
        }

        $data['href_login'] = \App\Url::make(['route' => 'auth/login']);
        $data['href_register'] = \App\Url::make(['route' => 'auth/register']);
        $data['flash'] = \App\Flash::get();

        echo \App\View::render('page_register', $data);
    }

    public function login()
    {
        $data = [];

        if(\App\User::isLogged())
            redirect(\App\Url::make());

        if(!empty(\App\Request::$post['email']) && !empty(\App\Request::$post['password'])){
            $result = \App\User::getUserByEmail(\App\Request::$post['email']);
            if(!empty($result)){
                $result = array_shift($result);
                if(\App\User::verifyUserPasswordHash(\App\Request::$post['password'], $result['password'])){
                    $_SESSION['user'] = $result;
                    redirect(\App\Url::make());
                } else {
                    \App\Flash::set('Неверный пароль');
                }
            } else {
                \App\Flash::set('Пользователь не найден');
            }
        }

        $data = [
            'href_login' => \App\Url::make(['route' => 'auth/login']),
            'href_register' => \App\Url::make(['route' => 'auth/register']),
            'flash' => \App\Flash::get()
        ];

        echo \App\View::render('page_login', $data);
    }

    public function logout()
    {
        if(isset($_SESSION['user']))
            unset($_SESSION['user']);

        redirect(\App\Url::make(['route' => 'auth/login']));
    }
}