<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/clasManager.php';

try
{
    $inter_clasM = new clasManager();
    if($_SESSION['LogAdmin'] = 1)
        $TClas = $inter_clasM->read();
    else
        $TClas = $inter_clasM->read($_SESSION['User']);

}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}

include '../../view/clas/read.php';