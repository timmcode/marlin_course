<?php

namespace App;

class Flash
{
    public static function set($value)
    {
        $_SESSION['flash_msg'] = $value;
    }

    public static function get()
    {
        $msg = $_SESSION['flash_msg'] ?? '';
        $_SESSION['flash_msg'] = '';

        return $msg;
    }
}