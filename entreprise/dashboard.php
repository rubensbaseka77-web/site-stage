<?php
session_start();

include("../includes/db.php");
include("../includes/header.php");

if (!isset($_SESSION["entreprise_id"])) {
    header("Location: connexion.php");
    exit;
}

$id_entreprise = $_SESSION["entreprise_id"];
$nom_entreprise = $_SESSION["entreprise_nom"];

$nb_offres = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM offre_stage WHERE id_entreprise = $id_entreprise"
))["total"];

$nb_candidatures = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "
    SELECT COUNT(*) AS total
    FROM candidature
    LEFT JOIN offre_stage
        ON candidature.id_offre = offre_stage.id_offre
    WHERE offre_stage.id_entreprise = $id_entreprise
    "
))["total"];
?>

<main class="dashboard-page">

    <aside class="sidebar">
        <h2>Espace entreprise</h2>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="publier-offre.php">Publier une offre</a></li>
            <li><a href="mes-offres.php">Mes offres</a></li>
            <li><a href="candidatures.php">Candidatures</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </aside>

    <section class="dashboard-content">

        <h1>Bienvenue <?php echo $nom_entreprise; ?></h1>

        <div class="stats-container">

            <div class="stat-card">
                <h3><?php echo $nb_offres; ?></h3>
                <p>Offres publiées</p>
            </div>

            <div class="stat-card">
                <h3><?php echo $nb_candidatures; ?></h3>
                <p>Candidatures reçues</p>
            </div>

        </div>

        <a href="publier-offre.php" class="btn-primary">
            Publier une offre
        </a>

    </section>

</main>

<?php include("../includes/footer.php"); ?>