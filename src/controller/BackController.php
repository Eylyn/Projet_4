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
}