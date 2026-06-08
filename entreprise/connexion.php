<?php
session_start();
include("../includes/db.php");

$erreur = "";

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = $_POST["mot_de_passe"];

    $sql = "SELECT * FROM entreprise WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $entreprise = mysqli_fetch_assoc($result);

    if ($entreprise && password_verify($password, $entreprise["mot_de_passe"])) {
        $_SESSION["entreprise_id"] = $entreprise["id_entreprise"];
        $_SESSION["entreprise_nom"] = $entreprise["nom"];

        header("Location: dashboard.php");
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}

include("../includes/header-entreprise.php");
?>
<link rel="stylesheet" href="/site_stage/assets/css/connexion-entreprise.css?v=1">
<main class="ce-page">

    <section class="ce-card">

        <h1>Connexion entreprise</h1>
        <p>Connectez-vous pour gérer vos offres et vos candidatures.</p>
<?php if (!empty($erreur)) { ?>
    <div class="ce-error"><?php echo $erreur; ?></div>
<?php } ?>
        <form method="POST">

            <label>Email entreprise</label>
            <input type="email" name="email" required>

            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" required>

<button type="submit" name="login">Se connecter</button>
        </form>

        <p class="ce-link">
            Pas encore de compte ?
<a href="/site_stage/entreprise/inscription.php">
    Créer un compte
</a>       </p>
<div class="ce-separator">
    <span></span>
    <p>ou</p>
    <span></span>
</div>

<p class="ce-student">
    Vous êtes étudiant ?
    <a href="/site_stage/connexion.php">
        Accéder à l'espace étudiant
    </a>
</p>
    </section>

</main>
<?php include("../includes/footer-entreprise.php"); ?>
