<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/model/services/userManager.php';
$userManager = new UserManager();
if (isset($_SESSION['LogOk']) && ($_SESSION['LogOk'] == 1)) //on vérifie si l'utilisateur est connecté ou non (si non, on le redirige vers la page de connexion)
    header("Location: /ProjetExam/controller/home/main.php");

else
{
    if ($userManager->get_admin()) //check si un admin est déjà dans la base de données
    {
        $adminExist = true;
        include '../../view/home/index.php';

        if (isset($_POST['input_login'], $_POST['input_password']))
            if ($userManager->checkLoginPassword($_POST['input_login'], $_POST['input_password'])) //check si les paramètres de connexion sont valides
            {
                if ($userManager->checkAdmin($_POST['input_login']))
                    $_SESSION['LogAdmin'] = 1;
                else
                    $_SESSION['LogAdmin'] = 0;

                $_SESSION['User'] = ($_POST['input_login']);
                $_SESSION['LogOk'] = 1;
                header("Location: /ProjetExam/controller/home/main.php");
            } else {
                $_SESSION['LogOk'] = 0;
                echo "<script> alert('Paramètres de connexion invalides'); </script>";
            }
        else $_SESSION['LogOk'] = 0;
    } else {
        $adminExist = false;
        include '../../view/home/index.php';
    }
}


