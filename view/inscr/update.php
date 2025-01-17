<?php
$title = "Modification de l'inscription";
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
    <body class="bg-dark text-center custom_body_style">
    <?php
    include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';
    ?>
    <div>
        <h3 class="text-light fs-2 text-center">Modification de l'inscription</h3>
    </div>
    <form method="post">
        <div style="margin-top: 2rem;"></div>
        <div class="container w-50" style="border: #0a53be 2px solid; border-radius: 40px">
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_NoDos" class="text-light col-sm-3 col-form-label">Numéro Dossier</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="input_NoDos" name="input_NoDos" value="<?= $Tinscr->get_NoDos()?>">
                </div>
            </div>
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_tEnd" class="text-light col-sm-3 col-form-label">Heure d'arrivée</label>
                <div class="col-sm-7">
                    <input type="time" class="form-control" id="input_tEnd" name="input_tEnd" value="<?= $Tinscr->get_tEnd()?>">
                </div>
            </div>
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_rw" class="text-light col-sm-3 col-form-label">Pourcentage Run/Walk</label>
                <div class="col-sm-7">
                    <input type=number min="0" max="100" class="form-control" id="input_rw" name="input_rw" value="<?= $Tinscr->get_rw()?>"> %
                </div>
            </div>
            <p></p>
            <div style="text-align:center; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary mx-2" id="submit">Valider</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </div>
    </form>
    </body>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>