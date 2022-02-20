<?php

namespace App;

class Config{

    private static $instance;
    private static $property;

    public static function getInstance()
    {
        return self::$instance ?? (self::$instance = new self);
    }

    public static function setProperty($var)
    {
        self::$property = $var;
    }

    public static function getProperty()
    {
        return self::$property;
    }
}