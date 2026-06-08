<?php
include("includes/db.php");
include("includes/header.php");

/* ── Sécurité : ID obligatoire ── */
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "<p>Offre introuvable.</p>";
    include("includes/footer.php");
    exit;
}

$id = intval($_GET["id"]);

$sql = "
    SELECT
        offre_stage.id_offre,
        offre_stage.titre,
        offre_stage.description,
        offre_stage.date_publication,
        entreprise.nom        AS entreprise_nom,
        entreprise.adresse    AS entreprise_adresse,
        entreprise.secteur    AS entreprise_secteur,
        entreprise.email      AS entreprise_email,
        entreprise.telephone  AS entreprise_telephone
    FROM offre_stage
    LEFT JOIN entreprise
        ON offre_stage.id_entreprise = entreprise.id_entreprise
    WHERE offre_stage.id_offre = $id
";

$result = mysqli_query($conn, $sql);
$offre  = mysqli_fetch_assoc($result);

if (!$offre) {
    echo "<p>Cette offre n'existe pas.</p>";
    include("includes/footer.php");
    exit;
}
?>

<!-- CSS commun + CSS thème Marketing -->
<link rel="stylesheet" href="offre-detail-marketing.css">

<main class="offre-detail-page">

    <!-- ── Header ── -->
    <section class="detail-header">

        <a href="offres.php" class="back-link">← Retour aux offres</a>

        <div class="detail-title-block">

            <div class="company-logo">
                <span><?php echo strtoupper(substr($offre["entreprise_nom"], 0, 1)); ?></span>
            </div>

            <div>
                <span class="detail-badge">Marketing</span>

                <h1><?php echo htmlspecialchars($offre["titre"]); ?></h1>

                <div class="detail-meta">
                    <span><?php echo htmlspecialchars($offre["entreprise_nom"]); ?></span>
                    <span>📍 <?php echo htmlspecialchars($offre["entreprise_adresse"]); ?></span>
                    <span>📅 Publiée le <?php echo htmlspecialchars($offre["date_publication"]); ?></span>
                </div>

                <div class="detail-tags">
                    <span>Stage</span>
                    <span>3 à 6 mois</span>
                    <span>Rémunéré</span>
                    <span>Télétravail possible</span>
                </div>
            </div>

        </div>

    </section>

    <!-- ── Contenu 2 colonnes ── -->
    <section class="detail-layout">

        <div class="detail-main">

            <article class="detail-card">
                <h2>Description du stage</h2>
                <p><?php echo nl2br(htmlspecialchars($offre["description"])); ?></p>
            </article>

            <article class="detail-card">
                <h2>Missions principales</h2>
                <ul>
                    <li>Participer à la création de contenu pour les réseaux sociaux.</li>
                    <li>Gérer et animer les communautés en ligne.</li>
                    <li>Analyser les performances des campagnes.</li>
                    <li>Contribuer à la stratégie de communication digitale.</li>
                </ul>
            </article>

            <article class="detail-card">
                <h2>Profil recherché</h2>
                <ul>
                    <li>Étudiant(e) en marketing, communication ou digital.</li>
                    <li>Bonne maîtrise des réseaux sociaux.</li>
                    <li>Créatif(ve) et autonome.</li>
                    <li>Une première expérience est un plus.</li>
                    <li>Intérêt pour le secteur : <?php echo htmlspecialchars($offre["entreprise_secteur"]); ?>.</li>
                </ul>
            </article>

        </div>

        <!-- ── Sidebar ── -->
        <aside class="detail-sidebar">

            <div class="sidebar-card">
                <h3>Résumé de l'offre</h3>
                <p><strong>Type :</strong> Stage</p>
                <p><strong>Entreprise :</strong> <?php echo htmlspecialchars($offre["entreprise_nom"]); ?></p>
                <p><strong>Lieu :</strong> <?php echo htmlspecialchars($offre["entreprise_adresse"]); ?></p>
                <p><strong>Secteur :</strong> <?php echo htmlspecialchars($offre["entreprise_secteur"]); ?></p>
                <p><strong>Durée :</strong> 3 à 6 mois</p>
                <p><strong>Rémunération :</strong> Oui</p>
                <p><strong>Date limite :</strong> 15/08/2026</p>
            </div>

            <div class="sidebar-card">
                <h3>Contact entreprise</h3>
                <p><strong>Email :</strong> <?php echo htmlspecialchars($offre["entreprise_email"]); ?></p>
                <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($offre["entreprise_telephone"]); ?></p>
            </div>

            <a href="postuler.php?id=<?php echo $offre['id_offre']; ?>" class="btn-apply">
                Postuler maintenant
            </a>

        </aside>

    </section>

</main>

<?php include("includes/footer.php"); ?>
