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
    FROM offre_stage
    WHERE id_entreprise = $id_entreprise
    ORDER BY date_publication DESC
";

$result = mysqli_query($conn, $sql);
$nb_offres = mysqli_num_rows($result);

include("../includes/header-entreprise.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/mes-offres.css?v=50">

<main class="mo-page">

    <aside class="mo-sidebar">
        <h2>Espace entreprise</h2>
        <p>Gérez vos offres et vos candidatures</p>

        <a class="active" href="mes-offres.php">▣ Mes offres</a>
        <a href="candidatures.php">♧ Candidatures reçues</a>
        <a href="mon-entreprise.php">▯ Mon entreprise</a>
        <a href="parametres.php">⚙ Paramètres</a>
        <a href="deconnexion.php">↪ Déconnexion</a>
    </aside>

    <section class="mo-content">

        <h1>Mes offres</h1>
        <p class="mo-subtitle">Retrouvez toutes les offres de stage que vous avez publiées</p>

        <div class="mo-stats">
            <div class="mo-stat">
                <h2><?php echo $nb_offres; ?></h2>
                <p>Offres publiées</p>
            </div>

            <div class="mo-stat">
                <h2>456</h2>
                <p>Vues au total</p>
            </div>

            <div class="mo-stat">
                <h2>124</h2>
                <p>Candidatures reçues</p>
            </div>
        </div>

        <div class="mo-filter">
            Trier par : Plus récentes ˅
        </div>

        <div class="mo-tabs">
            <span class="active">Toutes</span>
            <span>Actives</span>
            <span>En pause</span>
            <span>Fermées</span>
        </div>

        <div class="mo-list">

            <?php if ($nb_offres == 0) { ?>

                <div class="mo-row">
                    <div>
                        <h3>Aucune offre publiée</h3>
                        <p>Publiez une première offre pour la voir ici.</p>
                    </div>

                    <a href="publier-offre.php" class="mo-btn">Publier</a>
                </div>

            <?php } else { ?>

                <?php while ($offre = mysqli_fetch_assoc($result)) { ?>

                    <div class="mo-row">
                        <div>
                            <h3><?php echo htmlspecialchars($offre["titre"]); ?></h3>
                            <p>
                                Stage • Publiée le
                                <?php echo date("d/m/Y", strtotime($offre["date_publication"])); ?>
                            </p>
                        </div>

                        <span class="mo-status">Active</span>

                        <a class="mo-btn" href="../offre-detail.php?id=<?php echo $offre["id_offre"]; ?>">
                            Voir
                        </a>
                    </div>

                <?php } ?>

            <?php } ?>

        </div>

    </section>

</main>

<?php include("../includes/footer-entreprise.php"); ?>