<?php
session_start();

include("../includes/db.php");
include("../includes/header.php");

if (!isset($_SESSION["etudiant_id"])) {
    header("Location: ../connexion.php");
    exit;
}

$id_etudiant = $_SESSION["etudiant_id"];

$sql = "
SELECT *
FROM etudiant
WHERE id_etudiant = $id_etudiant
";

$result = mysqli_query($conn, $sql);

$etudiant = mysqli_fetch_assoc($result);
?>

<main class="dashboard-page">

    <aside class="sidebar">

        <h2>Espace candidat</h2>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profil.php">Mon profil</a></li>
            <li><a href="candidatures.php">Mes candidatures</a></li>
            <li><a href="../offres.php">Offres</a></li>
            <li><a href="../deconnexion.php">Déconnexion</a></li>
        </ul>

    </aside>

    <section class="dashboard-content">

        <h1>Mon profil</h1>

        <div class="profil-card">

            <h3>Informations personnelles</h3>

            <p>
                <strong>Nom :</strong>
                <?php echo $etudiant["nom"]; ?>
            </p>

            <p>
                <strong>Prénom :</strong>
                <?php echo $etudiant["prenom"]; ?>
            </p>

            <p>
                <strong>Email :</strong>
                <?php echo $etudiant["email"]; ?>
            </p>

        </div>

    </section>

</main>

<?php include("../includes/footer.php"); ?>