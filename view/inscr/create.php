<?php
$title = "Création de l'inscription";
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
    <body class="text-center bg-dark custom_body_style">
    <?php
    include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';
    ?>
    <div>
        <h3 class="text-light fs-2 text-center">Création de l'inscription</h3>
    </div>
    <form method="post">
        <div style="margin-top: 2rem;"></div>
        <div class="container w-50" style="border: #0a53be 2px solid; border-radius: 40px">
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_nom" class="text-light col-sm-3 col-form-label">Numéro Dossier</label>
                <div class="col-sm-7">
                    <input type="text" readonly class="form-control" id="input_nom" name="input_nom" value="<?=$NoDos?>">
                </div>
            </div>
            <div class="mb-3 row">
            <label for="select_epr" class="text-light col-sm-3 col-form-label">Épreuve</label>
                <div class="col-sm-7">
                    <select class="form-control" name="select_epr" id="select_epr">
                        <?php for($x = 0 ; $x < count($TEpr); $x++) { ?>
                            <option value="<?= htmlspecialchars($TEpr[$x]->get_Pk())?>">
                                <?= htmlspecialchars($TEpr[$x]->get_anSco())?> <?= htmlspecialchars($TEpr[$x]->get_date())?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="select_etud" class="text-light col-sm-3 col-form-label">Étudiant</label>
                <div class="col-sm-7">
                    <select class="form-control" name="select_etud" id="select_etud">
                        <?php for($x = 0 ; $x < count($TEtud); $x++) { ?>
                            <option value="<?= htmlspecialchars($TEtud[$x]->get_Pk()) ?>">
                                <?= htmlspecialchars($TEtud[$x]->get_nom())?> <?= htmlspecialchars($TEtud[$x]->get_pren())?>
                            </option>
                        <?php } ?>
                    </select>
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