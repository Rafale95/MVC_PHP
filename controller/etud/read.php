<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/etudManager.php';
try
{
    $inter_etudM = new etudManager();
    if($_SESSION['LogAdmin'] = 1)
        $TEtud = $inter_etudM->read();
    else
        $TEtud = $inter_etudM->read(null, $_SESSION['User']);
}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}
include '../../view/etud/read.php';