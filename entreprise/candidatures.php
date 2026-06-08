<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION["entreprise_id"])) {
    header("Location: connexion.php");
    exit;
}

$id_entreprise = $_SESSION["entreprise_id"];

$sql = "
SELECT
    candidature.id_candidature,
    candidature.date_candidature,
    candidature.statut,
    etudiant.nom,
    etudiant.prenom,
    etudiant.email,
    offre_stage.titre
FROM candidature
LEFT JOIN etudiant ON candidature.id_etudiant = etudiant.id_etudiant
LEFT JOIN offre_stage ON candidature.id_offre = offre_stage.id_offre
WHERE offre_stage.id_entreprise = $id_entreprise
ORDER BY candidature.id_candidature DESC
";

$result = mysqli_query($conn, $sql);
$nb_candidatures = mysqli_num_rows($result);

include("../includes/header-entreprise.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/candidatures.css?v=20">

<main class="cand-page">

    <aside class="cand-sidebar">
        <h2>Espace entreprise</h2>
        <p>Gérez vos offres et vos candidatures</p>

        <a href="mes-offres.php">▣ Mes offres</a>
        <a class="active" href="candidatures.php">♧ Candidatures reçues</a>
       <a href="mon-entreprise.php">▯ Mon entreprise</a>
        <a href="parametres.php">⚙ Paramètres</a>
        <a href="deconnexion.php">↪ Déconnexion</a>
    </aside>

    <section class="cand-content">

        <div class="cand-top">
            <div>
                <h1>Candidatures reçues</h1>
                <p>Consultez et gérez les candidatures reçues pour vos offres</p>
            </div>

            <select>
                <option>Toutes les offres</option>
            </select>
        </div>

        <div class="cand-stats">
            <div class="cand-stat blue">
                <h2><?php echo $nb_candidatures; ?></h2>
                <p>Candidatures totales</p>
                <span>Voir toutes</span>
            </div>

            <div class="cand-stat green">
                <h2>36</h2>
                <p>Nouvelles</p>
                <span>Voir nouvelles</span>
            </div>

            <div class="cand-stat orange">
                <h2>52</h2>
                <p>En cours d’examen</p>
                <span>Voir en cours</span>
            </div>

            <div class="cand-stat purple">
                <h2>36</h2>
                <p>Archivées</p>
                <span>Voir archivées</span>
            </div>
        </div>

        <div class="cand-labels">
            <span>Candidat</span>
            <span>Offre</span>
            <span>Date</span>
            <span>Statut</span>
            <span>Actions</span>
        </div>

        <div class="cand-list">

            <?php if ($nb_candidatures == 0) { ?>

   <div class="empty-state">
    <h3>Aucune candidature reçue</h3>
    <p>Les candidatures apparaîtront ici dès qu'un étudiant postule.</p>

    <a href="mes-offres.php" class="btn-primary">
        Voir mes offres
    </a>
</div>
            <?php } else { ?>

                <?php while($row = mysqli_fetch_assoc($result)){ ?>

                    <div class="cand-row">

                        <div class="cand-user">
                            <strong><?php echo htmlspecialchars($row["prenom"] . " " . $row["nom"]); ?></strong>
                            <small><?php echo htmlspecialchars($row["email"]); ?></small>
                        </div>

                        <div class="cand-offre">
                            <strong><?php echo htmlspecialchars($row["titre"]); ?></strong>
                        </div>

                        <div>
                            <?php echo date("d M Y", strtotime($row["date_candidature"])); ?>
                        </div>

                        <div>
                            <span class="badge">Nouveau</span>
                        </div>

                        <div>
                            <a href="#" class="cv-btn">Voir le CV</a>
                        </div>

                    </div>

                <?php } ?>

            <?php } ?>

        </div>

    </section>

</main>

<?php include("../includes/footer-entreprise.php"); ?>