<?php

namespace App\src\controller;

use App\config\Request;
use App\src\DAO\ArticleDAO;
use App\src\model\View;

abstract class Controller
{
    protected $articleDAO;
    protected $view;
    private $request;
    protected $get;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->view = new View();
        $this->request = new Request();
        $this->get = $this->request->getGet();
    }
}