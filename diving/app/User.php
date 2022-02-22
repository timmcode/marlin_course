<?php

namespace App;

class User
{
    public static function isLogged()
    {
        return !empty($_SESSION['user']);
    }

    public static function isAdmin()
    {
        return (!empty($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin']);
    }

    public static function getUserId()
    {
        return $_SESSION['user']['id'] ?? false;
    }

    public function getUserInfo()
    {
        return $_SESSION['user'] ?? false;
    }

    public static function getUserById(int $id)
    {
        $result = \App\DB::select('SELECT * FROM `users` WHERE `id` = ?',[$id]);
        if($result)
            return array_shift($result);
    }

    public static function getUserByEmail(string $email)
    {
        $result = \App\DB::select('SELECT * FROM `users` WHERE `email` = ?',[$email]);
        if($result)
            return array_shift($result);
    }

    public static function getUsers()
    {
        return \App\DB::select('SELECT * FROM `users`');
    }

    public static function addUser(array $data)
    {
        \App\DB::insert('INSERT INTO `users` SET `email` = ?, `password` = ?',[$data['email'], password_hash($data['password'], PASSWORD_DEFAULT)]);
        return self::getUserByEmail($data['email']);
    }

    public static function updateUser(int $id, array $data)
    {
        \App\DB::select('UPDATE `users` SET `name` = ?, `phone` = ?, `address` = ?, `department` = ?, `vk` = ?, `tg` = ?, `ig` = ? WHERE `id` = ?',[$data['name'], $data['phone'], $data['address'], $data['department'], $data['vk'], $data['tg'], $data['ig'], $id]);
    }

    public static function verifyUserPasswordHash(string $password, string $password_hash)
    {
        return password_verify($password, $password_hash);
    }
}