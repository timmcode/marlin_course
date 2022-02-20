<?php
namespace App;

include 'Helpers.php';
include 'Config.php';
include 'Url.php';
include 'Request.php';
include 'DB.php';
include 'User.php';
include 'Load.php';

use App\Config;
use App\User;
use App\DB;
use App\Url;
use App\Request;
use App\Load;

class App
{
    private $config;
    private $user;
    private $db;
    private $url;
    private $request;
    private $load;

    function __construct()
    {
        session_start();

        spl_autoload_extensions(".php"); // comma-separated list
        spl_autoload_register();

        $this->config = Config::getInstance();
        $this->request = new Request($this);
        $this->url = new Url($this);
        $this->db = new DB($this);
        $this->user = new User($this);
        $this->load = new Load($this);
    }

    public function run()
    {
        if(!$this->user->isLogged() && $this->request->get['route'] !== 'auth/login')
            redirect($this->url->make(['route' => 'auth/login']));
        else
            $this->load->controller($this->request->get['route']);
    }
}