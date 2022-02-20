<?php

namespace App;

class Config{

    private static $instance;
    private static $property;

    public static function getInstance()
    {
        return self::$instance ?? (self::$instance = new self);
    }

    public static function setProperty($property, $value)
    {
        self::$property = $value;
    }

    public static function getProperty($property)
    {
        return self::$property;
    }
}