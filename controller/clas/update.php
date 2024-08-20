<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/clasManager.php';
include_once '../../model/services/common.php';

$clasManager = new clasManager();
if (isset($_POST['input_niv']) && isset($_GET['id'])) {
    if($_POST['input_niv']<1 || $_POST['input_niv']>10)
    {
        $_SESSION['error'] = "Niveau invalide";
        header('Location: update.php');
        exit();
    }
    if(strlen($_POST['input_ident'])>3)
    {
        $_SESSION['error'] = "Identifiant invalide";
        header('Location: update.php');
        exit;
    }
    $inter_clas = new clas();
    $inter_clas->set_niv(htmlspecialchars($_POST['input_niv']));
    $inter_clas->set_ident(htmlspecialchars($_POST['input_ident']));
    $inter_clas->set_nbEtud(0);
    $id = common::preg_matchId($_GET['id']);
    $inter_clas->set_Pk($id);
    try {
        $clasManager->update($inter_clas);
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }


    header("Location: /ProjetExam/controller/clas/read.php");
    unset($_GET['id']);
}
if (isset($_GET['id'])) {
    $id = common::preg_matchId($_GET['id']);
    try {
        $TClas = $clasManager->read($id)[0];
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: /ProjetExam/controller/clas/read.php");
}

    include '../../view/clas/update.php';