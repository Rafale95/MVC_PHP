<?php
$title = "Inscriptions de l'étudiant";
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
<div class="container text-left bg-light p-4 rounded custom_body_style" style="border: #0a53be 2px solid;">
    <h2 class="mb-4">Liste des Inscriptions de l'étudiant</h2>
    <div class="table-responsive" style="display: flex;">
        <table class="table table-md table-striped";">
        <thead class="thead-light">
        <tr>
            <th scope = "col">Épreuve</th>
            <th scope = "col">Date</th>
            <th scope = "col">Numéro de dossard</th>
            <th scope = "col">Run/Walk</th>
            <th scope = "col">Début</th>
            <th scope = "col">Fin</th>
            <th scope = "col">Temps</th>
        </tr>
        </thead>
        <tbody class="table-group-divider" ">
        <?php
        if(count($TInscr)) foreach ($TInscr as $t_inscr)
        {
            try {
                $eprDate = $inter_eprM->get_EprDate($t_inscr->get_eprId());
                $eprAnSco = $inter_eprM->get_EprAnSco($t_inscr->get_eprId());
            } catch (DbFailureRequestException $e) {
                header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
                exit();
            }
            ?>
            <tr>
                <td><?=$eprAnSco?></td>
                <td><?=$eprDate?></td>
                <td><?=$t_inscr->get_NoDos()?></td>
                <td><?=$t_inscr->get_rw()?> %</td>
                <td><?=$t_inscr->get_tStart()?></td>
                <td><?=$t_inscr->get_tEnd()?></td>
                <td><?=$t_inscr->get_temps()?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        </table>
    </div>
</div>

</body>

<?php
$footer = "Inscriptions de l'étudiant";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>
