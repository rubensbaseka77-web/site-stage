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
    <title>Espace entreprise</title>

    <link rel="stylesheet" href="/site_stage/assets/css/header-footer-entreprise.css?v=1">
</head>

<body>

<header class="ent-header">
    <nav class="ent-navbar">

        <a href="/site_stage/entreprise/dashboard.php" class="ent-logo">
            <img src="/site_stage/assets/images/logo_iut.png" alt="Logo IUT">
        </a>

        <ul class="ent-nav-links">
            <li><a href="/site_stage/entreprise/dashboard.php">Accueil</a></li>
            <li><a href="/site_stage/entreprise/publier-offre.php">Publication</a></li>
            <li><a href="/site_stage/entreprise/mes-offres.php">Espace entreprise</a></li>
        </ul>

        <a href="/site_stage/entreprise/deconnexion.php" class="ent-btn">
            Déconnexion
        </a>

    </nav>
</header>