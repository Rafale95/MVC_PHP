<?php
$title = "Classes";
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
    <h2 class="mb-4">Liste des Classes</h2>
    <div class="table-responsive" style="display: flex;">
    <table class="table table-md table-striped">
        <thead class="thead-light">
        <tr>
            <th scope = "col">Niveau</th>
            <th scope = "col">Identification</th>
            <th scope = "col">Nombre d'étudiants</th>
            <th scope = "col">Actions</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        <?php
        if(count($TClas)) foreach ($TClas as $t_clas)
        {
            ?>
            <!-- Les données des classes seront chargées ici -->
            <tr>
                <td><?=$t_clas->get_niv()?></td>
                <td><?=$t_clas->get_ident()?></td>
                <td><?=$t_clas->get_nbEtud()?></td>
                <td>
                    <a href="/ProjetExam/controller/clas/update.php?id=class<?=$t_clas->get_pk()?>" class="btn btn-primary btn-sm">Modifier</a>
                    <a href="/ProjetExam/controller/clas/delete.php?id=<?=$t_clas->get_pk()?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?');">Supprimer</a>
                </td>
            </tr>
            <?php
        }
        ?>
        <!-- Répéter pour chaque classe -->
        </tbody>
    </table>

    <a href="/ProjetExam/controller/clas/create.php" class="btn btn-success btn-sm">Ajouter une classe</a>
</div>
</body>

<?php
$footer = "Classes";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>

