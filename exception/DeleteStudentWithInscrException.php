<?php

namespace ProjetExam\Exception;

class DeleteStudentWithInscrException extends \Exception
{
    public function __construct()
    {
        $message = "Impossible de supprimer un étudiant contenant des inscriptions.";
        parent::__construct($message);
    }
}