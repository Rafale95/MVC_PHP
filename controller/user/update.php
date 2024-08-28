<?php
use ProjetExam\Exception\DbFailureRequestException;
session_start();
include '../secuinAdmin.php';
include_once '../../model/services/clasManager.php';
include_once '../../model/services/common.php';

$userManager = new userManager();
if (isset($_POST['input_login']) && isset($_GET['id'])) {

    $inter_user = new user();
    $inter_user->set_login(htmlspecialchars($_POST['input_niv']));
    $inter_user->set_pswd(htmlspecialchars($_POST['input_ident']));
    $inter_user->set_admin(0);
    $id = common::preg_matchId($_GET['id']);
    $inter_user->set_Pk($id);
    try {
        $result = $userManager->update($inter_user);
        if($result == 0)
        {
            $_SESSION['error'] = "compte modifié";
        }
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }


    header("Location: /ProjetExam/controller/clas/read.php");
    unset($_GET['id']);
}
if (isset($_GET['id'])) {
    $id = common::preg_matchId($_GET['id']);
    try {
        $TClas = $userManager->read($id)[0];
    }
    catch (DbFailureRequestException $e)
    {
        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: /ProjetExam/controller/clas/read.php");
}

include '../../view/clas/update.php';