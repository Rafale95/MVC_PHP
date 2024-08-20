<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/inscrManager.php';

$NoDos = rand(1,32767);
$EprManager = new eprManager();


if(isset($_POST['select_epr']))
{
    $inter_inscr = new inscr();
    $inter_inscr->set_NoDos($NoDos);
    try
    {
        $inscrManager = new inscrManager();
        $inscrManager->create($inter_inscr);
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
}

include '../../view/inscr/create.php';

