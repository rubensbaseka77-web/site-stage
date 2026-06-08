<?php
session_start();

include("includes/db.php");
include("includes/header.php");

$message = "";

if(isset($_POST["inscription_entreprise"])){

    $nom_entreprise = mysqli_real_escape_string($conn, $_POST["nom"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM entreprise WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        $message = "Cet email existe déjà.";
    } else {
        $sql = "
            INSERT INTO entreprise (nom, email, mot_de_passe)
            VALUES ('$nom_entreprise', '$email', '$mot_de_passe')
        ";

        if(mysqli_query($conn, $sql)){
            header("Location: /site_stage/entreprise/connexion.php");
            exit;
        } else {
            $message = "Erreur lors de l'inscription.";
        }
    }
}
?>

<main class="auth-page figma-auth">
    <section class="figma-inscription">

        <h1>Inscription</h1>
        <p>Rejoignez nous</p>

        <div class="account-choice">
    <a href="/site_stage/inscription.php" class="choice-btn">Etudiant</a>
    <a href="/site_stage/inscription-entreprise.php" class="choice-btn active">Entreprise</a>
</div>
        <?php if(!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST" class="auth-form">
            <div class="form-group">
                <label>Nom de l'entreprise</label>
                <input type="text" name="nom" placeholder="Nom de l'entreprise" required>
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" placeholder="votre@email.com" required>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="mot_de_passe" placeholder="........" required>
            </div>

            <div class="terms">
                <input type="checkbox" required checked>
                <span>
                    J’accepte les <a href="/site_stage/cgu.php">Conditions d’utilisation</a>
                    et la <a href="/site_stage/politique-confidentialité.php">Politique de Confidentialité</a>
                </span>
            </div>

            <button type="submit" name="inscription_entreprise">
                Créer mon compte
            </button>
        </form>

        <p class="auth-link">
            Vous avez déjà un compte ?
            <a href="/site_stage/entreprise/connexion.php">Se connecter</a>
        </p>

    </section>
</main>

<?php include("includes/footer.php"); ?>
