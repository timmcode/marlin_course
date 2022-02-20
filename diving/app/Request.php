<?php

namespace App;

class Request
{
    public $post;
    public $get;
    public $session;

    public function __construct()
    {
        $this->get = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->session = $_SESSION ?? [];
        $this->files = $_FILES ?? [];
    }
}