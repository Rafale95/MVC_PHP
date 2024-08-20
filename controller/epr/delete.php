<?php
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/eprManager.php';
include_once '../../model/services/common.php';

use ProjetExam\Exception\DbFailureRequestException;
use ProjetExam\Exception\DeleteEprWithInscrException;

try
{
    $inter_eprM = new eprManager();
    if (isset($_GET['id']))
    {
        $id = common::preg_matchId($_GET['id']);
        $inter_eprM->delete($id);
    }
    $TEpr = $inter_eprM->read();
}
catch (DeleteEprWithInscrException | DbFailureRequestException $e)
{
    header('Location: ./read.php?error=' . urlencode($e->getMessage())); //gestion en cascade de cas d'exceptions DB et Delete
    exit;
}

include '../../view/epr/read.php';