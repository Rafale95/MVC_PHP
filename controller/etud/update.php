<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/etudManager.php';
include_once '../../model/services/common.php';
include_once '../../model/services/clasManager.php';

$etudManager = new etudManager();
if (isset($_POST['input_nom']) && isset($_GET['id'])) {
    if($_POST['select_sexe'] != "M" && $_POST['select_sexe'] != "F") //code obsolete en front-end mais empêchent les modification sur code HTML
    {
        $_SESSION['error'] = "Sexe invalide";
        header('Location: update.php');
        exit();
    }
    $t_etud = new etud();
    $t_etud->set_nom(htmlspecialchars($_POST['input_nom']));
    $t_etud->set_pren(htmlspecialchars($_POST['input_pren']));
    $t_etud->set_sexe(htmlspecialchars($_POST['select_sexe']));
    $t_etud->set_nbInscr(htmlspecialchars($_POST['input_nbInscr']));
    $t_etud->set_clas(htmlspecialchars($_POST['select_clas']));
    $id = common::preg_matchId($_GET['id']);
    $t_etud->set_Pk($id);
    try
    {
        $etudManager->update($t_etud);
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }

    header("Location: /ProjetExam/controller/etud/read.php");
    unset($_GET['id']);
}
if (isset($_GET['id'])) {
    $id = common::preg_matchId($_GET['id']);
    try
    {
        $Tetud = $etudManager->read($id)[0];
        $TClasNames = $etudManager->clasManager->get_ClasNames();
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
    include '../../view/etud/update.php';
} else {
    header("Location: /ProjetExam/controller/etud/read.php");
}


