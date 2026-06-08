<?php
session_start();

if (!isset($_SESSION["entreprise_id"])) {
    header("Location: ../connexion.php");
    exit;
}

include("../includes/db.php");
include("../includes/header-entreprise.php");
?>
<link rel="stylesheet" href="/site_stage/assets/css/parametres.css?v=1">
<main class="pa-page">

    <aside class="pa-sidebar">
        <h2>Espace entreprise</h2>
        <p>Gérez vos offres et vos candidatures</p>

        <a href="mes-offres.php">▣ Mes offres</a>
        <a href="candidatures.php">♧ Candidatures reçues</a>
        <a href="mon-entreprise.php">▯ Mon entreprise</a>
        <a class="active" href="parametres.php">⚙ Paramètres</a>
        <a href="deconnexion.php">↪ Déconnexion</a>
    </aside>

    <section class="pa-content">

        <h1>Paramètres</h1>
        <p class="pa-subtitle">
            Modifiez les informations de votre compte.
        </p>

        <div class="pa-card">

            <form class="pa-form" method="POST">

                <label>Nom de l'entreprise</label>
                <input type="text" value="Mon Entreprise">

                <label>Email</label>
                <input type="email" value="entreprise@email.com">

                <label>Nouveau mot de passe</label>
                <input type="password" placeholder="********">

                <button type="submit" class="pa-btn">
                    Enregistrer les modifications
                </button>

            </form>

        </div>

    </section>

</main>

<?php include("../includes/footer-entreprise.php"); ?>
