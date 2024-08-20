<?php
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/etudManager.php';
include_once '../../model/services/common.php';

use ProjetExam\Exception\DbFailureRequestException;
use ProjetExam\Exception\DeleteStudentWithInscrException;

try {
    $inter_etudM = new etudManager();
    if(isset($_GET['id']))
    {
        $id = common::preg_matchId($_GET['id']);
        $inter_etudM->delete($id);
    }

    $TEtud = $inter_etudM->read();
}
catch (DeleteStudentWithInscrException | DbFailureRequestException $e)
{
    header('Location: ./read.php?error=' . urlencode($e->getMessage()));
    exit;
}

include '../../view/etud/read.php';