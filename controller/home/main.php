<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/eprManager.php';
include_once '../../model/services/etudManager.php';
include_once '../../model/services/etabManager.php';
try
{
    $inter_eprM = new eprManager();
    $inter_etudM = new etudManager();
    $inter_etabM = new etabManager();
    $TEpr = $inter_eprM->readMain();
    $TEtab = $inter_etabM->read();
    if($TEtab == null)
    {
        header('Location: ../etab/create.php');
        exit();
    }

    $etudCount = $inter_etudM->get_countEtudDB();

}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}

include '../../view/home/main.php';