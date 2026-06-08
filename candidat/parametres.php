<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION["etudiant_id"])) {
    header("Location: ../connexion.php");
    exit;
}

include("../includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/parametres-candidat.css?v=1">

<main class="pec-page">

    <aside class="pec-sidebar">
        <h2>Espace candidat</h2>
        <p>Gérez vos candidatures et votre profil</p>

        <a href="dashboard.php">▣ Tableau de bord</a>
        <a href="profil.php">👤 Mon profil</a>
        <a href="mes-candidatures.php">📝 Mes candidatures</a>
        <a href="soutenance.php">🎓 Soutenance</a>
        <a href="convention.php">📄 Convention de stage</a>
        <a href="historique.php">🕒 Historique</a>
        <a class="active" href="parametres.php">⚙ Paramètres</a>
    </aside>

    <section class="pec-content">
        <h1>Paramètres</h1>
        <p class="pec-subtitle">Modifiez les informations de votre compte.</p>

        <div class="pec-card">
            <form method="POST">

                <label>Email</label>
                <input type="email" value="rubensbaseka77@gmail.com">

                <label>Nouveau mot de passe</label>
                <input type="password" placeholder="********">

                <label>Confirmer le mot de passe</label>
                <input type="password" placeholder="********">

                <button type="submit">Enregistrer les modifications</button>

            </form>
        </div>
    </section>

</main>

<?php include("../includes/footer.php"); ?>