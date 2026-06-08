<?php
session_start();

include("../includes/db.php");

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

include("../includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/profil-candidat.css?v=1">

<main class="pc-page">

    <aside class="pc-sidebar">
        <h2>Espace candidat</h2>
        <p>Gérez vos candidatures et votre profil</p>

        <a href="dashboard.php">▣ Tableau de bord</a>
        <a class="active" href="profil.php">👤 Mon profil</a>
        <a href="mes-candidatures.php">📝 Mes candidatures</a>
        <a href="soutenance.php">🎓 Soutenance</a>
        <a href="convention.php">📄 Convention de stage</a>
        <a href="historique.php">🕒 Historique</a>
                <a href="parametres.php">⚙ Paramètres</a>

    </aside>

    <section class="pc-content">

        <h1>Mon profil</h1>
        <p class="pc-subtitle">Consultez vos informations personnelles.</p>

        <div class="pc-card">

            <h2>Informations personnelles</h2>

            <div class="pc-info">
                <span>Nom</span>
                <strong><?php echo htmlspecialchars($etudiant["nom"]); ?></strong>
            </div>

            <div class="pc-info">
                <span>Prénom</span>
                <strong><?php echo htmlspecialchars($etudiant["prenom"]); ?></strong>
            </div>

            <div class="pc-info">
                <span>Email</span>
                <strong><?php echo htmlspecialchars($etudiant["email"]); ?></strong>
            </div>

            <a href="parametres.php" class="pc-btn">
                Modifier mon profil
            </a>

        </div>

    </section>

</main>

<?php include("../includes/footer.php"); ?>