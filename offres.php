<?php
include("includes/db.php");
include("includes/header.php");

$search    = "";
$categorie = "";

if (isset($_GET["search"])) {
    $search = mysqli_real_escape_string($conn, $_GET["search"]);
}
if (isset($_GET["categorie"])) {
    $categorie = mysqli_real_escape_string($conn, $_GET["categorie"]);
}

// Couleurs par catégorie
$category_colors = [
    "Marketing"      => ["bg" => "#FFF3E0", "text" => "#E65100", "dot" => "#FF9800"],
    "Développement"  => ["bg" => "#E8F5E9", "text" => "#1B5E20", "dot" => "#4CAF50"],
    "Design"         => ["bg" => "#FCE4EC", "text" => "#880E4F", "dot" => "#E91E63"],
    "Communication"  => ["bg" => "#E3F2FD", "text" => "#0D47A1", "dot" => "#2196F3"],
    "default"        => ["bg" => "#F3E5F5", "text" => "#4A148C", "dot" => "#9C27B0"],
];

// ── Offres statiques du prototype ──────────────────────────────────────────
$offres_prototype = [
    [
        "id_offre"          => "prototype-1",
        "titre"             => "Stagiaire Marketing Digital",
        "description"       => "Rejoignez notre équipe marketing et participez à la stratégie digitale de nos clients. Community management, création de contenu, analyse de performance.",
        "date_publication"  => date("Y-m-d", strtotime("-2 days")),
        "categorie"         => "Marketing",
        "duree"             => "3 à 6 mois",
        "remuneration"      => "Rémunéré",
        "entreprise_nom"    => "Webiner",
        "entreprise_adresse"=> "Paris, France",
        "entreprise_logo"   => "",  
    ],
    [
        "id_offre"          => "prototype-2",
        "titre"             => "Stagiaire Développeur Web",
        "description"       => "Participez au développement de nos applications web en utilisant des technologies modernes au sein d'une équipe passionnée.",
        "date_publication"  => date("Y-m-d", strtotime("-3 days")),
        "categorie"         => "Développement",
        "duree"             => "2 à 6 mois",
        "remuneration"      => "Rémunéré",
        "entreprise_nom"    => "CodeLab",
        "entreprise_adresse"=> "Lyon, France",
        "entreprise_logo"   => "",
    ],
    [
        "id_offre"          => "prototype-3",
        "titre"             => "Stagiaire UX/UI Designer",
        "description"       => "Rejoignez notre équipe marketing et participez à la stratégie digitale de nos clients. Community management, création de contenu, analyse de performance.",
        "date_publication"  => date("Y-m-d", strtotime("-5 days")),
        "categorie"         => "Design",
        "duree"             => "2 à 6 mois",
        "remuneration"      => "Rémunéré",
        "entreprise_nom"    => "DesignStudio",
        "entreprise_adresse"=> "Bordeaux, France",
        "entreprise_logo"   => "",
    ],
    [
        "id_offre"          => "prototype-4",
        "titre"             => "Stagiaire Communication",
        "description"       => "Participez à la stratégie de communication de l'agence et à la gestion des réseaux sociaux.",
        "date_publication"  => date("Y-m-d", strtotime("-4 days")),
        "categorie"         => "Communication",
        "duree"             => "2 à 6 mois",
        "remuneration"      => "Rémunéré",
        "entreprise_nom"    => "Astra",
        "entreprise_adresse"=> "Lille, France",
        "entreprise_logo"   => "",
    ],
];

// ── Requête BDD (offres réelles) ────────────────────────────────────────────
$sql = "
SELECT
    offre_stage.id_offre,
    offre_stage.titre,
    offre_stage.description,
    offre_stage.date_publication,
    'Stage' AS categorie,
    '3 à 6 mois' AS duree,
    'Rémunéré' AS remuneration,
    entreprise.adresse AS entreprise_adresse,
    entreprise.nom AS entreprise_nom,
    '' AS entreprise_logo
FROM offre_stage
LEFT JOIN entreprise ON offre_stage.id_entreprise = entreprise.id_entreprise
";

$conditions = [];
if (!empty($search)) {
    $conditions[] = "(offre_stage.titre LIKE '%$search%'
                   OR offre_stage.description LIKE '%$search%'
                   OR entreprise.nom LIKE '%$search%')";
}
if (!empty($categorie)) {
$conditions[] = "1=1";}
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}
$sql .= " ORDER BY offre_stage.date_publication DESC";

$result = mysqli_query($conn, $sql);
$db_offres = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $db_offres[] = $row;
    }
}

// ── Fusion : prototype en tête, BDD ensuite ─────────────────────────────────
// Si la BDD est vide ou non connectée, on affiche les 4 offres prototype.
// Sinon, on affiche BDD + prototype (si vous voulez uniquement BDD, retirez $offres_prototype).
$all_offres = array_merge($offres_prototype, $db_offres);

// Filtrage côté PHP si BDD vide (pour les offres prototype)
if (!empty($search) || !empty($categorie)) {
    $all_offres = array_filter($all_offres, function($o) use ($search, $categorie) {
        $match_search = empty($search)
            || stripos($o["titre"], $search) !== false
            || stripos($o["description"], $search) !== false
            || stripos($o["entreprise_nom"], $search) !== false;
        $match_cat = empty($categorie) || $o["categorie"] === $categorie;
        return $match_search && $match_cat;
    });
    $all_offres = array_values($all_offres);
}

$total = count($all_offres);

// ── Pagination ───────────────────────────────────────────────────────────────
$per_page    = 4;
$page        = max(1, intval($_GET["page"] ?? 1));
$total_pages = ceil($total / $per_page);
$offset      = ($page - 1) * $per_page;
$offres_page = array_slice($all_offres, $offset, $per_page);

function time_ago($date_str) {
    $now  = new DateTime();
    $date = new DateTime($date_str);
    $diff = $now->diff($date);
    if ($diff->days === 0) return "aujourd'hui";
    if ($diff->days === 1) return "il y a 1 jour";
    if ($diff->days < 7)  return "il y a {$diff->days} jours";
    if ($diff->days < 30) return "il y a " . floor($diff->days / 7) . " sem.";
    return "il y a " . floor($diff->days / 30) . " mois";
}
?>

<link rel="stylesheet" href="/site_stage/assets/css/offres.css?v=99"><main class="offres-page">

    <!-- ══════════════ HERO ══════════════ -->
    <section class="page-hero">
        <div class="hero-inner">
            <h1>Offres de stage</h1>
            <p>Trouvez le stage qui correspond à vos compétences et à vos envies.</p>
        </div>
    </section>

    <!-- ══════════════ BARRE DE RECHERCHE ══════════════ -->
    <section class="search-bar-section">
        <form method="GET" class="search-form" id="searchForm">

            <div class="search-input-wrap">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    placeholder="Métier, mot-clé, entreprise..."
                    value="<?php echo htmlspecialchars($search); ?>"
                >
            </div>

            <div class="search-divider"></div>

            <div class="select-wrap">
                <select name="categorie">
                    <option value="">Tous les domaines</option>
                    <?php foreach (["Marketing", "Développement", "Design", "Communication"] as $cat): ?>
                        <option value="<?php echo $cat; ?>" <?php echo $categorie === $cat ? "selected" : ""; ?>>
                            <?php echo $cat; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                        </div>

            <button type="submit" class="btn-search">Rechercher</button>

        </form>
    </section>

    <!-- ══════════════ LISTE DES OFFRES ══════════════ -->
    <section class="offres-list-section">

        <div class="list-header">
            <button class="btn-filter" onclick="toggleFilters()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="4" y1="6" x2="20" y2="6"/>
                    <line x1="8" y1="12" x2="16" y2="12"/>
                    <line x1="11" y1="18" x2="13" y2="18"/>
                </svg>
                Filtres
            </button>
            <p class="results-count">
                <strong><?php echo $total; ?></strong> offre<?php echo $total > 1 ? "s" : ""; ?> trouvée<?php echo $total > 1 ? "s" : ""; ?>
            </p>
        </div>

        <?php if ($total > 0): ?>

            <div class="offres-cards">
            <?php foreach ($offres_page as $offre):
                $cat      = $offre["categorie"] ?? "default";
                $colors   = $category_colors[$cat] ?? $category_colors["default"];
                $initiale = strtoupper(substr($offre["entreprise_nom"] ?? "?", 0, 1));
                $duree    = !empty($offre["duree"]) ? $offre["duree"] : "2 à 6 mois";
                $remun    = !empty($offre["remuneration"]) ? $offre["remuneration"] : "Rémunéré";

                // Détermine l'URL de redirection selon le type d'offre
                $id_offre = $offre["id_offre"];

if (is_numeric($id_offre)) {
    $detail_url = "offre-detail.php?id=" . intval($id_offre);
} else {
    $detail_url = "offre-detail.php?id=" . urlencode($id_offre) . "&prototype=1";
}
            ?>

                <article class="offre-card">

                    <!-- Logo entreprise -->
                    <div class="card-logo">
                        <?php if (!empty($offre["entreprise_logo"])): ?>
                            <img src="<?php echo htmlspecialchars($offre["entreprise_logo"]); ?>"
                                 alt="<?php echo htmlspecialchars($offre["entreprise_nom"]); ?>">
                        <?php else: ?>
                            <span class="logo-initiale"
                                  style="background:<?php echo $colors["bg"]; ?>; color:<?php echo $colors["text"]; ?>">
                                <?php echo $initiale; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Contenu -->
                    <div class="card-body">

                        <span class="badge-categorie"
                              style="background:<?php echo $colors["bg"]; ?>; color:<?php echo $colors["text"]; ?>">
                            <span class="badge-dot" style="background:<?php echo $colors["dot"]; ?>"></span>
                            <?php echo htmlspecialchars($cat !== "default" ? $cat : "Autre"); ?>
                        </span>

                        <h2><?php echo htmlspecialchars($offre["titre"]); ?></h2>

                        <div class="card-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                <?php echo htmlspecialchars($offre["entreprise_nom"]); ?>
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <?php echo htmlspecialchars($offre["entreprise_adresse"]); ?>
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                <?php echo time_ago($offre["date_publication"]); ?>
                            </span>
                        </div>

                        <p class="card-description">
                            <?php echo htmlspecialchars($offre["description"]); ?>
                        </p>

                        <div class="card-tags">
                            <span>Stage</span>
                            <span><?php echo htmlspecialchars($duree); ?></span>
                            <span><?php echo htmlspecialchars($remun); ?></span>
                        </div>

                    </div>

                    <!-- CTA → redirection vers la page de détail -->
                    <div class="card-action">
                        <a href="<?php echo $detail_url; ?>" class="btn-voir">
                            Voir l'offre
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>

                </article>

            <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <p>Aucune offre ne correspond à votre recherche.</p>
                <a href="offres.php" class="btn-reset">Réinitialiser les filtres</a>
            </div>
        <?php endif; ?>

        <!-- ══════════════ PAGINATION ══════════════ -->
        <?php if ($total_pages > 1): ?>
        <nav class="pagination">

            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&categorie=<?php echo urlencode($categorie); ?>"
                   class="pag-btn pag-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </a>
            <?php else: ?>
                <span class="pag-btn pag-arrow disabled">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </span>
            <?php endif; ?>

            <?php
            $pages_to_show = [];
            for ($i = 1; $i <= min(3, $total_pages); $i++) $pages_to_show[] = $i;
            if ($total_pages > 5) $pages_to_show[] = "…";
            for ($i = max($total_pages - 1, 4); $i <= $total_pages; $i++) $pages_to_show[] = $i;
            $pages_to_show = array_unique($pages_to_show);

            foreach ($pages_to_show as $p):
                if ($p === "…"): ?>
                    <span class="pag-ellipsis">…</span>
                <?php else: ?>
                    <a href="?page=<?php echo $p; ?>&search=<?php echo urlencode($search); ?>&categorie=<?php echo urlencode($categorie); ?>"
                       class="pag-btn <?php echo $p == $page ? "active" : ""; ?>">
                        <?php echo $p; ?>
                    </a>
                <?php endif;
            endforeach; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&categorie=<?php echo urlencode($categorie); ?>"
                   class="pag-btn pag-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
            <?php else: ?>
                <span class="pag-btn pag-arrow disabled">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </span>
            <?php endif; ?>

        </nav>
        <?php endif; ?>

    </section>

</main>

<?php include("includes/footer.php"); ?>

