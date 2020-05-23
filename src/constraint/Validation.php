<?php

namespace App\src\constraint;

class Validation
{
    public function validate($data, $name)
    {
        if ($name === 'Episode') {
            $episodeValidation = new EpisodeValidation();
            $errors = $episodeValidation->check($data);
            return $errors;
        }
        elseif ($name === 'Comment') {
            $commentValidation = new CommentValidation();
            $errors = $commentValidation->check($data);
            return $errors;
        }
        elseif ($name === 'User') {
            $userValidation = new UserValidation();
            $errors = $userValidation->check($data);
            return $errors;
            echo 'bla bla bla';
        }
    }
}