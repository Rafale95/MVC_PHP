<?php
//si l'utilisateur est connecté, on le redirige vers la page main (pour ne pas accéder à la page login en étant connecté)
if (isset($_SESSION['LogOk']) && ($_SESSION['LogOk'] == 1))
{
        header("Location: /ProjetExam/controller/home/main.php");
}