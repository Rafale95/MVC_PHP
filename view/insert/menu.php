<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="/ProjetExam/controller/home/main.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ProjetExam/controller/inscr/read.php">Inscriptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ProjetExam/controller/epr/read.php">Épreuves</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ProjetExam/controller/etud/read.php">Étudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ProjetExam/controller/clas/read.php">Classes</a>
                </li>
                <?php if($_SESSION['LogAdmin'] = 1 ) { ?>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ProjetExam/controller/arriv/read.php">Arrivées</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ProjetExam/controller/user/read.php">Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/ProjetExam/controller/home/quitter.php" onclick="return confirm('Quitter l\'application?')">Quitter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
