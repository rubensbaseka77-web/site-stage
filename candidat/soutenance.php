<?php
session_start();

if (!isset($_SESSION["etudiant_id"])) {
    header("Location: ../connexion.php");
    exit;
}

include("../includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/soutenance-candidat.css?v=1">

<main class="sout-page">

    <aside class="sout-sidebar">
        <h2>Espace candidat</h2>
        <p>Gérez vos candidatures et votre profil</p>

        <a href="dashboard.php">▣ Tableau de bord</a>
        <a href="profil.php">👤 Mon profil</a>
        <a href="mes-candidatures.php">📝 Mes candidatures</a>
        <a class="active" href="soutenance.php">🎓 Soutenance</a>
        <a href="convention.php">📄 Convention de stage</a>
        <a href="historique.php">🕒 Historique</a>
        <a href="parametres.php">⚙ Paramètres</a>
    </aside>

    <section class="sout-content">

        <h1>Soutenance</h1>
        <p class="sout-subtitle">Consultez les informations relatives à votre soutenance de stage.</p>

        <div class="sout-layout">

            <div class="sout-left">

                <div class="sout-card">
                    <h2>Informations générales</h2>

                    <div class="sout-grid">
                        <div>
                            <span>Date de soutenance</span>
                            <strong>20/06/2026</strong>
                        </div>

                        <div>
                            <span>Heure</span>
                            <strong>14:00</strong>
                        </div>

                        <div>
                            <span>Statut</span>
                            <strong class="badge">Programmée</strong>
                        </div>
                    </div>
                </div>

                <div class="sout-block">
                    <h2>Jury de soutenance</h2>

                    <div class="jury-row">
                        <div class="avatar">PD</div>
                        <div>
                            <h3>Pr. Pierre Dubois</h3>
                            <p>Enseignant référent</p>
                        </div>
                        <span>Président du jury</span>
                    </div>

                    <div class="jury-row">
                        <div class="avatar">LM</div>
                        <div>
                            <h3>Laura Martin</h3>
                            <p>Enseignante</p>
                        </div>
                        <span>Membre du jury</span>
                    </div>
                </div>

                <div class="sout-block">
                    <h2>Encadrants</h2>

                    <div class="teacher-row">
                        <div class="avatar">MH</div>
                        <div>
                            <h3>M. Lucas Hauchard</h3>
                            <p>Maître de stage</p>
                        </div>
                    </div>

                    <div class="teacher-row">
                        <div class="avatar">SD</div>
                        <div>
                            <h3>Pr. Sophie Durand</h3>
                            <p>Tutrice pédagogique</p>
                        </div>
                    </div>
                </div>

                <div class="sout-card">
                    <h2>Sujet de soutenance</h2>
                    <p>
                        Développement d’une plateforme web de gestion des stages.
                    </p>
                </div>

            </div>

            <div class="sout-right">

                <div class="sout-card">
                    <h2>Étapes de la soutenance</h2>

                    <div class="step done">✓ Sujet validé</div>
                    <div class="step done">✓ Convention signée</div>
                    <div class="step done">✓ Rapport en cours</div>
                    <div class="step active">4 Soutenance programmée</div>
                    <div class="step">5 Soutenance réalisée</div>
                </div>

            </div>

        </div>

    </section>

</main>

<?php include("../includes/footer.php"); ?>