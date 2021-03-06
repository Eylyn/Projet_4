<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{

    private function checkedLogin()
    {
        if (!$this->session->get('pseudo')) {
            $this->session->set('needLogin', 'Vous devez être connecté pour accéder à cette page');
            header('Location: index.php?route=login');
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
        $lastComments = $this->commentDAO->lastcomments();
        $maxId = $this->episodeDAO->getMaxId();
        return $this->view->render('frontend/episode', [
            'episode' => $episode,
            'comments' => $comments,
            'lastComments' => $lastComments,
            'maxId' => $maxId
        ]);
    }

    public function register(Parameter $post)
    {
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'User');
            if ($this->userDAO->checkUser($post)) {
                $errors['pseudo'] = $this->userDAO->checkUser($post);
            }
            if (!$errors) {
                $this->userDAO->register($post);
                $this->session->set('register', '<p> Votre inscription a bien été effectuée </p> <br>');
                header('Location: index.php');
            }
            return $this->view->render('frontend/register', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        return $this->view->render('frontend/register');
    }

    public function login(Parameter $post)
    {
        if ($post->get('submit')) {
            $passwordValidity = $this->userDAO->isPasswordValid($post, $post, 'password');
            $result = $this->userDAO->login($post);
            if ($passwordValidity && $result) {
                $this->session->set('login', '<p>Content de vous revoir</p> <br>');
                $this->session->set('id', $result['id']);
                $this->session->set('pseudo', $post->get('pseudo'));
                $this->session->set('role', $result['name']);
                $this->session->set('createdAt', $result['createdAt']);
                $this->session->set('lastConnection', $result['lastConnection']);
                header('Location: index.php');
            } else {
                $this->session->set('errorLogin', '<p class="col-xs-12">Le pseudo ou le mot de passe sont incorrects </p> <br>');
                return $this->view->render('frontend/login', [
                    'post' => $post
                ]);
            }
        }
        return $this->view->render('frontend/login');
    }

    public function profile()
    {
        if ($this->checkedLogin()) {
            $comments = $this->commentDAO->getComments($this->session->get('pseudo'));
            return $this->view->render('frontend/profile', [
                'comments' => $comments
            ]);
        }
    }

    public function updatePassword(Parameter $post)
    {
        if ($post->get('submit')) {
            $passwordValidity = $this->userDAO->isPasswordValid($post, $this->session, 'oldPassword');
            $errors = $this->validation->validate($post, 'User');

            if ($passwordValidity === true && !$errors) {
                $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
                $this->session->set('updatePassword', '<p>Votre mot de passe a bien été mis à jour </p> <br>');
                header('Location: index.php?route=profile');
            } else {
                $this->session->set('wrongPassword', '<p>Le mot de passe renseigné ne correspond pas</p> <br>');
                return $this->view->render('frontend/updatePassword', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
        }
        return $this->view->render('frontend/updatePassword');
    }

    public function logout()
    {
        if ($this->checkedLogin()) {
            $this->endSession('logout');
        }
    }

    public function setLikes($episodeId)
    {
        $this->episodeDAO->setLikes($episodeId);

        $episode = $this->episodeDAO->getEpisode($episodeId);
        $comments = $this->commentDAO->getCommentsFromEpisode($episodeId);
        return $this->view->render('frontend/episode', [
            'episode' => $episode,
            'comments' => $comments
        ]);
    }

    public function addComment(Parameter $post, $episodeId)
    {
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Comment');
            if (!$errors) {
                $this->commentDAO->addComment($post, $episodeId, $this->session->get('pseudo'));
                $this->session->set('addComment', '<p>Le commentaire a bien été ajouté</p> <br>');
                header('Location: index.php?route=episode&episodeId=' . $episodeId);
            }
            $episode = $this->episodeDAO->getEpisode($episodeId);
            $comments = $this->commentDAO->getCommentsFromEpisode($episodeId);
            return $this->view->render('frontend/episode', [
                'episode' => $episode,
                'comments' => $comments,
                'post' => $post,
                'errors' => $errors
            ]);
        }
    }

    public function setFlag($commentId, $episodeId)
    {
        $this->session->start();
        $this->commentDAO->setFlag($commentId);
        $this->session->set('setFlag', '<p>Votre signalement à été pris en compte</p> <br>');
        header('Location: index.php?route=episode&episodeId=' . $episodeId);

        $episode = $this->episodeDAO->getEpisode($episodeId);
        $comments = $this->commentDAO->getCommentsFromEpisode($episodeId);
        return $this->view->render('frontend/episode', [
            'episode' => $episode,
            'comments' => $comments
        ]);
    }

    public function deleteAccount()
    {
        $this->userDAO->deleteAccount($this->session->get('pseudo'));
        $this->endSession('deleteAccount');
    }

    private function endSession($case)
    {
        $this->session->stop();
        $this->session->start();
        if ($case === 'logout') {
            $this->session->set($case, '<p class="col-xs-12">A bientôt</p>');
        } else {
            $this->session->set($case, '<p>Votre compte a bien été supprimé</p>');
        }
        header('Location: index.php');
    }
}
