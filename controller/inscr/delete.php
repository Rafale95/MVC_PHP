<?php
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/inscrManager.php';
include_once '../../model/services/common.php';

use ProjetExam\Exception\DbFailureRequestException;
use ProjetExam\Exception\DeleteInscrWithTEndException;

try {
    $inter_inscrM = new inscrManager();
    $inter_eprM = new eprManager();
    $inter_etudM = new etudManager();
    if(isset($_GET['id']))
    {
        $id = common::preg_matchId($_GET['id']);
        $inter_inscrM->delete($id);
    }

    $TInscr = $inter_inscrM->read();
}
catch (DeleteInscrWithTEndException | DbFailureRequestException $e)
{
    header('Location: ./read.php?error=' . urlencode($e->getMessage()));
    exit;
}

include '../../view/inscr/read.php';