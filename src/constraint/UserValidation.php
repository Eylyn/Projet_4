<?php

namespace App\src\constraint;

use App\config\Parameter;

class UserValidation extends Validation
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

    private function checkField($name, $value)
    {
        if ($name === 'pseudo') {
            $error = $this->checkPseudo($name, $value);
            $this->addError($name, $error);
        } 
        elseif ($name === 'password') {
            $error = $this->checkPassword($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'email') {
            $error = $this->checkEmail($name, $value);
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

    private function checkPseudo($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('pseudo', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('pseudo', $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('pseudo', $value, 255);
        }
    }

    private function checkPassword($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('password', $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('password', $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('password', $value, 255);
        }
        if ($this->constraint->regex($name, $value, '\'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$\'', 'au moins 8 caractères dont : un chiffre, une lettre majuscule, une lettre minuscule et un symbole.')) {
            return $this->constraint->regex('password', $value, '\'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$\'', 'au moins 8 caractères dont : un chiffre, une lettre majuscule, une lettre minuscule et un symbole.');
        }
    }

    private function checkEmail($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('email', $value);
        }
        if ($this->constraint->minLength($name, $value, 5)) {
            return $this->constraint->minLength('email', $value, 5);
        }
        if ($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('email', $value, 255);
        }
        if ($this->constraint->atDot($value)) {
            return $this->constraint->atDot($value);
        }
    }
}