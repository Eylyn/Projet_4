<?php

namespace App\config;

class Request
{
    private $get;


    public function __construct()
    {
        $this->get = new Parameter($_GET);
    }

    public function getGet()
    {
        return $this->get;
    }

}