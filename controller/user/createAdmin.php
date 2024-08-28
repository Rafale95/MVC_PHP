<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/model/services/userManager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/model/user.php';
$userManager = new UserManager();
include '../../view/user/createAdmin.php';
if(isset($_POST['input_login'], $_POST['input_passwordCreate'])) {
    $inter_User = new User();
    $inter_User->set_login(htmlspecialchars($_POST['input_login']));
    $inter_User->set_pswd(htmlspecialchars($_POST['input_passwordCreate']));
    $inter_User->set_admin(htmlspecialchars($_POST['select_admin']));
    $userManager->create($inter_User);
    $_SESSION['LogOk'] = 1;
    $registerenabled = false;
    header("Location: /ProjetExam/controller/home/main.php");
}
else {
    $_SESSION['LogOk'] = 0;
}