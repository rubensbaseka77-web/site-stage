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
    SELECT *
    FROM offre_stage
    WHERE id_entreprise = $id_entreprise
    ORDER BY date_publication DESC
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

        <h1>Mes offres publiées</h1>

        <table class="admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($offre = mysqli_fetch_assoc($result)) { ?>

                    <tr>
                        <td><?php echo $offre["id_offre"]; ?></td>
                        <td><?php echo $offre["titre"]; ?></td>
                        <td><?php echo $offre["description"]; ?></td>
                        <td><?php echo $offre["date_publication"]; ?></td>

                        <td>
                            <a href="../offre-detail.php?id=<?php echo $offre["id_offre"]; ?>">
                                Voir
                            </a>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </section>

</main>

<?php include("../includes/footer.php"); ?>