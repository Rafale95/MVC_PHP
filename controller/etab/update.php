<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/clasManager.php';
include_once '../../model/services/common.php';

$etabManager = new etabManager();
if (isset($_POST['input_etab']) && isset($_GET['id'])) {

    $inter_etab = new etab();
    $inter_etab->set_Etab(htmlspecialchars($_POST['input_etab']));
    $inter_etab->set_AnSco(htmlspecialchars($_POST['input_anSco']));
    $inter_etab->set_NbClas(0);
    $id = common::preg_matchId($_GET['id']);
    $inter_etab->set_Pk($id);
    try {
        $result = $etabManager->update($inter_etab);
        if($result == 0)
        {
            $_SESSION['error'] = "établissement modifié";
        }
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }


    header("Location: /ProjetExam/controller/home/index.php");
    unset($_GET['id']);
}
if (isset($_GET['id'])) {
    $id = common::preg_matchId($_GET['id']);
    try {
        $TEtab = $etabManager->read($id)[0];
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: /ProjetExam/controller/home/index.php");
}

include '../../view/etab/update.php';