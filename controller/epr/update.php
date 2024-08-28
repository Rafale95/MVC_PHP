<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/eprManager.php';
include_once '../../model/services/common.php';

$eprManager = new eprManager();
if (isset($_POST['input_anSco']) && isset($_GET['id'])) {
    $inter_epr = new epr();
    $inter_epr->set_anSco($eprManager->get_anScoDB());
    $inter_epr->set_Date(htmlspecialchars($_POST['input_date']));
    $inter_epr->set_tStart(htmlspecialchars($_POST['input_tStart']));
    $inter_epr->set_dist(htmlspecialchars($_POST['input_dist']));
    $id = common::preg_matchId($_GET['id']);
    $inter_epr->set_Pk($id);
    try
    {
        $result = $eprManager->update($inter_epr);
        if($result == 0)
        {
            $_SESSION['error'] = "épreuve modifiée";
        }
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
    header("Location: /ProjetExam/controller/epr/read.php");
    unset($_GET['id']);
}

    if (isset($_GET['id']))
    {
        $id = common::preg_matchId($_GET['id']);
        try
        {
            $TEpr = $eprManager->read($id)[0];
        }
        catch (DbFailureRequestException $e)
        {
            header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
            exit();
        }
    }
    else header("Location: /ProjetExam/controller/epr/read.php");

include '../../view/epr/update.php';