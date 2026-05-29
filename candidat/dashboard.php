<?php
session_start();

include("../includes/db.php");
include("../includes/header.php");

if(!isset($_SESSION["etudiant_id"])){

    header("Location: ../connexion.php");
    exit;

}

$etudiant_nom = $_SESSION["etudiant_nom"];
$etudiant_prenom = $_SESSION["etudiant_prenom"];

?>

<main class="dashboard-page">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <h2>Espace candidat</h2>

        <ul>

            <li>
                <a href="#">
                    Tableau de bord
                </a>
            </li>

            <li>
                <a href="#">
                    Mon profil
                </a>
            </li>

            <li>
                <a href="#">
                    Mes candidatures
                </a>
                <?php

$sql_candidatures = "

SELECT
    offre_stage.titre,
    entreprise.nom AS entreprise_nom

FROM candidature

LEFT JOIN offre_stage
ON candidature.id_offre = offre_stage.id_offre

LEFT JOIN entreprise
ON offre_stage.id_entreprise = entreprise.id_entreprise

WHERE candidature.id_etudiant = $id_etudiant

ORDER BY candidature.id_candidature DESC

";

$result_candidatures = mysqli_query($conn, $sql_candidatures);

while($candidature = mysqli_fetch_assoc($result_candidatures)){

?>

<div class="candidature-card">

    <h3>
        <?php echo $candidature["titre"]; ?>
    </h3>

    <p>
        <?php echo $candidature["entreprise_nom"]; ?>
    </p>

</div>

<?php
}
?>
            </li>

            <li>
                <a href="../offres.php">
                    Offres de stage
                </a>
            </li>

            <li>
                <a href="../deconnexion.php">
                    Déconnexion
                </a>
            </li>
<li>
    <a href="profil.php">
        Mon profil
    </a>
</li>
        </ul>

    </aside>

    <!-- CONTENU -->

    <section class="dashboard-content">

        <div class="dashboard-header">

            <h1>
                Bonjour 
                <?php echo $etudiant_prenom; ?>
                👋
            </h1>

            <p>
                Bienvenue sur votre espace candidat.
            </p>

        </div>

        <!-- STATS -->

        <div class="stats-container">

            <div class="stat-card">
                <h3>12</h3>
                <p>Candidatures</p>
            </div>

            <div class="stat-card">
                <h3>5</h3>
                <p>Entretiens</p>
            </div>

            <div class="stat-card">
                <h3>2</h3>
                <p>Offres sauvegardées</p>
            </div>

        </div>

        <!-- OFFRES -->

        <div class="dashboard-section">

            <div class="section-header">

                <h2>Offres recommandées</h2>

                <a href="../offres.php">
                    Voir toutes les offres
                </a>

            </div>

            <div class="dashboard-offres">

                <?php

                $sql = "
                SELECT *
                FROM offre_stage
                ORDER BY date_publication DESC
                LIMIT 3
                ";

                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)){

                ?>

                    <div class="dashboard-offre-card">

                        <h3>
                            <?php echo $row["titre"]; ?>
                        </h3>

                        <p>
                            <?php echo $row["description"]; ?>
                        </p>

                        <a href="../offre-detail.php?id=<?php echo $row["id_offre"]; ?>">
                            Voir l'offre
                        </a>

                    </div>

                <?php
                }
                ?>

            </div>

        </div>

    </section>

</main>

<?php
include("../includes/footer.php");
?>