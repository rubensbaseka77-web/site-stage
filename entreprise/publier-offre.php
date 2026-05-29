<?php
session_start();

include("../includes/db.php");
include("../includes/header.php");

if (!isset($_SESSION["entreprise_id"])) {
    header("Location: connexion.php");
    exit;
}

$message = "";
$id_entreprise = $_SESSION["entreprise_id"];

if (isset($_POST["publier_btn"])) {

    $titre = mysqli_real_escape_string($conn, $_POST["titre"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    $sql = "
        INSERT INTO offre_stage
        (titre, description, date_publication, id_entreprise)
        VALUES
        ('$titre', '$description', NOW(), $id_entreprise)
    ";

    if (mysqli_query($conn, $sql)) {
        $message = "Offre publiée avec succès.";
    } else {
        $message = "Erreur lors de la publication.";
    }
}
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

        <h1>Publier une offre de stage</h1>

        <?php if (!empty($message)) { ?>
            <p class="success-message"><?php echo $message; ?></p>
        <?php } ?>

        <form method="POST" class="auth-form">

            <div class="form-group">
                <label>Titre de l’offre</label>
                <input type="text" name="titre" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required></textarea>
            </div>

            <button type="submit" name="publier_btn">
                Publier l’offre
            </button>

        </form>

    </section>

</main>

<?php include("../includes/footer.php"); ?>