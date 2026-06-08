<?php
session_start();

if (!isset($_SESSION["entreprise_id"])) {
    header("Location: connexion.php");
    exit;
}

include("../includes/db.php");

$id_entreprise = $_SESSION["entreprise_id"];
$nom_entreprise = $_SESSION["entreprise_nom"] ?? "Entreprise";

$req_offres = mysqli_query($conn, "SELECT COUNT(*) AS total FROM offre_stage WHERE id_entreprise = $id_entreprise");
$nb_offres = mysqli_fetch_assoc($req_offres)["total"] ?? 0;

$req_candidatures = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM candidature 
    LEFT JOIN offre_stage ON candidature.id_offre = offre_stage.id_offre 
    WHERE offre_stage.id_entreprise = $id_entreprise
");
$nb_candidatures = mysqli_fetch_assoc($req_candidatures)["total"] ?? 0;

include("../includes/header-entreprise.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/dashboard-entreprise.css?v=1">

<main class="db-page">

    <aside class="db-sidebar">
        <h2>Espace entreprise</h2>
        <p>Gérez vos offres et vos candidatures</p>

        <a class="active" href="dashboard.php">▣ Dashboard</a>
        <a href="publier-offre.php">＋ Publier une offre</a>
        <a href="mes-offres.php">▣ Mes offres</a>
        <a href="candidatures.php">♧ Candidatures reçues</a>
        <a href="deconnexion.php">↪ Déconnexion</a>
    </aside>

    <section class="db-content">

        <h1>Bienvenue <?php echo htmlspecialchars($nom_entreprise); ?></h1>
        <p class="db-subtitle">Voici un aperçu rapide de votre espace entreprise.</p>

        <div class="db-stats">
            <div class="db-stat">
                <h2><?php echo $nb_offres; ?></h2>
                <p>Offres publiées</p>
            </div>

            <div class="db-stat">
                <h2><?php echo $nb_candidatures; ?></h2>
                <p>Candidatures reçues</p>
            </div>

            <div class="db-stat">
                <h2>456</h2>
                <p>Vues au total</p>
            </div>
        </div>

        <div class="db-actions">
            <a href="publier-offre.php">Publier une offre</a>
            <a href="mes-offres.php">Voir mes offres</a>
            <a href="candidatures.php">Voir les candidatures</a>
        </div>

    </section>

</main>

<?php include("../includes/footer-entreprise.php"); ?>