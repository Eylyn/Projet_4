<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Article;

class ArticleDAO extends DAO
{
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setCreatedAt($row['createdAt']);
        $article->setLikes($row['likes']);

        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT id, title, content, createdAt, likes FROM article ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row) {
            $articleid = $row['id'];
            $articles[$articleid] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }
}