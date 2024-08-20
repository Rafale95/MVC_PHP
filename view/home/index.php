<?php
    $title = "Gestion de commerces - Login";
    include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/header.php';
?>
    <body class="bg-dark text-center">
    <div>
        <div>
            <h3 class="text-light fs-2 text-center">Page de connexion</h3>
        </div>
    </div>
    <form method="post">
        <div style="margin-top: 2rem;"></div>
        <div class="container w-50" style="border: #0a53be 2px solid; border-radius: 40px">
            <div class="mb-3 row">
                <p style="margin-top: 1rem"></p>
                <label for="input_login" class="text-light col-sm-3 col-form-label">Login</label>
                <div class="col-sm-7" style="margin-right: 3rem">
                    <input type="text" class="form-control" id="input_login" name="input_login" required>
                </div>
            </div>
            <p></p>
            <div class="mb-3 row">
                <div class="col-sm-3">
                    <label for="input_password" class="text-light col-form-label ">Password</label>
                </div>
                <div class="col-sm-7">
                    <input type="password" class="form-control" id="input_password" name="input_password" required>
                </div>
            </div>
            <div style="text-align:center; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary mx-2">Valider</button>
                <button type="reset" class="btn btn-secondary ">Annuler</button>
                <p></p>
            </div>
            <?php
            if(isset($registerenabled) && $registerenabled == true) {
                ?>
                <div>
                    <a href="/ProjetExam/controller/user/createAdmin.php" class="btn btn-primary">S'inscrire</a>
                </div>
                <?php
            }
            ?>
            <p></p>
        </div>
    </form>
    </body>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';
?>