<?php
session_start();
include("includes/db.php");

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM etudiant WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $etudiant = mysqli_fetch_assoc($result);

    if ($etudiant && password_verify($password, $etudiant["mot_de_passe"])) {
        $_SESSION["etudiant_id"] = $etudiant["id_etudiant"];
        $_SESSION["etudiant_nom"] = $etudiant["nom"];
        $_SESSION["etudiant_prenom"] = $etudiant["prenom"];

        header("Location: candidat/dashboard.php");
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}

include("includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/connexion.css?v=1">

<main class="co-page">

    <section class="co-card">

        <h1>Connexion étudiant</h1>
        <p>Connectez-vous pour accéder à votre espace candidat.</p>

        <?php if(isset($erreur)){ ?>
            <div class="co-error"><?php echo $erreur; ?></div>
        <?php } ?>

        <form method="POST">

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Mot de passe</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Se connecter</button>

        </form>

        <p class="co-link">
            Pas encore de compte ?
            <a href="/site_stage/inscription.php">Créer un compte</a>
        </p>

        <div class="co-separator">
            <span></span>
            <p>ou</p>
            <span></span>
        </div>

        <p class="co-company">
            Vous êtes une entreprise ?
            <a href="/site_stage/entreprise/connexion.php">Accéder à l'espace entreprise</a>
        </p>

    </section>

</main>

<?php include("includes/footer.php"); ?>