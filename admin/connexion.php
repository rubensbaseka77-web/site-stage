<?php
session_start();
include("../includes/header.php");

$message = "";

if (isset($_POST["admin_login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email === "admin@uge.fr" && $password === "admin123") {

        $_SESSION["admin"] = true;
        header("Location: dashboard.php");
        exit;

    } else {
        $message = "Identifiants admin incorrects.";
    }
}
?>

<main class="auth-page">

    <section class="auth-container">

        <h1>Connexion Admin</h1>

        <?php if (!empty($message)) { ?>
            <p class="auth-message"><?php echo $message; ?></p>
        <?php } ?>

        <form method="POST" class="auth-form">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" name="admin_login">
                Se connecter
            </button>

        </form>

    </section>

</main>

<?php include("../includes/footer.php"); ?>