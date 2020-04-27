<?php

namespace App\config;

class Request
{
    private $get;
    private $session;


    public function __construct()
    {
        $this->get = new Parameter($_GET);
        $this->session = new Session($_SESSION);
    }

    public function getGet()
    {
        return $this->get;
    }

    public function getSession()
    {
        return $this->session;
    }

}