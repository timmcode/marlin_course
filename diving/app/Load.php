<?php
namespace App;

class Load
{
    public function controller($route)
    {
        $route_parts = explode('/', $route);
        $controller_name = __NAMESPACE__ . '\\Controllers\\' . ucfirst($route_parts[0]);
        include lcfirst(str_replace('\\' , DIRECTORY_SEPARATOR , $controller_name) . '.php');
        $Controller = new $controller_name();

        if(isset($route_parts[1]))
            $Controller->{$route_parts[1]}();
        else
            $Controller->index();
    }
}