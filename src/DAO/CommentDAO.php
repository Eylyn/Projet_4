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
        $comment->setCreatedAt($row['createdAt']);
        $comment->setModerate($row['moderate']);
        $comment->setFlag($row['flag']);

        return $comment;
    }

    public function getCommentsFromEpisode($episodeId)
    {
        $sql = 'SELECT id, pseudo, content, createdAt, moderate, flag FROM comment WHERE episode_id = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [$episodeId]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function getComment($commentId)
    {
        $sql = 'SELECT id, pseudo, content, createdAt, moderate, flag FROM comment WHERE id = ?';
        $result = $this->createQuery($sql, [$commentId]);
        $comment = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($comment);
    }

    public function addComment(Parameter $post, $episodeId)
    {
        $sql = 'INSERT INTO comment(pseudo, content, createdAt, episode_id, moderate, flag) VALUES(?, ?, NOW(), ?, ?, ?)';
        $this->createQuery($sql, [$post->get('pseudo'), strip_tags($post->get('content')), $episodeId, 0, 0]);
    }

    public function setFlag($commentId)
    {
        $sql = 'UPDATE comment SET flag = flag+1 WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }

    public function getFlagged()
    {
        $sql = 'SELECT id, pseudo, content, createdAt, episode_id, moderate, flag FROM comment WHERE flag >= ? ORDER BY createdAt DESC';
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
        $sql = 'DELETE FROM comment WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }
}
