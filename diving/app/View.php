<?php

namespace App;

class View
{
    private static $views_path;

    public function __construct()
    {
        self::$views_path = \App\Config::getProperty('base_path') . 'views' . DS;
    }

    public static function render($view, $params = [])
    {
        if($params)
            extract($params);

        include self::$views_path . $view . '.php';
    }
}