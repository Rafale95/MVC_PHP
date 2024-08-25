<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/inscrManager.php';

$NoDos = rand(1,32767);
try
{
    $EprManager = new eprManager();
    $EtudManager = new etudManager();
    $TEpr = $EprManager->read();
    $TEtud = $EtudManager->read();
}
catch (DbFailureRequestException $e)
{
    header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
    exit();
}

if(isset($_POST['select_epr']))
{
    $inter_inscr = new inscr();

    $inter_inscr->set_NoDos($NoDos);
    $inter_inscr->set_eprId(htmlspecialchars($_POST['select_epr']));
    $inter_inscr->set_etudId(htmlspecialchars($_POST['select_etud']));
    try
    {
        $inter_inscr->set_tStart($EprManager->get_EprTstart(htmlspecialchars($_POST['select_epr'])));
        $inscrManager = new inscrManager();
        $result = $inscrManager->create($inter_inscr);
        if($result == 0)
        {
            $_SESSION['error'] = "inscription créée";
        }
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
}

include '../../view/inscr/create.php';

