<?php
namespace App;

include 'Helpers.php';
include 'Config.php';
include 'Url.php';
include 'Request.php';
include 'DB.php';
include 'User.php';
include 'Load.php';
include 'View.php';
include 'Flash.php';

use App\Config;
use App\User;
use App\DB;
use App\Url;
use App\Request;
use App\Load;

class App
{
    private $config;
    private $load;

    function __construct()
    {
        session_start();

        spl_autoload_extensions(".php");
        spl_autoload_register();

        $this->config = Config::getInstance();
        $this->config->setProperty('root_path', rtrim(__DIR__, 'app'));

        new DB();
        new Request();
        new View();

        $this->load = new Load($this);
    }

    public function run()
    {
        if(!\App\User::isLogged())
            if(!isset(\App\Request::$get['route']) || (\App\Request::$get['route'] !== 'auth/login' && \App\Request::$get['route'] !== 'auth/register'))
                redirect(\App\Url::make(['route' => 'auth/login']));

        if(empty(\App\Request::$get['route']))
            \App\Request::$get['route'] = 'home';

        $this->load->controller(\App\Request::$get['route']);
    }
}