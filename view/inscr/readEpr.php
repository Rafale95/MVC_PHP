<?php
$title = "Inscriptions";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/header.php';
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
    echo "<script>alert('$error')</script>";
    unset($_GET['error']);
}
?>

<body class="bg-dark">

<?php
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';
?>
<div class=" container text-left bg-light p-4 rounded custom_body_style" style="border: #0a53be 2px solid;">
    <h2 class="mb-4">Liste des Inscriptions</h2>
    <table class="table table-md table-striped">
        <thead class="thead-light">
        <tr>
            <th scope = "col">Numéro de dossard</th>
            <th scope = "col">Épreuve</th>
            <th scope = "col">Prénom</th>
            <th scope = "col">Epreuves</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        <?php
        if(count($TInscr)) foreach ($TInscr as $t_inscr)
        {
            ?>
            <!-- Les données des étudiants seront chargées ici -->
            <tr>
                <td><?=$t_inscr->get_nom()?></td>
                <td><?=$t_inscr->get_pren()?></td>
                <td><?=$t_inscr->get_sexe()?></td>
                <td><?=$t_inscr->get_clas()?></td>
                <td><?=$t_inscr->get_nbInscr()?></td>
                <td>
                    <a href="/ProjetExam/controller/etud/update.php?id=student<?=$t_inscr->get_pk()?>" class="btn btn-primary btn-sm">Modifier</a>
                    <a href="/ProjetExam/controller/etud/delete.php?id=<?=$t_inscr->get_pk()?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</a>
                </td>
            </tr>
            <?php
        }
        ?>
        <!-- Répétez pour chaque étudiant -->
        </tbody>
    </table>
    <a href="/ProjetExam/controller/etud/create.php" class="btn btn-success btn-sm">Ajouter un étudiant</a>
</div>
</body>

<?php
$footer = "Etudiants";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>
