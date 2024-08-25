<?php
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/eprManager.php';
use ProjetExam\Exception\DbFailureRequestException;
try
{
    $inter_eprM = new eprManager();
    $TEpr = $inter_eprM->read();
    include '../../view/arriv/read.php';
}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}
