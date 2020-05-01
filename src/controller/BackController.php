<?php

namespace App\src\controller;

use App\config\Parameter;
class BackController extends Controller
{
    public function administration()
    {
        $episodes = $this->episodeDAO->getEpisodes();
        $users = $this->userDAO->getUsers();

        return $this->view->render("backend/administration", [
            'episodes' => $episodes,
            'users' => $users
        ]);

    }

    public function addEpisode(Parameter $post)
    {
        if ($post->get('submit')) {
            $this->episodeDAO->addEpisode($post);
            $this->session->set('addEpisode', 'Le nouvel épisode à bien été ajouté');
            header('Location: ../Projet_4/index.php?route=administration');
            return $this->view->render('backend/addEpisode', [
                'post' => $post
            ]);
        }
        return $this->view->render('backend/addEpisode');
    }
}