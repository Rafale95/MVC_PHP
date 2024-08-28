<?php
$title = "Users";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/header.php';

if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
    echo "<script>alert('$error')</script>";
    unset($_GET['error']);
}
if (isset($_SESSION['error'])) {
    $error = htmlspecialchars($_SESSION['error']);
    echo "<script>alert('$error')</script>";
    unset($_SESSION['error']);
}
?>

<body class="bg-dark">

<?php
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';
?>
<div class=" container text-left bg-light p-4 rounded custom_body_style" style="border: #0a53be 2px solid;">
    <h2 class="mb-4">Liste des Utilisateurs</h2>
    <div class="table-responsive" style="display: flex;">
        <table class="table table-md table-striped">
            <thead class="thead-light">
            <tr>
                <th scope = "col">Login</th>
                <th scope = "col">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
            if(count($TUser)) foreach ($TUser as $t_user)
            {
                ?>
                <!-- Les données des users seront chargées ici -->
                <tr>
                    <td><?=$t_user->get_login()?></td>
                    <td>
                        <a href="/ProjetExam/controller/user/update.php?id=user<?=$t_user->get_Pk()?>" class="btn btn-primary btn-sm">Modifier</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            <!-- Répéter pour chaque classe -->
            </tbody>
        </table>
    </div>
    <?php if($_SESSION['LogAdmin'] = 1 ) { ?>
    <a href="/ProjetExam/controller/user/createAdmin.php" class="btn btn-success btn-sm">Ajouter un utilisateur</a>
    <?php } ?>
</div>
</body>

<?php
$footer = "Users";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>

