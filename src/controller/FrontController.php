<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{
    public function home()
    {
        $episodes = $this->episodeDAO->getEpisodes();
        return $this->view->render('frontend/home', [
            'episodes' => $episodes
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
}