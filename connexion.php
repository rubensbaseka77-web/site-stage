<?php
session_start();

include("includes/db.php");
include("includes/header.php");

$message = "";

if (isset($_POST["connexion_btn"])) {

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    $sql = "
        SELECT *
        FROM etudiant
        WHERE email = '$email'
        LIMIT 1
    ";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($mot_de_passe, $user["mot_de_passe"])) {

            $_SESSION["etudiant_id"] = $user["id_etudiant"];
            $_SESSION["etudiant_nom"] = $user["nom"];
            $_SESSION["etudiant_prenom"] = $user["prenom"];

            header("Location: candidat/dashboard.php");
            exit;

        } else {
            $message = "Mot de passe incorrect.";
        }

    } else {
        $message = "Aucun compte trouvé avec cet email.";
    }
}
?>

<main class="auth-page">

    <section class="auth-container">

        <div class="auth-left">

            <h1>Connexion</h1>

            <p>
                Connectez-vous pour accéder à votre espace candidat.
            </p>

            <?php if (!empty($message)) { ?>
                <div class="auth-message">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST" class="auth-form">

                <div class="form-group">
                    <label>Email</label>

                    <input 
                        type="email"
                        name="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>

                    <input 
                        type="password"
                        name="mot_de_passe"
                        required
                    >
                </div>

                <button type="submit" name="connexion_btn">
                    Se connecter
                </button>

            </form>

            <p class="auth-link">
                Pas encore de compte ?
                <a href="inscription.php">Créer un compte</a>
            </p>

        </div>

    </section>

</main>

<?php
include("includes/footer.php");
?>