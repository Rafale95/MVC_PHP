<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/inscrManager.php';
include_once '../../model/services/common.php';


if(isset($_POST['input_NoDos']))
{
    $t_inscr = new inscr();
    if(isset($_POST['input_tEnd']))
        if($_POST['input_tEnd'] < $t_inscr->get_tStart())
        {
            $_SESSION['error'] = "le temps de fin ne peut pas être inférieur au temps de début.";
            header('Location: update.php');
            exit();
        }

    if($_POST['input_rw'] <= 0 || $_POST['input_rw'] > 100)
    {
        $_SESSION['error'] = "RunWalk doit être un pourcentage valide.";
        header('Location: update.php');
        exit();
    }
    $t_inscr->set_NoDos(htmlspecialchars($_POST['input_NoDos']));
    $t_inscr->set_tEnd(htmlspecialchars($_POST['input_tEnd']));
    $t_inscr->set_rw(htmlspecialchars($_POST['input_rw']));
    $id = common::preg_matchId($_GET['id']);
    $t_inscr->set_Pk($id);
    try
    {
        $inscrManager = new inscrManager();
        $EprManager = new eprManager();
        $eprId = $inscrManager->read($id)[0]->get_eprId();
        $t_inscr->set_tStart($EprManager->get_EprTstart($eprId));;
        $result = $inscrManager->update($t_inscr);
        if($result == 0)
        {
            $_SESSION['error'] = "inscription modifiée";
        }
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }

    header("Location: /ProjetExam/controller/inscr/read.php");
    unset($_GET['id']);
}
if (isset($_GET['id'])) {
    $id = common::preg_matchId($_GET['id']);
    try
    {
        $inscrManager = new inscrManager();
        $Tinscr = $inscrManager->read($id)[0];
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
    include '../../view/inscr/update.php';
} else {
    header("Location: /ProjetExam/controller/etud/read.php");
}

