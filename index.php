<?php
include("includes/db.php");
include("includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/accueil.css?v=10">

<main class="home-page">

    <section class="home-hero">

        <div class="home-left">
            <span class="home-badge">Plateforme de stages</span>

            <h1>Trouvez le stage qui lance votre avenir</h1>

            <p>
                Recherchez une offre, postulez simplement et suivez vos candidatures depuis votre espace étudiant.
            </p>

            <form class="home-search" action="offres.php" method="GET">
                <input type="text" name="q" placeholder="Métier, entreprise...">
                <input type="text" name="lieu" placeholder="Ville">

                <select name="type">
                    <option value="">Tous les types</option>
                    <option value="stage">Stage</option>
                    <option value="alternance">Alternance</option>
                </select>

                <button type="submit">Rechercher</button>
            </form>

            <div class="home-tags">
                <span>Développement</span>
                <span>Design</span>
                <span>Marketing</span>
                <span>Communication</span>
            </div>
        </div>

        <div class="home-right">
            <img src="/site_stage/assets/images/hero-student.png" alt="Étudiante">
        </div>

    </section>

    <section class="home-section">

        <div class="home-title-row">
            <div>
                <span class="small-title">À découvrir</span>
                <h2>Offres récentes</h2>
            </div>

            <a href="offres.php">Voir toutes les offres →</a>
        </div>

        <div class="home-offres">

            <?php
            $result = mysqli_query($conn, "SELECT * FROM offre_stage ORDER BY date_publication DESC LIMIT 3");

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <div class="home-card">
                <span class="card-tag">Stage</span>
                <h3><?php echo htmlspecialchars($row["titre"]); ?></h3>
                <p><?php echo htmlspecialchars(mb_strimwidth($row["description"], 0, 100, "...")); ?></p>

                <a href="offre-detail.php?id=<?php echo $row["id_offre"]; ?>">
                    Voir l'offre
                </a>
            </div>

            <?php
                }
            } else {
            ?>

            <div class="home-card">
                <span class="card-tag">Stage</span>
                <h3>Développeur Web</h3>
                <p>Participez au développement d’une plateforme moderne.</p>
                <a href="#">Voir l'offre</a>
            </div>

            <div class="home-card">
                <span class="card-tag">Stage</span>
                <h3>Assistant Marketing</h3>
                <p>Développez la communication digitale d’une entreprise.</p>
                <a href="#">Voir l'offre</a>
            </div>

            <div class="home-card">
                <span class="card-tag">Stage</span>
                <h3>UX/UI Designer</h3>
                <p>Créez des interfaces simples, modernes et accessibles.</p>
                <a href="#">Voir l'offre</a>
            </div>

            <?php } ?>

        </div>

    </section>

    <section class="home-why-section">

        <div class="home-title-row">
            <div>
                <span class="small-title">Avantages</span>
                <h2>Pourquoi utiliser notre plateforme ?</h2>
            </div>
        </div>

        <div class="home-why">

            <div class="why-card">
                <div class="why-number">01</div>
                <h3>Offres centralisées</h3>
                <p>Retrouvez plusieurs offres de stage au même endroit.</p>
            </div>

            <div class="why-card">
                <div class="why-number">02</div>
                <h3>Candidature rapide</h3>
                <p>Postulez simplement et suivez l’évolution de vos demandes.</p>
            </div>

            <div class="why-card">
                <div class="why-number">03</div>
                <h3>Espace personnel</h3>
                <p>Accédez à votre profil, vos candidatures et vos documents.</p>
            </div>

        </div>

    </section>

</main>

<?php include("includes/footer.php"); ?>