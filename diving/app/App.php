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
    private $view;

    function __construct()
    {
        session_start();

        spl_autoload_extensions(".php");
        spl_autoload_register();

        $this->config = Config::getInstance();
        $this->config->setProperty('root_path', rtrim(__DIR__, 'app'));

        $this->request = new Request($this);
        $this->url = new Url($this);
        $this->db = new DB($this);
        $this->user = new User($this);
        $this->load = new Load($this);
        $this->view = new View();
    }

    public function run()
    {
        if(!$this->user->isLogged())
            if($this->request->get['route'] !== 'auth/login' && $this->request->get['route'] !== 'auth/register')
                redirect($this->url->make(['route' => 'auth/login']));

        if(empty($this->request->get['route']))
            $this->request->get['route'] = 'home';

        $this->load->controller($this->request->get['route']);
    }
}