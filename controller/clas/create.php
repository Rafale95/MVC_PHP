<?php
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/clasManager.php';
use ProjetExam\Exception\DbFailureRequestException;


if(isset($_POST['input_ident'])) {
    if($_POST['input_niv']<1 || $_POST['input_niv']>10)
    {
        $_SESSION['error'] = "Niveau invalide";
        header('Location: create.php');
        exit();
    }
    if(strlen($_POST['input_ident'])>3)
    {
        $_SESSION['error'] = "Identifiant invalide";
        header('Location: create.php');
        exit();
    }
    $inter_clas = new clas();
    $inter_clas->set_niv(htmlspecialchars($_POST['input_niv']));
    $inter_clas->set_ident(htmlspecialchars($_POST['input_ident']));
    $inter_clas->set_nbEtud(0);
    try
    {
        $clasManager = new clasManager();
        $result = $clasManager->create($inter_clas);
        if($result == 0)
        {
            $_SESSION['error'] = "classe créée";
        }
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit;
    }
}

include '../../view/clas/create.php';

