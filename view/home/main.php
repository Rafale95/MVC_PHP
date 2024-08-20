<?php
$title = "Page Principale";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/header.php';

?>

    <body>

        <?php
            include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/menu.php';

        if (isset($_GET['error'])) {
            $error = htmlspecialchars($_GET['error']);
            echo "<script>alert('$error')</script>";
        }

        if (isset($_SESSION['error'])) {
            $error = htmlspecialchars($_SESSION['error']);
            echo "<script>alert('$error')</script>";
            unset($_SESSION['error']);
        }
        ?>


    </body>

    <?php
        $footer = "Page d'accueil";
        include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';

    ?>

