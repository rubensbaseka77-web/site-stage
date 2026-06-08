<?php
session_start();

include("../includes/db.php");

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

<?php include("../includes/header-entreprise.php"); ?>

<main class="publication-page">
<link rel="stylesheet" href="../assets/css/publier-offre.css">
<link rel="stylesheet" href="/site_stage/assets/css/mes-offres.css?v=1">
<a href="mes-offres.php" class="back-link">‹</a>

    <div class="publication-header">
        <h1>Publier une offre de stage</h1>
        <p>Trouvez les meilleurs talents pour votre entreprise</p>
    </div>

    <div class="publication-grid">

        <div class="steps">
            <div class="step active">1 Informations générales</div>
            <div class="step">2 Détails de l'offre</div>
            <div class="step">3 Profil recherché</div>
            <div class="step">4 Récapitulatif</div>

            <p class="required-note"><span>*</span> Champs obligatoires</p>
        </div>

        <div class="publish-card">
            <h2>Informations générales</h2>

            <form method="POST" class="enterprise-form">
                <label>Titre de l'offre *</label>
                <input type="text" name="titre" placeholder="Ex : Développeur Web" required>

                <label>Description *</label>
                <textarea name="description" placeholder="Décrivez le stage..." required></textarea>

                <button type="submit" name="publier_btn">
                    Publier l'offre →
                </button>
            </form>
        </div>

    </div>

</main>
<?php include("../includes/footer-entreprise.php"); ?>