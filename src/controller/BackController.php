<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{

    private function checkAdmin()
    {
        if (!$this->session->get('pseudo') && !($this->session->get('role') === 'admin')) {
            $this->session->set('loggedAdmin', 'Vous devez être connecté et avoir les droits pour accéder à cette page');
            header('Location: index.php');
        } else {
            return true;
        }
    }
    public function administration()
    {
        if ($this->checkAdmin()) {
            $episodes = $this->episodeDAO->getEpisodes();
            $users = $this->userDAO->getUsers();
            $comments = $this->commentDAO->getFlagged();

            return $this->view->render("backend/administration", [
                'episodes' => $episodes,
                'users' => $users,
                'comments' => $comments
            ]);
        }
    }

    public function addEpisode(Parameter $post)
    {
        if ($this->checkAdmin()) {
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Episode');
                if (!$errors) {
                    $this->episodeDAO->addEpisode($post);
                    $this->session->set('addEpisode', 'Le nouvel épisode à bien été ajouté');
                    header('Location: index.php?route=administration');
                }
                return $this->view->render('backend/addEpisode', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
            return $this->view->render('backend/addEpisode');
        }
    }

    public function editEpisode(Parameter $post, $episodeId)
    {
        if ($this->checkAdmin()) {
            $episode = $this->episodeDAO->getEpisode($episodeId);
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Episode');
                if (!$errors) {
                    $this->episodeDAO->editEpisode($post, $episodeId);
                    $this->session->set('editEpisode', 'L\'article a bien été mis à jour');
                    header('Location: index.php?route=administration');
                }
                return $this->view->render('backend/editEpisode', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
            $post->set('id', $episode->getId());
            $post->set('title', $episode->getTitle());
            $post->set('content', $episode->getContent());

            return $this->view->render('backend/editEpisode', [
                'post' => $post
            ]);
        }
    }

    public function deleteEpisode($episodeId)
    {
        if ($this->checkAdmin()) {
            $this->episodeDAO->deleteEpisode($episodeId);
            $this->commentDAO->deleteComments($episodeId);
            $this->session->set('deleteEpisode', 'L\'épisode ' . $episodeId . ' et ses commentaires ont bien été supprimés');
            header('Location: index.php?route=administration');
        }
    }

    public function unflag($commentId)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->unflag($commentId);
            $this->session->set('unflag', 'Le commentaire n° ' . $commentId . ' a bien été désignalé');
            header('Location: index.php?route=administration');
        }
    }

    public function deleteComment($commentId)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('deleteComment', 'Le commentaire ' . $commentId . ' a été supprimé');
            header('Location: index.php?route=administration');
        }
    }

    public function deleteUser($userId)
    {
        if ($this->checkAdmin()) {
            $this->userDAO->deleteUser($userId);
            $this->session->set('deleteUser', 'L\'utilisateur ' . $userId . ' a été supprimé');
            header('Location: index.php?route=administration');
        }
    }
}
