<?php
session_start();

include("../includes/db.php");
include("../includes/header.php");

if (!isset($_SESSION["admin"])) {
    header("Location: connexion.php");
    exit;
}

$sql = "
    SELECT 
        offre_stage.id_offre,
        offre_stage.titre,
        offre_stage.description,
        offre_stage.date_publication,
        entreprise.nom AS entreprise_nom
    FROM offre_stage
    LEFT JOIN entreprise
        ON offre_stage.id_entreprise = entreprise.id_entreprise
    ORDER BY offre_stage.date_publication DESC";

$result = mysqli_query($conn, $sql);
?>

<main class="admin-page">

    <aside class="sidebar">
        <h2>Admin</h2>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="offres.php">Gestion des offres</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </aside>

    <section class="dashboard-content">

        <h1>Gestion des offres</h1>

        <table class="admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Entreprise</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($offre = mysqli_fetch_assoc($result)) { ?>

                    <tr>
                        <td><?php echo $offre["id_offre"]; ?></td>
                        <td><?php echo $offre["titre"]; ?></td>
                        <td><?php echo $offre["entreprise_nom"]; ?></td>
                        <td><?php echo $offre["date_publication"]; ?></td>

                        <td>
                            <a href="../offre-detail.php?id=<?php echo $offre["id_offre"]; ?>">
                                Voir
                            </a>

                            |

                            <a 
                                href="supprimer-offre.php?id=<?php echo $offre["id_offre"]; ?>"
                                onclick="return confirm('Supprimer cette offre ?');"
                            >
                                Supprimer
                            </a>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>
    </section>

</main>

<?php include("../includes/footer.php"); ?>
