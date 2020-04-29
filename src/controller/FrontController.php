<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{
    public function home()
    {
        $episodes = $this->episodeDAO->getEpisodes();
        return $this->view->render('frontend/home', [
            'episodes' => $episodes,
        ]);
    }

    public function episode($episodeId)
    {
        $episode = $this->episodeDAO->getEpisode($episodeId);
        $comments = $this->commentDAO->getCommentsFromEpisode($episodeId);
        return $this->view->render('frontend/episode', [
            'episode' => $episode,
            'comments' => $comments
        ]);
    }

    public function register(Parameter $post)
    {
        if ($post->get('submit')) {
            $this->userDAO->register($post);
            $this->session->set('register', 'Votre inscription a bien été effectuée <br>');
            header('Location: ../Projet_4/index.php');
        }
        return $this->view->render('frontend/register');
    }

    public function login(Parameter $post)
    {
        if ($post->get('submit')) {
            $result = $this->userDAO->login($post);
            if ($result && $result['isPasswordValid']) {
                $this->session->set('login', 'Content de vous revoir');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('pseudo', $post->get('pseudo'));
                $this->session->set('createdAt', $result['result']['createdAt']);
                $this->session->set('lastConnection', $result['result']['lastConnection']);
                header('Location: ../Projet_4/index.php');
            }
            else{
                $this->session->set('error_login', 'Le pseudo ou le mot de passe sont incorrects');
                return $this->view->render('frontend/login', [
                    'post' => $post
                ]);
            }
        }
        return $this->view->render('frontend/login');
    }

    public function profile()
    {
        return $this->view->render('frontend/profile');
    }
}
