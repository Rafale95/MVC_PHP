<?php
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/userManager.php';
use ProjetExam\Exception\DbFailureRequestException;
try
{
    $inter_userM = new userManager();
    if($_SESSION['LogAdmin'] = 1 )
        $TUser = $inter_userM->read();
    else
        $TUser = $inter_userM->read($_SESSION['User']);
    include '../../view/user/read.php';
}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}

