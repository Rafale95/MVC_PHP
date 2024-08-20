<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/clasManager.php';

try
{
    $inter_clasM = new clasManager();
    $TClas = $inter_clasM->read();
}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}

include '../../view/clas/read.php';