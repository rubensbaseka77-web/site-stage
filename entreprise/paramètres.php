<?php
session_start();

if (!isset($_SESSION["entreprise_id"])) {
    header("Location: ../connexion.php");
    exit;
}

include("../includes/db.php");
include("../includes/header-entreprise.php");
?>

<main class="entreprise-layout">

    <aside class="entreprise-sidebar">
        <h2>Espace entreprise</h2>
        <p>Gérez vos offres et vos candidatures</p>

        <a href="mes-offres.php">Mes offres</a>
        <a href="candidatures.php">Candidatures reçues</a>
        <a href="mon-entreprise.php">Mon entreprise</a>
        <a class="active" href="parametres.php">Paramètres</a>
        <a href="../deconnexion.php">Déconnexion</a>
    </aside>

    <section class="entreprise-main">
        <h1>Paramètres</h1>
        <p>Modifiez les informations de votre compte.</p>

        <div class="card">
            <form method="POST">

                <label>Nom de l'entreprise</label>
                <input type="text" value="Mon Entreprise">

                <label>Email</label>
                <input type="email" value="entreprise@email.com">

                <label>Mot de passe</label>
                <input type="password" placeholder="Nouveau mot de passe">

                <button type="submit" class="btn">
                    Enregistrer
                </button>

            </form>
        </div>
    </section>

</main>

<?php include("../includes/footer-entreprise.php"); ?>^
