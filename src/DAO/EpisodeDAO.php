<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Episode;

class EpisodeDAO extends DAO
{
    private function buildObject($row)
    {
        $episode = new Episode();
        $episode->setId($row['id']);
        $episode->setTitle($row['title']);
        $episode->setContent($row['content']);
        $episode->setCreatedAt($row['createdAt']);
        $episode->setComments($row['comments']);
        $episode->setLikes($row['likes']);

        return $episode;
    }

    public function getEpisodes()
    {
        $sql = 'SELECT id, title, content, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, comments, likes FROM episode ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $episodes = [];
        foreach ($result as $row) {
            $episodeId = $row['id'];
            $episodes[$episodeId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $episodes;
    }

    public function getEpisode($episodeId)
    {
        $sql = 'SELECT id, title, content, DATE_FORMAT(createdAt, \'%d/%m/%Y à %Hh%imin\') as createdAt, comments, likes FROM episode WHERE id = ?';
        $result = $this->createQuery($sql, [$episodeId]);
        $episode = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($episode);
    }

    public function getMaxId()
    {
        $sql2 = 'SELECT MAX(id) FROM episode';
        $this->createQuery($sql2);
    }

    public function addEpisode(Parameter $post)
    {
        $sql = 'INSERT INTO episode(title, content, createdAt) VALUES (?, ?, NOW())';
        $this->createQuery($sql, [$post->get('title'), $post->get('content')]);
    }
    
    public function editEpisode(Parameter $post, $episodeId)
    {
        $sql = 'UPDATE episode SET title=:title, content=:content WHERE id=:episodeId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'episodeId' => $episodeId
        ]);
    }

    public function deleteEpisode($episodeId)
    {
        $sql1  = 'INSERT INTO deletedEpisode(oldId, title, content, createdAt, comments) SELECT id, title, content, createdAt, comments FROM episode WHERE id = ?';
        $this->createQuery($sql1, [$episodeId]);
        $sql2 = 'DELETE FROM episode WHERE id = ?';
        $this->createQuery($sql2, [$episodeId]);
    }

    public function setLikes($episodeId)
    {
        $sql = 'UPDATE episode SET likes = likes+1 WHERE id = ?';
        $this->createQuery($sql, [$episodeId]);
    }
}