<?php

use ProjetExam\Exception\DbFailureRequestException;

$title = "Page Principale";
include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/header.php';

?>

<body class="bg-dark">

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

        <div class="container text-left bg-light p-4 rounded custom_body_style" style="border: #0a53be 2px solid;">
        <div class="table-responsive" style="display: flex;">
        <table class="table table-md table-striped";">
        <thead class="thead-light">
        <tr>
            <th scope = "col">Établissement</th>
            <th scope = "col">Année Scolaire</th>
            <th scope = "col">Nombre de classes</th>
        </tr>
        </thead>
        <tbody class="table-group-divider" ">
            <tr>
                <td><?=$TEtab[0]->get_etab()?></td>
                <td><?=$TEtab[0]->get_anSco()?></td>
                <td><?=$TEtab[0]->get_NbClas()?></td>
                <?php if($_SESSION['LogAdmin'] = 1 ) { ?>
                <td><a href="/ProjetExam/controller/etab/update.php?id=etab<?=$TEtab[0]->get_Pk()?>" class="btn btn-primary btn-sm">Modifier</a></td>
                <?php } ?>
            </tr>

        </tbody>
        </table>
        </div>
        </div>
        <div class="container text-left bg-light p-4 rounded custom_body_style" style="border: #0a53be 2px solid;">
        <div class="table-responsive" style="display: flex;">
            <h2 class="mb-4">Statistiques</h2>
            <div class="table-responsive" style="display: flex;">
                <table class="table table-md table-striped";">
                <thead class="thead-light">
                <tr>
                    <th scope = "col">Épreuve</th>
                    <th scope = "col">Date</th>
                    <th scope = "col">Abstentions</th>
                    <th scope = "col">Run</th>
                    <th scope = "col">Walk</th>
                </tr>
                </thead>
                <tbody class="table-group-divider" ">
                <?php

                if(count($TEpr)) foreach ($TEpr as $t_epr)
                {
                    try {
                        //pourcentage d'absents basé sur le nombre d'étudiants et le nombre de participants
                        $absents = (($etudCount-$t_epr->get_nbPart()) / $etudCount) * 100;
                        $rw = $inter_eprM->get_sumRwByEprDB($t_epr->get_Pk());

                    } catch (DbFailureRequestException $e) {
                        header('Location: ../home/main.php?error=' . urlencode($e->getMessage()));
                        exit();
                    }
                    ?>
                    <tr>
                        <td><?=$t_epr->get_anSco()?></td>
                        <td><?=$t_epr->get_date()?></td>
                        <td><?= $absents?> %</td>
                        <td><?=$rw?> %</td>
                        <td><?=100 - $rw?> %</td>

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
        $footer = "Page d'accueil";
        include $_SERVER['DOCUMENT_ROOT'].'/ProjetExam/view/insert/footer.php';

    ?>

