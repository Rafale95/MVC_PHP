<?php

namespace ProjetExam\Exception;

class DeleteEprWithInscrException extends \Exception
{
    public function __construct()
    {
        $message = "Impossible de supprimer une épreuve contenant des inscriptions. CODE 30";
        parent::__construct($message);
    }
}