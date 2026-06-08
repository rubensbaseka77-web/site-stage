<?php
session_start();

include(__DIR__ . '/../includes/db.php');

if (!isset($_SESSION["etudiant_id"])) {
    $_SESSION["etudiant_id"] = 1;
    $_SESSION["etudiant_nom"] = "Baseka";
    $_SESSION["etudiant_prenom"] = "Rubens";
}

$etudiant_nom = $_SESSION["etudiant_nom"];
$etudiant_prenom = $_SESSION["etudiant_prenom"];
$id_etudiant = $_SESSION["etudiant_id"];

$sql = "
SELECT *
FROM offre_stage
ORDER BY date_publication DESC
LIMIT 3
";
$result = mysqli_query($conn, $sql);

include(__DIR__ . '/../includes/header.php');
?>

<link rel="stylesheet" href="/site_stage/assets/css/dashboard-etudiant.css?v=1">

<main class="ed-page">

    <aside class="ed-sidebar">
        <h2>Espace candidat</h2>
        <p>Gérez vos candidatures et votre profil</p>

        <a class="active" href="dashboard.php">▣ Tableau de bord</a>
        <a href="profil.php">👤 Mon profil</a>
<a href="mes-candidatures.php">📝 Mes candidatures</a>
        <a href="soutenance.php">🎓 Soutenance</a>
        <a href="convention.php">📄 Convention de stage</a>
        <a href="historique.php">🕒 Historique</a>
<a href="parametres.php">⚙ Paramètres</a>    </aside>

    <section class="ed-content">

        <h1>Bonjour <?php echo htmlspecialchars($etudiant_prenom); ?> 👋</h1>
        <p class="ed-subtitle">Bienvenue sur votre espace candidat.</p>

        <div class="ed-stats">
            <div class="ed-stat">
                <h2>12</h2>
                <p>Candidatures</p>
            </div>

            <div class="ed-stat">
                <h2>5</h2>
                <p>Entretiens</p>
            </div>

            <div class="ed-stat">
                <h2>2</h2>
                <p>Offres sauvegardées</p>
            </div>
        </div>

        <div class="ed-section">
            <div class="ed-section-header">
                <h2>Offres recommandées</h2>
                <a href="../offres.php">Voir toutes les offres</a>
            </div>

            <div class="ed-offres">
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <div class="ed-offre-card">
                        <h3><?php echo htmlspecialchars($row["titre"]); ?></h3>
                        <p><?php echo htmlspecialchars($row["description"]); ?></p>

                        <a href="../offre-detail.php?id=<?php echo $row["id_offre"]; ?>">
                            Voir l'offre
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="ed-section">
            <div class="ed-section-header">
                <h2>Candidatures récentes</h2>
                <a href="mes-candidatures.php">Voir toutes mes candidatures</a>
            </div>

            <div class="ed-candidatures">

                <div class="ed-candidature-row">
                    <div>
                        <h3>Stagiaire Marketing Digital</h3>
                        <p>Webnov · Paris, France</p>
                    </div>
                    <span class="ed-status">En attente</span>
                </div>

                <div class="ed-candidature-row">
                    <div>
                        <h3>Stagiaire Développeur Web</h3>
                        <p>CodeLab · Lyon, France</p>
                    </div>
                    <span class="ed-status">Vue</span>
                </div>

            </div>
        </div>

    </section>

</main>

<?php include(__DIR__ . "/../includes/footer.php"); ?>