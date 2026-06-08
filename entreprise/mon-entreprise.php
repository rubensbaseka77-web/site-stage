<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION["entreprise_id"])) {
    header("Location: connexion.php");
    exit;
}

$id_entreprise = $_SESSION["entreprise_id"];

$sql = "
    SELECT *
    FROM entreprise
    WHERE id_entreprise = $id_entreprise
    LIMIT 1
";

$result = mysqli_query($conn, $sql);
$entreprise = mysqli_fetch_assoc($result);

include("../includes/header-entreprise.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/mon-entreprise.css?v=1">

<main class="me-page">

    <aside class="me-sidebar">
        <h2>Espace entreprise</h2>
        <p>Gérez vos offres et vos candidatures</p>

        <a href="mes-offres.php">▣ Mes offres</a>
        <a href="candidatures.php">♧ Candidatures reçues</a>
        <a class="active" href="mon-entreprise.php">▯ Mon entreprise</a>
        <a href="parametres.php">⚙ Paramètres</a>
<a href="deconnexion.php">↪ Déconnexion</a>    </aside>

    <section class="me-content">

        <h1>Mon entreprise</h1>
        <p class="me-subtitle">Consultez les informations de votre entreprise.</p>

        <div class="me-card">

            <h2>
                <?php echo htmlspecialchars($entreprise["nom"]); ?>
            </h2>

            <div class="me-info">
                <span>Email</span>
                <strong><?php echo htmlspecialchars($entreprise["email"]); ?></strong>
            </div>

            <div class="me-info">
                <span>Secteur</span>
                <strong>Développement web</strong>
            </div>

            <div class="me-info">
                <span>Ville</span>
                <strong>Paris</strong>
            </div>

            <a href="parametres.php" class="me-btn">
                Modifier les informations
            </a>

        </div>

    </section>

</main>

<?php include("../includes/footer-entreprise.php"); ?>