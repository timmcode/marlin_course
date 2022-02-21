<?php

namespace App;

class Request
{
    public static $get;
    public static $post;
    public static $session;

    public function __construct()
    {
        self::$get = $_GET ?? [];
        self::$post = $_POST ?? [];
        self::$session = $_SESSION ?? [];
        self::$files = $_FILES ?? [];
    }
}