<?php

namespace App;

class User
{
    public static function isLogged()
    {
        return !empty($_SESSION['user']);
    }

    public static function getUserByEmail(string $email)
    {
        return \App\DB::select('SELECT * FROM `users` WHERE `email` = ?',[$email]);
    }

    public static function addNewUser(string $email, string $password)
    {
        \App\DB::insert('INSERT INTO `users` SET `email` = ?, `password` = ?',[$email, password_hash($password, PASSWORD_DEFAULT)]);
        return self::getUserByEmail($email);
    }

    public static function verifyUserPasswordHash(string $password, string $password_hash)
    {
        return password_verify($password, $password_hash);
    }
}