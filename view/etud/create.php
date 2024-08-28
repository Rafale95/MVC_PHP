<?php
$title = "Création de l'étudiant";
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
        <h3 class="text-light fs-2 text-center">Création de l'étudiant</h3>
    </div>
    <form method="post">
        <div style="margin-top: 2rem;"></div>
        <div class="container w-50" style="border: #0a53be 2px solid; border-radius: 40px">
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_nom" class="text-light col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="input_nom" name="input_nom" required>
                </div>
            </div>
            <p></p>
            <div class="mb-3 row">
                <label for="input_pren" class="text-light col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="input_pren" name="input_pren" required >
                </div>
            </div>
            <div class="mb-3 row">
                <label for="select_sexe" class="text-light col-sm-3 col-form-label">Sexe</label>
                <div class="col-sm-7">
                    <select class="form-control" name="select_sexe" id="select_sexe">
                            <option value="M">M</option>
                            <option value="F">F</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="select_classe" class="text-light col-sm-3 col-form-label">Classe</label>
                <div class="col-sm-7">
                    <select class="form-control" name="select_clas" id="select_clas">
                        <?php for($x = 0 ; $x < count($TClas); $x++) { ?>
                            <option value="<?= htmlspecialchars($TClas[$x]["Ident"]) ?>">
                                <?= htmlspecialchars($TClas[$x]["Ident"]) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="select_user" class="text-light col-sm-3 col-form-label">User</label>
                <div class="col-sm-7">
                    <select class="form-control" name="select_user" id="select_user">
                        <?php for($x = 0 ; $x < count($TUser); $x++) { ?>
                            <option value="<?= htmlspecialchars($TUser[$x]["Login"]) ?>">
                                <?= htmlspecialchars($TUser[$x]["Login"]) ?>
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