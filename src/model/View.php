<?php

namespace App\src\model;

use App\config\Request;

class View
{
    private $file;
    private $title;
    private $style;
    private $request;


    public function __construct()
    {
        $this->request = new Request();
    }

    public function render($template, $data = [])
    {
        $this->file = '../Projet_4/templates/' .$template. '.php';
        $content = $this->renderFile($this->file, $data);
        $view = $this->renderFile('../Projet_4/templates/base.php', [
            'title' => $this->title,
            'style' => $this->style,
            'content' => $content
        ]);
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        header('Location: ../Projet_4/index.php?route=notFound');
    }
}
