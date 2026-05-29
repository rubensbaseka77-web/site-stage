<?php
session_start();

include("../includes/db.php");
include("../includes/header.php");

if (!isset($_SESSION["admin"])) {
    header("Location: connexion.php");
    exit;
}

$nb_etudiants = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM etudiant"))["total"];
$nb_offres = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM offre_stage"))["total"];
$nb_candidatures = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM candidature"))["total"];
$nb_entreprises = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM entreprise"))["total"];
?>

<main class="admin-page">

    <aside class="sidebar">
        <h2>Admin</h2>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
<li><a href="offres.php">Gestion des offres</a></li>
<li><a href="deconnexion.php">Déconnexion</a></li>
<li><a href="candidatures.php">Candidatures</a></li>
        </ul>
    </aside>

    <section class="dashboard-content">

        <h1>Tableau de bord administrateur</h1>

        <div class="stats-container">

            <div class="stat-card">
                <h3><?php echo $nb_etudiants; ?></h3>
                <p>Étudiants</p>
            </div>

            <div class="stat-card">
                <h3><?php echo $nb_offres; ?></h3>
                <p>Offres</p>
            </div>

            <div class="stat-card">
                <h3><?php echo $nb_candidatures; ?></h3>
                <p>Candidatures</p>
            </div>

            <div class="stat-card">
                <h3><?php echo $nb_entreprises; ?></h3>
                <p>Entreprises</p>
            </div>

        </div>

    </section>

</main>

<?php include("../includes/footer.php"); ?>