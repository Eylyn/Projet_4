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
        $sql = 'SELECT id, pseudo, content, createdAt, moderate, flag FROM comment where episode_id = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [$episodeId]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }
}