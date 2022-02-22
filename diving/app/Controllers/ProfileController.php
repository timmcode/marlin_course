<?php

namespace App\Controllers;

class ProfileController{
    public function index()
    {
        redirect(\App\Url::make(['route' => 'user/list']));
    }

    public function edit()
    {
        if(empty(\App\Request::$get['id']))
            redirect(\App\Url::make(['route' => 'user/list']));

        if(!\App\User::isAdmin() && \App\Request::$get['id'] !== \App\User::getUserId())
            redirect(\App\Url::make(['route' => 'user/list']));

        if(\App\Request::$post) {
            \App\User::updateUser(\App\Request::$get['id'], \App\Request::$post);
            \App\Flash::set('Профиль успешно обновлен');
            redirect(\App\Url::make(['route' => 'user/list']));
        }

        $user = \App\User::getUserById(\App\Request::$get['id']);

        if(!$user)
            redirect(\App\Url::make(['route' => 'user/list']));

        $data = [
            'is_admin'      => \App\User::isAdmin(),
            'user_info'     => \App\User::getUserInfo(),
            'user'          => $user,
            'flash'         => \App\Flash::get(),
            'href_home'   => \App\Url::make(),
            'href_logout'   => \App\Url::make(['route' => 'auth/logout']),
            'href_profile_add'=> \App\Url::make(['route' => 'profile/add']),
            'href_profile_delete'=> \App\Url::make(['route' => 'profile/delete']),
            'href_profile_edit'=> \App\Url::make(['route' => 'profile/edit', 'id' => $user['id']])
        ];

        echo \App\View::render('page_profile_edit', $data);
    }

    public function add()
    {
        if(\App\Request::$post) {
            \App\User::addUser(\App\Request::$get['id'], \App\Request::$post);
            \App\Flash::set('Профиль успешно создан');
            redirect(\App\Url::make(['route' => 'user/list']));
        }

        $data = [
            'is_admin'      => \App\User::isAdmin(),
            'user_info'     => \App\User::getUserInfo(),
            'flash'         => \App\Flash::get(),
            'href_home'   => \App\Url::make(),
            'href_logout'   => \App\Url::make(['route' => 'auth/logout']),
            'href_profile_add'=> \App\Url::make(['route' => 'profile/add']),
            'href_profile_delete'=> \App\Url::make(['route' => 'profile/delete']),
            'href_profile_edit'=> \App\Url::make(['route' => 'profile/edit', 'id' => $user['id']])
        ];

        echo \App\View::render('page_profile_add', $data);
    }
}