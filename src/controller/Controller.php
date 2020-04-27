<?php

namespace App\src\controller;

use App\config\Request;
use App\src\DAO\EpisodeDAO;
use App\src\model\View;

abstract class Controller
{
    protected $episodeDAO;
    protected $view;
    private $request;
    protected $get;

    public function __construct()
    {
        $this->episodeDAO = new EpisodeDAO();
        $this->view = new View();
        $this->request = new Request();
        $this->get = $this->request->getGet();
    }
}