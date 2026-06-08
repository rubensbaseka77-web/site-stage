<?php
session_start();
include("includes/db.php");

if (isset($_POST["register"])) {
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "
    INSERT INTO etudiant (nom, prenom, email, mot_de_passe)
    VALUES ('$nom', '$prenom', '$email', '$password')
    ";

    if (mysqli_query($conn, $sql)) {
        header("Location: connexion.php");
        exit;
    } else {
        $erreur = "Erreur lors de la création du compte.";
    }
}

include("includes/header.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/inscription.css?v=1">

<main class="in-page">

    <section class="in-card">

        <span class="in-badge">Étudiant</span>

        <h1>Créer un compte</h1>
        <p>Inscrivez-vous pour accéder à votre espace candidat.</p>

        <?php if(isset($erreur)){ ?>
            <div class="in-error"><?php echo $erreur; ?></div>
        <?php } ?>

        <form method="POST">

            <div class="in-grid">
                <div>
                    <label>Nom</label>
                    <input type="text" name="nom" required>
                </div>

                <div>
                    <label>Prénom</label>
                    <input type="text" name="prenom" required>
                </div>
            </div>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Mot de passe</label>
            <input type="password" name="password" required>

            <label>Confirmer le mot de passe</label>
            <input type="password" required>

            <label class="in-check">
                <input type="checkbox" required>
                J'accepte les conditions d'utilisation et la politique de confidentialité
            </label>

            <button type="submit" name="register">
                Créer mon compte
            </button>

        </form>

        <p class="in-link">
            Vous avez déjà un compte ?
            <a href="/site_stage/connexion.php">Se connecter</a>
        </p>

        <div class="in-separator">
            <span></span>
            <p>ou</p>
            <span></span>
        </div>

        <p class="in-company">
            Vous êtes une entreprise ?
            <a href="/site_stage/entreprise/inscription.php">Créer un compte entreprise</a>
        </p>

    </section>

</main>

<?php include("includes/footer.php"); ?>