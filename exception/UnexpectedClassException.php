<?php

namespace ProjetExam\Exception;

class UnexpectedClassException extends \UnexpectedValueException
{
    public function __construct($expected, $real)
    {
        $message = sprintf("Paramètre attendu: %s - Paramètre reçu: %s", $expected, $real);
        parent::__construct($message);
    }
}