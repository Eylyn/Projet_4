<?php

namespace App\src\constraint;

class Constraint
{
    public function notBlank($name, $value)
    {
        if (empty($value)) {
            return '<p> Le champs <i>' .$name. '</i> saisi est vide</p>';
        }
    }

    public function minLength($name, $value, $min)
    {
        if (strlen($value) < $min) {
            return '<p>Le champs <i>' .$name. '</i> doit contenir au moins <strong>' .$min. '</strong> caratères</p>';
        }
    }

    public function maxLength($name, $value, $max)
    {
        if (strlen($value) > $max) {
            return '<p>Le champs <i>' .$name. '</i> doit contenir au maximum <strong>' .$max. '</strong> caractères</p>';
        }
    }

    public function atDot($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return '<p> L\'adresse email renseignée n\'est pas valide</p>';
        }
    }

    public function regex($name, $value, $regex, $regexExpected)
    {
        if (!filter_var($value, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>$regex)))) {
            return '<p> Le champs <i>' .$name. '</i> doit contenir <strong>' .$regexExpected. '</strong></p>';
        }
    }
}