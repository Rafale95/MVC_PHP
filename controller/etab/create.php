<?php
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/etabManager.php';
use ProjetExam\Exception\DbFailureRequestException;


if(isset($_POST['input_etab']))
{

    $inter_etab = new etab();
    $inter_etab->set_etab(htmlspecialchars($_POST['input_niv']));
    $inter_etab->set_AnSco(htmlspecialchars($_POST['input_ident']));
    $inter_etab->set_NbClas(0);
    try
    {
        $etabManager = new etabManager();
        $result = $etabManager->create($inter_etab);
        if($result == 0)
        {
            $_SESSION['error'] = "établissement créé";
        }
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit;
    }
}

include '../../view/etab/create.php';

