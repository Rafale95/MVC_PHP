<?php
$title = "Etudiants";
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
        <h2 class="mb-4">Liste des Étudiants</h2>
    <div class="table-responsive" style="display: flex;">
    <table class="table table-md table-striped">
            <thead class="thead-light">
            <tr>
                <th scope = "col">Prénom</th>
                <th scope = "col">Nom</th>
                <th scope = "col">Sexe</th>
                <th scope = "col">Classe</th>
                <th scope = "col">Nombre <br>d'inscriptions</br></th>
                <th scope = "col">Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
                if(count($TEtud)) foreach ($TEtud as $t_etud)
                {
            ?>
            <!-- Les données des étudiants seront chargées ici -->
            <tr>
                <td><?=$t_etud->get_nom()?></td>
                <td><?=$t_etud->get_pren()?></td>
                <td><?=$t_etud->get_sexe()?></td>
                <td><?=$t_etud->get_clas()?></td>
                <td><?=$t_etud->get_nbInscr()?></td>
                <td>
                    <a href="/ProjetExam/controller/inscr/readEtud.php?id=student<?=$t_etud->get_Pk()?>" class="btn btn-info btn-sm">Inscriptions</a>
                    <?php if($_SESSION['LogAdmin'] = 1 ) { ?>
                    <a href="/ProjetExam/controller/etud/update.php?id=student<?=$t_etud->get_pk()?>" class="btn btn-primary btn-sm">Modifier</a>
                    <a href="/ProjetExam/controller/etud/delete.php?id=<?=$t_etud->get_pk()?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</a>
                    <?php } ?>
                </td>
            </tr>
            <?php
                }
            ?>
            <!-- Répétez pour chaque étudiant -->
            </tbody>
        </table>
        </div>
    <a href="/ProjetExam/controller/etud/create.php" class="btn btn-success btn-sm">Ajouter un étudiant</a>
</div>
</body>

<?php
$footer = "Etudiants";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>

