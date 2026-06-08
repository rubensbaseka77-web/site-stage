<?php
session_start();

if (!isset($_SESSION["etudiant_id"])) {
    header("Location: ../connexion.php");
    exit;
}

include("../includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/historique-candidat.css">

<main class="hc-page">

    <aside class="hc-sidebar">

        <h2>Espace candidat</h2>
        <p>Gérez vos candidatures et votre profil</p>

        <a href="dashboard.php">📋 Tableau de bord</a>
        <a href="profil.php">👤 Mon profil</a>
        <a href="mes-candidatures.php">📝 Mes candidatures</a>
        <a href="soutenance.php">🎓 Soutenance</a>
        <a href="convention.php">📄 Convention de stage</a>
        <a class="active" href="historique.php">🕒 Historique</a>
        <a href="parametres.php">⚙️ Paramètres</a>

    </aside>

    <section class="hc-content">

        <h1>Historique</h1>

        <p class="hc-subtitle">
            Retrouvez toutes les actions et événements importants de votre activité.
        </p>

        <div class="hc-stats">

            <div class="hc-stat">
                <h2>24</h2>
                <p>Total événements</p>
            </div>

            <div class="hc-stat">
                <h2>10</h2>
                <p>Actions effectuées</p>
            </div>

            <div class="hc-stat">
                <h2>6</h2>
                <p>Notifications</p>
            </div>

        </div>

        <h2 class="hc-title">
            Activité récente
        </h2>

        <div class="hc-events">

            <div class="hc-event">

                <div class="hc-left">

                    <div class="hc-icon">✓</div>

                    <div>
                        <h3>Convention de stage signée</h3>
                        <p>La convention du stage Développeur Web a été validée.</p>
                    </div>

                </div>

                <div class="hc-right">
                    <span class="hc-badge">Convention</span>
                    <small>20 Mai 2026</small>
                </div>

            </div>

            <div class="hc-event">

                <div class="hc-left">

                    <div class="hc-icon">🎓</div>

                    <div>
                        <h3>Soutenance programmée</h3>
                        <p>Une date de soutenance a été fixée.</p>
                    </div>

                </div>

                <div class="hc-right">
                    <span class="hc-badge">Soutenance</span>
                    <small>18 Mai 2026</small>
                </div>

            </div>

            <div class="hc-event">

                <div class="hc-left">

                    <div class="hc-icon">📄</div>

                    <div>
                        <h3>Candidature acceptée</h3>
                        <p>Votre candidature a été retenue.</p>
                    </div>

                </div>

                <div class="hc-right">
                    <span class="hc-badge">Candidature</span>
                    <small>12 Mai 2026</small>
                </div>

            </div>

            <div class="hc-event">

                <div class="hc-left">

                    <div class="hc-icon">👤</div>

                    <div>
                        <h3>Profil modifié</h3>
                        <p>Vos informations personnelles ont été mises à jour.</p>
                    </div>

                </div>

                <div class="hc-right">
                    <span class="hc-badge">Profil</span>
                    <small>05 Mai 2026</small>
                </div>

            </div>

        </div>

    </section>

</main>

<?php include("../includes/footer.php"); ?>