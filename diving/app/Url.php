<?php

namespace App;

class Url
{
    private $base;

    public function __construct()
    {
        $this->base = sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['SCRIPT_NAME']);
    }

    public function make(array $params, bool $absolute = true)
    {
        return (($absolute) ? $this->base : '') . '?' . http_build_query($params);
    }
}