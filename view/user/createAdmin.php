<?php
$title = "création de compte";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/header.php';
?>
    <body class="bg-dark text-center">
    <div>
        <h3 class="text-light fs-2 text-center">Page de création de compte</h3>
    </div>
    <form method="post">
        <div style="margin-top: 2rem;"></div>
        <div class="container w-50" style="border: #0a53be 2px solid; border-radius: 40px">
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_login" class="text-light col-sm-3 col-form-label">Login</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="input_login" name="input_login" required>
                </div>
            </div>
            <p></p>
            <div class="mb-3 row">
                <label for="input_passwordCreate" class="text-light col-form-label col-sm-3">Mot de passe</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" id="input_passwordCreate" name="input_passwordCreate" required onkeyup="validate_password()">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="input_confirmPasswordCreate" class="text-light col-form-label col-sm-3">Confirmez le mot de passe</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" id="input_confirmPasswordCreate" name="input_confirmPasswordCreate" required onkeyup="validate_password()">
                    <small id="wrongPasswordAlert" class="form-text"></small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="select_admin" class="text-light col-sm-3 col-form-label">Admin</label>
                <div class="col-sm-7">
                    <select class="form-control" name="select_admin" id="select_admin">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
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