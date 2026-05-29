<?php
session_start();

include("../includes/db.php");
include("../includes/header.php");

if (!isset($_SESSION["entreprise_id"])) {
    header("Location: connexion.php");
    exit;
}

$id_entreprise = $_SESSION["entreprise_id"];

$sql = "

SELECT
    candidature.id_candidature,
    etudiant.nom,
    etudiant.prenom,
    etudiant.email,
    offre_stage.titre

FROM candidature

LEFT JOIN etudiant
ON candidature.id_etudiant = etudiant.id_etudiant

LEFT JOIN offre_stage
ON candidature.id_offre = offre_stage.id_offre

WHERE offre_stage.id_entreprise = $id_entreprise

ORDER BY candidature.id_candidature DESC

";

$result = mysqli_query($conn, $sql);

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

        <h1>Candidatures reçues</h1>

        <table class="admin-table">

            <thead>

                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Offre</th>
                </tr>

            </thead>

            <tbody>

                <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <tr>

                    <td>
                        <?php echo $row["nom"]; ?>
                    </td>

                    <td>
                        <?php echo $row["prenom"]; ?>
                    </td>

                    <td>
                        <?php echo $row["email"]; ?>
                    </td>

                    <td>
                        <?php echo $row["titre"]; ?>
                    </td>

                </tr>

                <?php } ?>

            </tbody>

        </table>

    </section>

</main>

<?php
include("../includes/footer.php");
?>