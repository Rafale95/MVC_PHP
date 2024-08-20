<?php

namespace ProjetExam\Exception;

class ActionNotFoundException extends \Exception
{
    public function __construct()
    {
        $message = "Pas d'action trouvée avec le controlleur spécifié";
        parent::__construct($message);
    }
}