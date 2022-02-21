<?php

namespace App;

class Url
{
    private static $base;

    public function __construct()
    {
        self::$base = sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['SCRIPT_NAME']);
    }

    public static function make(array $params, bool $absolute = true)
    {
        return (($absolute) ? self::$base : '') . '?' . urldecode(http_build_query($params));
    }
}