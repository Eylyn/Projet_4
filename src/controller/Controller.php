<?php

namespace App\src\controller;

use App\config\Request;
use App\src\DAO\EpisodeDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

abstract class Controller
{
    protected $episodeDAO;
    protected $commentDAO;
    protected $view;
    private $request;
    protected $get;

    public function __construct()
    {
        $this->episodeDAO = new EpisodeDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
        $this->request = new Request();
        $this->get = $this->request->getGet();
    }
}