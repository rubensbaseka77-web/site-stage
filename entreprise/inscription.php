<?php
session_start();
include("../includes/db.php");

$erreur = "";

if (isset($_POST["register"])) {

    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $adresse = mysqli_real_escape_string($conn, $_POST["adresse"]);

    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password != $confirm_password) {

        $erreur = "Les mots de passe ne correspondent pas.";

    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "
        INSERT INTO entreprise (nom, email, mot_de_passe, adresse)
        VALUES ('$nom', '$email', '$password_hash', '$adresse')
        ";

        if (mysqli_query($conn, $sql)) {
            header("Location: connexion.php");
            exit;
        } else {
            $erreur = "Erreur lors de la création du compte.";
        }
    }
}

include("../includes/header-entreprise.php");
?>

<link rel="stylesheet" href="/site_stage/assets/css/inscription-entreprise.css">

<main class="ie-page">

    <section class="ie-card">

        <div class="ie-header">
            <span class="ie-badge">Entreprise</span>
            <h1>Créer un compte entreprise</h1>
            <p>Rejoignez la plateforme et publiez vos offres de stage.</p>
        </div>

        <?php if (!empty($erreur)) : ?>
            <div class="ie-error">
                <?php echo $erreur; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="ie-group">
                <label>Nom de l'entreprise</label>
                <input type="text" name="nom" required>
            </div>

            <div class="ie-group">
                <label>Email professionnel</label>
                <input type="email" name="email" required>
            </div>

            <div class="ie-group">
                <label>Adresse</label>
                <input type="text" name="adresse" required>
            </div>

            <div class="ie-row">

                <div class="ie-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" required>
                </div>

                <div class="ie-group">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="confirm_password" required>
                </div>

            </div>

            <button type="submit" name="register" class="ie-btn">
                Créer mon compte
            </button>

        </form>

        <div class="ie-login">
            Déjà inscrit ?
            <a href="connexion.php">Se connecter</a>
        </div>

    </section>

</main>

<?php include("../includes/footer-entreprise.php"); ?>