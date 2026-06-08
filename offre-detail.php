<?php
session_start();

include("includes/db.php");

if(!isset($_GET["id"])){
    header("Location: offres.php");
    exit;
}

if(isset($_GET["prototype"])){
    $prototypes = [
        "prototype-1" => [
            "id_offre" => "prototype-1",
            "titre" => "Stagiaire Marketing Digital",
            "description" => "Rejoignez notre équipe marketing et participez à la stratégie digitale.",
            "date_publication" => date("Y-m-d", strtotime("-2 days")),
            "entreprise_nom" => "Webiner",
            "entreprise_adresse" => "Paris, France"
        ],
        "prototype-2" => [
            "id_offre" => "prototype-2",
            "titre" => "Stagiaire Développeur Web",
            "description" => "Participation au développement de nos applications web.",
            "date_publication" => date("Y-m-d", strtotime("-3 days")),
            "entreprise_nom" => "CodeLab",
            "entreprise_adresse" => "Lyon, France"
        ]
    ];

    $offre = $prototypes[$_GET["id"]] ?? null;

    if(!$offre){
        echo "Offre introuvable.";
        exit;
    }
} else {
    $id = intval($_GET["id"]);

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
    WHERE offre_stage.id_offre = $id
    ";

    $result = mysqli_query($conn, $sql);
    $offre = mysqli_fetch_assoc($result);

    if(!$offre){
        echo "Offre introuvable.";
        exit;
    }
}

include("includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/offre-detail.css?v=1">

<main class="od-page">

    <a href="offres.php" class="od-back">← Retour aux offres</a>

    <section class="od-hero">

        <div>
            <span class="od-badge">Stage</span>

            <h1><?php echo htmlspecialchars($offre["titre"]); ?></h1>

            <p class="od-company">
                <?php echo htmlspecialchars($offre["entreprise_nom"]); ?> •
                <?php echo htmlspecialchars($offre["entreprise_adresse"]); ?>
            </p>

            <div class="od-tags">
                <span>3 à 6 mois</span>
                <span>Rémunéré</span>
                <span>Temps plein</span>
            </div>
        </div>

        <div class="od-logo">
            <?php echo strtoupper(substr($offre["entreprise_nom"], 0, 1)); ?>
        </div>

    </section>

    <section class="od-layout">

        <div class="od-main">

            <div class="od-card">
                <h2>Description de l'offre</h2>
                <p>
                    <?php echo htmlspecialchars($offre["description"]); ?>
                </p>
            </div>

            <div class="od-card">
                <h2>Missions</h2>
                <ul>
                    <li>Participer aux projets de l'entreprise</li>
                    <li>Travailler avec une équipe professionnelle</li>
                    <li>Contribuer au développement de l'activité</li>
                    <li>Réaliser les tâches confiées avec sérieux</li>
                </ul>
            </div>

            <div class="od-card">
                <h2>Profil recherché</h2>
                <ul>
                    <li>Étudiant motivé et sérieux</li>
                    <li>Bonne capacité d'adaptation</li>
                    <li>Esprit d'équipe</li>
                    <li>Autonomie et rigueur</li>
                </ul>
            </div>

        </div>

        <aside class="od-sidebar">

            <a class="od-apply" href="postuler.php?id=<?php echo urlencode($offre['id_offre']); ?>">
                Postuler
            </a>

            <button class="od-save">♡ Sauvegarder</button>

            <div class="od-info">
                <h3>Informations</h3>

                <p><strong>Entreprise</strong><br><?php echo htmlspecialchars($offre["entreprise_nom"]); ?></p>
                <p><strong>Lieu</strong><br><?php echo htmlspecialchars($offre["entreprise_adresse"]); ?></p>
                <p><strong>Contrat</strong><br>Stage</p>
                <p><strong>Durée</strong><br>3 à 6 mois</p>
                <p><strong>Publication</strong><br><?php echo htmlspecialchars($offre["date_publication"]); ?></p>
            </div>

        </aside>

    </section>

</main>

<?php include("includes/footer.php"); ?>