<?php
$title = "Modification de l'étudiant";
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
        <h3 class="text-light fs-2 text-center">Modification de l'étudiant</h3>
    </div>
    <form method="post" onsubmit="return validateForm()">
        <div style="margin-top: 2rem;"></div>
        <div class="container w-50" style="border: #0a53be 2px solid; border-radius: 40px">
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_nom" class="text-light col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="input_nom" name="input_nom" value="<?= $Tetud->get_nom()?>">
                </div>
            </div>
            <p></p>
            <div class="mb-3 row">
                <label for="input_pren" class="text-light col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="input_pren" name="input_pren" value="<?= $Tetud->get_pren()?>" >
                </div>
            </div>
            <div class="mb-3 row">
                <label for="input_sexe" class="text-light col-sm-3 col-form-label">Sexe</label>
                <div class="col-sm-7">
                    <select class="form-control" name="select_sexe" id="select_sexe">
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="select_clas_clas" class="text-light col-sm-3 col-form-label">Classe</label>
                <div class="col-sm-7">
                    <select class="form-control" name="select_clas" id="select_clas">
                        <?php for($x = 0 ; $x < count($TClasNames); $x++) { ?>
                            <option value="<?= htmlspecialchars($TClasNames[$x]["Ident"]) ?>">
                                <?= htmlspecialchars($TClasNames[$x]["Ident"]) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
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