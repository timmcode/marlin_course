<?php

namespace App\Controllers;

class UserController{
    public function index()
    {
        redirect(\App\Url::make(['route' => 'user/list']));
    }

    public function list()
    {
        $data = [
            'is_admin'      => \App\User::isAdmin(),
            'user_info'     => \App\User::getUserInfo(),
            'flash'         => \App\Flash::get(),
            'users'         => \App\User::getUsers(),
            'href_home'   => \App\Url::make(),
            'href_logout'   => \App\Url::make(['route' => 'auth/logout']),
            'href_profile_add'=> \App\Url::make(['route' => 'profile/add']),
            'href_profile_delete'=> \App\Url::make(['route' => 'profile/delete']),
            'href_profile_edit'=> \App\Url::make(['route' => 'profile/edit'])
        ];

        echo \App\View::render('page_users', $data);
    }
}