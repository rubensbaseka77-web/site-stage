<?php
session_start();

include("includes/db.php");

if (!isset($_GET["id"])) {
    header("Location: offres.php");
    exit;
}

$id_offre = intval($_GET["id"]);
$message = "";

$sql = "
SELECT 
    offre_stage.id_offre,
    offre_stage.titre,
    entreprise.nom AS entreprise_nom,
    entreprise.adresse AS entreprise_adresse
FROM offre_stage
LEFT JOIN entreprise
ON offre_stage.id_entreprise = entreprise.id_entreprise
WHERE offre_stage.id_offre = $id_offre
";

$result = mysqli_query($conn, $sql);
$offre = mysqli_fetch_assoc($result);

if (!$offre) {
    echo "Offre introuvable.";
    exit;
}

if (isset($_POST["postuler_btn"])) {

    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $message_candidat = mysqli_real_escape_string($conn, $_POST["message"]);

    $id_etudiant = $_SESSION["etudiant_id"] ?? 1;

    $sql_insert = "
    INSERT INTO candidature
    (id_etudiant, id_offre, date_candidature, statut)
    VALUES
    ($id_etudiant, $id_offre, NOW(), 'Nouveau')
    ";

    if (mysqli_query($conn, $sql_insert)) {
        $message = "Votre candidature a bien été envoyée.";
    } else {
        $message = "Erreur lors de l'envoi de la candidature.";
    }
}

include("includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/postuler.css?v=1">

<main class="po-page">

    <a href="offre-detail.php?id=<?php echo $id_offre; ?>" class="po-back">
        ← Retour à l'offre
    </a>

    <section class="po-hero">
        <div>
            <span class="po-badge">Candidature</span>
            <h1>Postuler à l'offre</h1>
            <p>
                <?php echo htmlspecialchars($offre["titre"]); ?> —
                <?php echo htmlspecialchars($offre["entreprise_nom"]); ?>
            </p>
        </div>
    </section>

    <section class="po-layout">

        <div class="po-card">

            <h2>Vos informations</h2>

            <?php if (!empty($message)) { ?>
                <div class="po-message">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="po-grid">
                    <div>
                        <label>Nom</label>
                        <input type="text" name="nom" required>
                    </div>

                    <div>
                        <label>Prénom</label>
                        <input type="text" name="prenom" required>
                    </div>
                </div>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Message de motivation</label>
                <textarea name="message" placeholder="Expliquez brièvement pourquoi cette offre vous intéresse."></textarea>

                <label>CV</label>
                <div class="po-upload">
                    📄 Ajouter un CV
                </div>

                <button type="submit" name="postuler_btn">
                    Envoyer ma candidature
                </button>

            </form>

        </div>

        <aside class="po-summary">
            <h3>Résumé de l'offre</h3>

            <p>
                <strong>Poste</strong><br>
                <?php echo htmlspecialchars($offre["titre"]); ?>
            </p>

            <p>
                <strong>Entreprise</strong><br>
                <?php echo htmlspecialchars($offre["entreprise_nom"]); ?>
            </p>

            <p>
                <strong>Lieu</strong><br>
                <?php echo htmlspecialchars($offre["entreprise_adresse"]); ?>
            </p>

            <p>
                <strong>Type</strong><br>
                Stage
            </p>
        </aside>

    </section>

</main>

<?php include("includes/footer.php"); ?>