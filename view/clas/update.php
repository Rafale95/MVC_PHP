<?php
$title = "Modification de la classe";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/header.php';
if (isset($_GET['error'])) {
    include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';
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
    <body class="bg-dark custom_body_style text-center">
    <?php
    include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';
    ?>
    <div>
        <h3 class="text-light fs-2 text-center">Modification de la classe</h3>
    </div>
    <form method="post" onsubmit="return validateForm()">
        <div style="margin-top: 2rem;"></div>
        <div class="container w-50" style="border: #0a53be 2px solid; border-radius: 40px">
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_niv" class="text-light col-sm-3 col-form-label">Niveau</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="input_niv" name="input_niv" value="<?= $TClas->get_niv();?>" required maxlength="1">
                </div>
            </div>
            <p></p>
            <div class="mb-3 row">
                <label for="input_ident" class="text-light col-sm-3 col-form-label">Identifiant</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="input_ident" name="input_ident" value="<?= $TClas->get_ident();?>" required maxlength="3">
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