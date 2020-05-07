<?php

namespace App\src\constraint;

use App\config\Parameter;

class EpisodeValidation extends Validation
{
    private $errors = [];
    private $constraint; 

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    public function checkField($name, $value)
    {
        if ($name === 'title') {
            $error = $this->checkTitle($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'content') {
            $error = $this->checkContent($name, $value);
            $this->addError($name, $error);
        }
    }

    private function addError($name, $error)
    {
        if ($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }
    private function checkTitle($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('title', $value);
        }
        if($this->constraint->minLength($name, $value, 3)) {
            return $this->constraint->minLength('titre', $value, 3);
        }
    }

    private function checkContent($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('contenu', $value);
        }
        if($this->constraint->minLength($name, $value, 3)) {
            return $this->constraint->minLength('contenu', $value, 3);
        }
    }
}