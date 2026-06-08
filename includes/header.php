<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Université Gustave Eiffel</title>

    <link rel="stylesheet" href="/site_stage/assets/css/style.css">
    <link rel="stylesheet" href="/site_stage/assets/css/header-footer.css?v=1">
</head>

<body>

<header class="site-header">
    <nav class="site-navbar">

        <a href="/site_stage/index.php" class="site-logo">
            <img src="/site_stage/assets/images/logo_iut.png" alt="Logo IUT">
        </a>

        <ul class="site-nav-links">
            <li><a href="/site_stage/index.php">Accueil</a></li>
            <li><a href="/site_stage/offres.php">Offres de stage</a></li>

            <li>
                <?php if (isset($_SESSION["etudiant_id"])): ?>
                    <a href="/site_stage/candidat/dashboard.php">Espace candidat</a>
                <?php else: ?>
                    <a href="/site_stage/connexion.php">Espace candidat</a>
                <?php endif; ?>
            </li>

            <li><a href="/site_stage/aide.php">Aide</a></li>
            <li><a href="/site_stage/a-propos.php">À propos</a></li>
        </ul>

        <div class="site-header-actions">
            <?php if (isset($_SESSION["etudiant_id"])): ?>
                <a href="/site_stage/déconnexion.php" class="site-btn-login">Déconnexion</a>
            <?php else: ?>
                <a href="/site_stage/connexion.php" class="site-btn-login">Connexion / Inscription</a>
            <?php endif; ?>
        </div>

    </nav>
</header>