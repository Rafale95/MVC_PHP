<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/inscrManager.php';

try
{
    $inter_inscrM = new inscrManager();
    $inter_eprM = new eprManager();
    $inter_etudM = new etudManager();
    $etud = new etud();
    $TInscr = $inter_inscrM->read();
}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}
include '../../view/inscr/read.php';