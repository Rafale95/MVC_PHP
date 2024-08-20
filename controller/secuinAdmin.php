<?php
include_once('../cleanInput.php');
include_once('../../model/services/userManager.php');
//si la session existe avec une login invalide, on renvoie vers la page index
//le user a un LogOk égal à 1 et le gestionnaire (Admin) a un LogOk égal à 2

    if (isset($_SESSION['LogOk']))
    {
        if ($_SESSION['LogOk'] != 1 )
        {
            exit(header("Location: /ProjetExam/controller/home/index.php"));
        }
    }
    else
    {
        exit(header("Location: /ProjetExam/controller/home/index.php"));

    }
