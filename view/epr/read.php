<?php
$title = "Epreuves";
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

<body class="bg-dark custom_body_style">

<?php
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';
?>
<div class=" container text-left bg-light p-4 rounded custom_body_style" style="border: #0a53be 2px solid;">
    <h2 class="mb-4">Liste des Épreuves</h2>
    <table class="table table-md table-striped">
        <thead class="thead-light">
        <tr>
            <th scope = "col">Année scolaire</th>
            <th scope = "col">Date</th>
            <th scope = "col">Départ</th>
            <th scope = "col">Distance</th>
            <th scope = "col">Nombre de participant</th>
            <th scope = "col">Actions</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        <?php
        if(count($TEpr)) foreach ($TEpr as $t_epr)
        {
            ?>
            <!-- Les données des épreuves seront chargées ici -->
            <tr>
                <td><?=$t_epr->get_anSco()?></td>
                <td><?=$t_epr->get_date()?></td>
                <td><?=$t_epr->get_tStart()?></td>
                <td><?=$t_epr->get_dist()?></td>
                <td><?=$t_epr->get_nbPart()?></td>
                <td>
                    <a href="/ProjetExam/controller/inscr/readEpr.php?id=challenge<?=$t_epr->get_Pk()?>" class="btn btn-info btn-sm">Inscriptions</a>
                    <a href="/ProjetExam/controller/epr/update.php?id=challenge<?=$t_epr->get_Pk()?>" class="btn btn-primary btn-sm">Modifier</a>
                    <a href="/ProjetExam/controller/epr/delete.php?id=<?=$t_epr->get_Pk()?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette épreuve ?');">Supprimer</a>
                </td>
            </tr>
            <?php
        }
        ?>
        <!-- Répéter pour chaque épreuve -->
        </tbody>
    </table>
    <a href="/ProjetExam/controller/epr/create.php" class="btn btn-success btn-sm">Ajouter une épreuve</a>
</div>
</body>

<?php
$footer = "Epreuves";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>

