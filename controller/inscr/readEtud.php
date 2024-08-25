<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/inscrManager.php';
include_once '../../model/services/common.php';

try
{
    if(isset($_GET['id']))
    {
        $inter_inscrM = new inscrManager();
        $inter_eprM = new eprManager();
        $inter_etudM = new etudManager();        $id = common::preg_matchId($_GET['id']);
        $TInscr = $inter_inscrM->read(null, $id);
    }
    else header("Location: /ProjetExam/controller/etud/read.php");

}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}
include '../../view/inscr/readEtud.php';