<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{

    private function checkedLogin()
    {
        if (!$this->session->get('pseudo')) {
            $this->session->set('needLogin', 'Vous devez être connecté pour accéder à cette page');
            header('Location: ../Projet_4/index.php?route=login');
        } else {
            return true;
        }
    }

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
            $passwordValidity = $this->userDAO->isPasswordValid($post, $post, 'password');
            $result = $this->userDAO->login($post);
            if ($passwordValidity && $result) {
                $this->session->set('login', 'Content de vous revoir');
                $this->session->set('id', $result['id']);
                $this->session->set('pseudo', $post->get('pseudo'));
                $this->session->set('createdAt', $result['createdAt']);
                $this->session->set('lastConnection', $result['lastConnection']);
                header('Location: ../Projet_4/index.php');
            } else {
                $this->session->set('errorLogin', 'Le pseudo ou le mot de passe sont incorrects');
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

    public function updatePassword(Parameter $post)
    {
        if ($post->get('submit')) {
            $passwordValidity = $this->userDAO->isPasswordValid($post, $this->session, 'oldPassword');
            if ($passwordValidity === true) {
                $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
                $this->session->set('updatePassword', 'Votre mot de passe a bien été mis à jour <br>');
                header('Location: ../Projet_4/index.php?route=profile');
            } else {
                $this->session->set('wrongPassword', 'Le mot de passe renseigné ne correspond pas <br>');
                return $this->view->render('frontend/updatePassword');
            }
        }
        return $this->view->render('frontend/updatePassword');
    }

    public function logout()
    {
        if ($this->checkedLogin()) {
            $this->session->stop();
            $this->session->start();
            $this->session->set('logout', 'A bientôt');
            header('Location: ../Projet_4/index.php');
        }
    }
    public function addComment(Parameter $post, $episodeId)
    {
        if ($post->get('submit')) {
            $this->commentDAO->addComment($post, $episodeId);
            $this->session->set('addComment', 'Le commentaire a bien été ajouté');
            header('Location: ../Projet_4/index.php?route=episode&episodeId=' . $episodeId);

            $episode = $this->episodeDAO->getEpisode($episodeId);
            $comments = $this->commentDAO->getCommentsFromEpisode($episodeId);
            return $this->view->render('frontend/episode', [
                'episode' => $episode,
                'comments' => $comments,
                'post' => $post
            ]);
        }
    }

    public function setFlag($commentId, $episodeId)
    {
        $this->commentDAO->setFlag($commentId);
        $this->session->set('setFlag', 'Votre signalement à été pris en compte');
        header('Location: ../Projet_4/index.php?route=episode&episodeId=' .$episodeId);

        $episode = $this->episodeDAO->getEpisode($episodeId);
        $comments = $this->commentDAO->getCommentsFromEpisode($episodeId);
        return $this->view->render('frontend/episode', [
            'episode' => $episode,
            'comments' => $comments
        ]);
    }
}
