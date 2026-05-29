<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Université Gustave Eiffel</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>

    <?php
include("includes/db.php");
include("includes/header.php");
?>

<main>

<section class="hero">

    <div class="hero-text">

        <p class="welcome">
            Bienvenue sur la plateforme des stages
        </p>

        <h1>
            Le bon stage pour développer votre avenir
        </h1>

        <p class="description">
            Trouvez rapidement des stages adaptés à votre parcours et développez votre expérience professionnelle.
        </p>

        <div class="search-box">

            <input type="text" placeholder="Rechercher un stage">

            <button>
                Rechercher
            </button>

        </div>

        <div class="categories">

            <span>Marketing</span>
            <span>Développement</span>
            <span>Design</span>
            <span>Gestion</span>

        </div>

    </div>

    <div class="hero-image">

        <img src="images/student.png" alt="Etudiant">

    </div>
    <section class="offres">

    <div class="section-title">
        <h2>Offres récentes</h2>
        <p>Découvrez les stages récemment publiés</p>
    </div>

    <div class="offres-container">

     <?php
$sql = "SELECT * FROM offre_stage ORDER BY date_publication DESC";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
?>
            <div class="offre-card">

    <h3>
        <?php echo $row['titre']; ?>
    </h3>

    <p>
        <?php echo $row['description']; ?>
    </p>

    <a href="offre-detail.php?id=<?php echo $row['id_offre']; ?>">
        Voir l'offre
    </a>

</div>

<?php
}
?>

</section>

</section>
</main>

<?php
include("includes/footer.php");
?>

</header>
</body>
</html>