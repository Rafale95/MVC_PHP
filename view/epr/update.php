<?php
$title = "Modification d'une épreuve'";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/header.php';
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
    echo "<script>alert('$error')</script>";
    unset($_GET['error']);
}
?>
<body class="bg-dark text-center custom_body_style">
<?php
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';
?>
<div>
    <h3 class="text-light fs-2 text-center">Modification de l'épreuve</h3>
</div>
<form method="post">
    <div style="margin-top: 2rem;"></div>
    <div class="container w-50" style="border: #0a53be 2px solid; border-radius: 40px">
        <div class="mb-3 row">
            <p style="margin-top: 1rem"></p>
            <label for="input_anSco" class="text-light col-sm-3 col-form-label">Année Scolaire</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="input_anSco" name="input_anSco" value="<?= $TEpr->get_anSco();?>" required>
            </div>
        </div>
        <p></p>
        <div class="mb-3 row">
            <label for="input_dist" class="text-light col-sm-3 col-form-label">Distance</label>
            <div class="col-sm-7">
                <input type="number" class="form-control" id="input_dist" name="input_dist" value="<?= $TEpr->get_dist();?>" required maxlength="2">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="input_date" class="text-light col-sm-3 col-form-label">Date</label>
            <div class="col-sm-7">
                <input type="date" class="form-control" id="input_date" name="input_date" value="<?= $TEpr->get_date();?>" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="input_tStart" class="text-light col-sm-3 col-form-label">Départ</label>
            <div class="col-sm-7">
                <input type="time" class="form-control" id="input_tStart" name="input_tStart" value="<?= $TEpr->get_tStart();?>" required>
            </div>
        </div>
        <div style="text-align:center; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary mx-2" id="submit">Valider</button>
            <button type="reset" class="btn btn-secondary">Annuler</button>
        </div>
        <p></p>
    </div>
</form>
</body>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>
