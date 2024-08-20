<?php

namespace ProjetExam\Exception;

class ControllerNotFoundException extends \Exception
{
    public function __construct()
    {
        $message = "Pas de controlleur trouvé sur la route spécifiée";
        $code = 404;
        parent::__construct($message, $code);
    }
}