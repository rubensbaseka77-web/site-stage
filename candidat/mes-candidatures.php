<?php
session_start();

if (!isset($_SESSION["etudiant_id"])) {
    header("Location: ../connexion.php");
    exit;
}

include("../includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/mes-candidatures.css?v=2">

<main class="mc-page">

    <aside class="mc-sidebar">
        <h2>Espace candidat</h2>
        <p>Gérez vos candidatures et votre profil</p>

        <a href="dashboard.php">▣ Tableau de bord</a>
        <a href="profil.php">👤 Mon profil</a>
        <a class="active" href="mes-candidatures.php">📝 Mes candidatures</a>
        <a href="soutenance.php">🎓 Soutenance</a>
        <a href="convention.php">📄 Convention</a>
        <a href="historique.php">🕒 Historique</a>
        <a href="parametres.php">⚙ Paramètres</a>
    </aside>

    <section class="mc-content">

        <div class="mc-top">
            <div>
                <h1>Mes candidatures</h1>
                <p>Suivez l’état de vos candidatures envoyées.</p>
            </div>

            <a href="/site_stage/offres.php" class="mc-new-btn">
                Voir les offres
            </a>
        </div>

        <div class="mc-stats">
            <div class="mc-stat">
                <h2>12</h2>
                <p>Candidatures envoyées</p>
            </div>

            <div class="mc-stat">
                <h2>5</h2>
                <p>Vues par les entreprises</p>
            </div>

            <div class="mc-stat">
                <h2>2</h2>
                <p>Entretiens obtenus</p>
            </div>
        </div>

        <div class="mc-tabs">
            <span class="active">Toutes</span>
            <span>En attente</span>
            <span>Vues</span>
            <span>Entretiens</span>
        </div>

        <div class="mc-list">

            <div class="mc-row">
                <div>
                    <h3>Développeur Web</h3>
                    <p>TechVision • Paris • 07/06/2026</p>
                </div>

                <span class="mc-status">En attente</span>

                <a href="#" class="mc-btn">Voir</a>
            </div>

            <div class="mc-row">
                <div>
                    <h3>UX/UI Designer</h3>
                    <p>Design Studio • Lyon • 05/06/2026</p>
                </div>

                <span class="mc-status">Vue</span>

                <a href="#" class="mc-btn">Voir</a>
            </div>

            <div class="mc-row">
                <div>
                    <h3>Community Manager</h3>
                    <p>Media Pulse • Bordeaux • 03/06/2026</p>
                </div>

                <span class="mc-status">Entretien</span>

                <a href="#" class="mc-btn">Voir</a>
            </div>

        </div>

    </section>

</main>

<?php include("../includes/footer.php"); ?>