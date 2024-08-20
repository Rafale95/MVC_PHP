<?php

namespace ProjetExam\Exception;

class DeleteClassWithStudentsException extends \Exception
{
    public function __construct()
    {
        $message = "Impossible de supprimer une classe contenant des étudiants. CODE 30.";
        parent::__construct($message);
    }

}