<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
//include $_SERVER['DOCUMENT_ROOT'].'/Prj02/controller/secuin.php';
include '../secuinAdmin.php';
include_once '../../model/services/eprManager.php';


if (isset($_POST['input_dist'])) {
    if (!is_numeric($_POST['input_dist']))
    {
        $_SESSION['error'] = "la distance doit être un nombre";
        header('Location: create.php');
        exit();
    }

    $inter_epr = new epr();
    $inter_epr->set_anSco(htmlspecialchars($_POST['input_anSco']));
    $inter_epr->set_Date(htmlspecialchars($_POST['input_date']));
    $inter_epr->set_tStart(htmlspecialchars($_POST['input_tStart']));
    $inter_epr->set_dist(htmlspecialchars($_POST['input_dist']));
    $inter_epr->set_nbPart(htmlspecialchars(0));
    try
    {
        $eprManager = new eprManager();
        $eprManager->create($inter_epr);
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
}

include '../../view/epr/create.php';

