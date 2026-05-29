<?php
include("includes/db.php");
include("includes/header.php");

$search = "";

if (isset($_GET["search"])) {
    $search = mysqli_real_escape_string($conn, $_GET["search"]);
}

$sql = "
    SELECT 
        offre_stage.id_offre,
        offre_stage.titre,
        offre_stage.description,
        offre_stage.date_publication,
        entreprise.nom AS entreprise_nom,
        entreprise.adresse AS entreprise_adresse
    FROM offre_stage
    LEFT JOIN entreprise 
        ON offre_stage.id_entreprise = entreprise.id_entreprise
";

if (!empty($search)) {
    $sql .= "
        WHERE offre_stage.titre LIKE '%$search%'
        OR offre_stage.description LIKE '%$search%'
        OR entreprise.nom LIKE '%$search%'
    ";
}

$sql .= " ORDER BY offre_stage.date_publication DESC";

$result = mysqli_query($conn, $sql);
?>

<main class="offres-page">

    <section class="page-title">
        <h1>Offres de stage</h1>
        <p>Trouvez le stage qui correspond à vos compétences et à vos envies.</p>
    </section>

    <section class="offres-search-section">

        <form method="GET" class="offres-search-form">

            <input 
                type="text" 
                name="search" 
                placeholder="Métier, mot-clé, entreprise..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <select name="categorie">
                <option value="">Tous les domaines</option>
                <option value="Marketing">Marketing</option>
                <option value="Développement">Développement</option>
                <option value="Design">Design</option>
                <option value="Communication">Communication</option>
            </select>

            <button type="submit">Rechercher</button>

        </form>

    </section>

    <section class="offres-list">

        <div class="offres-filter-line">
            <button class="filter-btn">Filtres</button>

            <p>
                <?php echo mysqli_num_rows($result); ?> offre(s) trouvée(s)
            </p>
        </div>

        <?php if (mysqli_num_rows($result) > 0) { ?>

            <?php while ($offre = mysqli_fetch_assoc($result)) { ?>

                <article class="offre-card-large">

                    <div class="offre-logo">
                        <span>
                            <?php echo strtoupper(substr($offre["entreprise_nom"], 0, 1)); ?>
                        </span>
                    </div>

                    <div class="offre-content">

                        <span class="offre-category">
                            Stage
                        </span>

                        <h2>
                            <?php echo htmlspecialchars($offre["titre"]); ?>
                        </h2>

                        <div class="offre-meta">
                            <span><?php echo htmlspecialchars($offre["entreprise_nom"]); ?></span>
                            <span>📍 <?php echo htmlspecialchars($offre["entreprise_adresse"]); ?></span>
                            <span>🕒 il y a quelques jours</span>
                        </div>

                        <p>
                            <?php echo htmlspecialchars($offre["description"]); ?>
                        </p>

                        <div class="offre-tags">
                            <span>Stage</span>
                            <span>3 à 6 mois</span>
                            <span>Rémunéré</span>
                        </div>

                    </div>

                    <div class="offre-action">
                        <a href="offre-detail.php?id=<?php echo $offre['id_offre']; ?>">
                            Voir l’offre
                        </a>
                    </div>

                </article>

            <?php } ?>

        <?php } else { ?>

            <p class="empty-message">
                Aucune offre ne correspond à votre recherche.
            </p>

        <?php } ?>

    </section>

</main>

<?php
include("includes/footer.php");
?>