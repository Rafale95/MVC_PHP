<?php
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/clasManager.php';
include_once '../../model/services/common.php';
use ProjetExam\exception\DeleteClassWithStudentsException;
use ProjetExam\exception\DbFailureRequestException;

try {
    $inter_clasM = new clasManager();
    if (isset($_GET['id']))
    {
        $id = common::preg_matchId($_GET['id']);
        $inter_clasM->delete($id);
    }
}
catch (DeleteClassWithStudentsException | DbFailureRequestException $e)
{
    header('Location: ./read.php?error=' . urlencode($e->getMessage()));
    exit;
}

$TClas = $inter_clasM->read();
include '../../view/clas/read.php';