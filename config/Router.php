<?php

namespace App\config;

use App\src\controller\FrontController;
use App\src\controller\BackController;
use App\src\controller\ErrorController;
use Exception;

class Router

{
    private $frontController;
    private $backController;
    private $errorController;
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->frontController = new FrontController();
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
    }

    public function run()
    {
        $route = $this->request->getGet()->get('route');
        try {
            if (isset($route)) {
                switch ($route) {
                    case "episode":
                        $this->frontController->episode($this->request->getGet()->get('episodeId'));
                        break;
                    case 'register':
                        $this->frontController->register($this->request->getPost());
                        break;
                    case 'login':
                        $this->frontController->login($this->request->getPost());
                        break;
                    case 'profile':
                        $this->frontController->profile($this->request->getGet());
                        break;
                    case 'updatePassword':
                        $this->frontController->updatePassword($this->request->getPost());
                        break;
                    case 'logout':
                        $this->frontController->logout();
                        break;
                    case 'setLikes':
                        $this->frontController->setLikes($this->request->getGet()->get('episodeId'));
                        break;
                    case 'addComment':
                        $this->frontController->addComment($this->request->getPost(), $this->request->getGet()->get('episodeId'));
                        break;
                    case 'setFlag':
                        $this->frontController->setFlag($this->request->getGet()->get('commentId'), $this->request->getGet()->get('episodeId'));
                        break;
                    case 'deleteAccount':
                        $this->frontController->deleteAccount();
                        break;
                    case 'administration':
                        $this->backController->administration();
                        break;
                    case 'addEpisode':
                        $this->backController->addEpisode($this->request->getPost());
                        break;
                    case 'editEpisode':
                        $this->backController->editEpisode($this->request->getPost(), $this->request->getGet()->get('episodeId'));
                        break;
                    case 'deleteEpisode';
                        $this->backController->deleteEpisode($this->request->getGet()->get('episodeId'));
                        break;
                    case 'unflag':
                        $this->backController->unflag($this->request->getGet()->get('commentId'));
                        break;
                    case 'deleteComment':
                        $this->backController->deleteComment($this->request->getGet()->get('commentId'));
                        break;
                    case 'deleteUser':
                        $this->backController->deleteUser($this->request->getGet()->get('userId'));
                        break;
                    default:
                        $this->errorController->errorNotFound();
                }
            } else {
                $this->frontController->home();
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
        }
    }
}
