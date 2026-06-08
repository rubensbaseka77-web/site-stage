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
        candidature.id_candidature,
        etudiant.nom AS etudiant_nom,
        etudiant.prenom AS etudiant_prenom,
        etudiant.email AS etudiant_email,
        offre_stage.titre AS offre_titre,
        entreprise.nom AS entreprise_nom
    FROM candidature
    LEFT JOIN etudiant
        ON candidature.id_etudiant = etudiant.id_etudiant
    LEFT JOIN offre_stage
        ON candidature.id_offre = offre_stage.id_offre
    LEFT JOIN entreprise
        ON offre_stage.id_entreprise = entreprise.id_entreprise
    ORDER BY candidature.id_candidature DESC
";

$result = mysqli_query($conn, $sql);
?>

<main class="admin-page">

    <aside class="sidebar">
        <h2>Admin</h2>

        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="offres.php">Gestion des offres</a></li>
            <li><a href="candidatures.php">Candidatures</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </aside>

    <section class="dashboard-content">

        <h1>Candidatures reçues</h1>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Étudiant</th>
                    <th>Email</th>
                    <th>Offre</th>
                    <th>Entreprise</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($candidature = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $candidature["id_candidature"]; ?></td>
                        <td>
                            <?php echo $candidature["prenom_etudiant"] ?? $candidature["etudiant_prenom"]; ?>
                            <?php echo $candidature["etudiant_nom"]; ?>
                        </td>
                        <td><?php echo $candidature["etudiant_email"]; ?></td>
                        <td><?php echo $candidature["offre_titre"]; ?></td>
                        <td><?php echo $candidature["entreprise_nom"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </section>

</main>

<?php include("../includes/footer.php"); ?>