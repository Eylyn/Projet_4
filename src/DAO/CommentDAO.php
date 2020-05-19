<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Comment;

class CommentDAO extends DAO
{
    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setEpisodeId($row['episode_id']);
        $comment->setCreatedAt($row['createdAt']);
        $comment->setModerate($row['moderate']);
        $comment->setFlag($row['flag']);

        return $comment;
    }

    public function getCommentsFromEpisode($episodeId)
    {
        $sql = 'SELECT id, pseudo, content, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, moderate, flag, episode_id FROM comment WHERE episode_id = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [$episodeId]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function getComments($pseudo)
    {
        $sql = 'SELECT comment.id, comment.pseudo, comment.content, comment.episode_id, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, comment.moderate, comment.flag  FROM comment WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$pseudo]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function lastcomments()
    {
        $sql = 'SELECT id, pseudo, content, episode_id,  DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, moderate, flag FROM comment ORDER BY createdAt DESC LIMIT 0, 5';
        $result = $this->createQuery($sql);
        $lastComments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $lastComments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $lastComments;
    }

    public function addComment(Parameter $post, $episodeId, $pseudo)
    {
        $sql = 'INSERT INTO comment(pseudo, content, createdAt, episode_id, moderate, flag) VALUES(?, ?, NOW(), ?, ?, ?)';
        $this->createQuery($sql, [$pseudo, strip_tags(($post->get('content'))), $episodeId, 0, 0]);
    }

    public function setFlag($commentId)
    {
        $sql = 'UPDATE comment SET flag = flag+1 WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }

    public function getFlagged()
    {
        $sql = 'SELECT id, pseudo, content, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, episode_id, moderate, flag FROM comment WHERE flag >= ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [1]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function unflag($commentId)
    {
        $sql = 'UPDATE comment SET flag = 0 WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }

    public function deleteComment($commentId)
    {
        $sql1  = 'INSERT INTO deletComment(pseudo, content, createdAt, episode_id) SELECT pseudo, content, createdAt, episode_id FROM comment WHERE id = ?';
        $this->createQuery($sql1, [$commentId]);
        $sql2 = 'DELETE FROM comment WHERE id = ?';
        $this->createQuery($sql2, [$commentId]);
    }

    public function deleteComments($episodeId)
    {
        $sql1  = 'INSERT INTO deletComment(pseudo, content, createdAt, episode_id) SELECT pseudo, content, createdAt, episode_id FROM comment WHERE episode_id = ?';
        $this->createQuery($sql1, [$episodeId]);
        $sql2 = 'DELETE FROM comment WHERE episode_id = ?';
        $this->createQuery($sql2, [$episodeId]);
    }
}
