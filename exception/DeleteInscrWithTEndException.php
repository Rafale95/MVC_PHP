<?php
namespace ProjetExam\Exception;

class DeleteInscrWithTEndException extends \Exception
{
    public function __construct()
    {
        $message = "Impossible de supprimer une inscription avec un temps encodé. CODE 30.";
        parent::__construct($message);
    }
}