<?php
include("includes/db.php");
include("includes/header.php");

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
ORDER BY offre_stage.date_publication DESC
";

$result = mysqli_query($conn, $sql);
?>

<main class="offres-page">

    <section class="offres-header">
        <h1>Offres de stage</h1>
        <p>Trouvez le stage qui correspond à vos compétences et à vos envies.</p>
    </section>

    <section class="search-bar">
        <input type="text" placeholder="Métier, mot-clé, entreprise...">
        <input type="text" placeholder="Lieu">
        <select>
            <option>Tous les domaines</option>
            <option>Marketing</option>
            <option>Développement</option>
            <option>Design</option>
        </select>
        <button>Rechercher</button>
    </section>

    <section class="offers-list">

        <div class="filter-line">
            <button>Filtres</button>
            <span><?php echo mysqli_num_rows($result); ?> offres trouvées</span>
        </div>

        <?php while($offre = mysqli_fetch_assoc($result)){ ?>

            <article class="offer-card">

                <div class="offer-logo">
                    <span><?php echo strtoupper(substr($offre["entreprise_nom"], 0, 1)); ?></span>
                </div>

                <div class="offer-content">

                    <span class="category">Stage</span>

                    <h2><?php echo $offre["titre"]; ?></h2>

                    <div class="offer-meta">
                        <span><?php echo $offre["entreprise_nom"]; ?></span>
                        <span>📍 <?php echo $offre["entreprise_adresse"]; ?></span>
                        <span>🕒 il y a 2 jours</span>
                    </div>

                    <p><?php echo $offre["description"]; ?></p>

                    <div class="tags">
                        <span>Stage</span>
                        <span>3 à 6 mois</span>
                        <span>Rémunéré</span>
                    </div>

                </div>

                <a class="offer-link" href="offre-detail.php?id=<?php echo $offre['id_offre']; ?>">
                    Voir l’offre
                </a>

            </article>

        <?php } ?>

    </section>

</main>

<?php include("includes/footer.php"); ?>