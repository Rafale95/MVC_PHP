<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
//include $_SERVER['DOCUMENT_ROOT'].'/Prj02/controller/secuin.php';
include '../secuinAdmin.php';
include_once '../../model/services/etudManager.php';
try
{
    $etudManager = new etudManager();
    $TClas = $etudManager->clasManager->get_ClasNames();
}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}

if(isset($_POST['input_nom']))
{
    if($_POST['select_sexe'] != "M" && $_POST['select_sexe'] != "F") //code obsolete en front-end mais empêchent les modification sur code HTML
    {
        $_SESSION['error'] = "Sexe invalide";
        header('Location: create.php');
        exit();
    }

    $inter_etud = new etud();
    $inter_etud->set_nom(htmlspecialchars($_POST['input_nom']));
    $inter_etud->set_pren(htmlspecialchars($_POST['input_pren']));
    $inter_etud->set_sexe(htmlspecialchars($_POST['select_sexe']));
    $inter_etud->set_clas(htmlspecialchars($_POST['select_clas']));
    $inter_etud->set_user(htmlspecialchars($_POST['select_user']));

    try
    {
        $result = $etudManager->create($inter_etud);
        if($result == 0)
        {
            $_SESSION['error'] = "étudiant créé";
        }
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
}

include '../../view/etud/create.php';

