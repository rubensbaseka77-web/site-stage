<?php
session_start();

include("../includes/db.php");
include("../includes/header.php");

$message = "";

if (isset($_POST["entreprise_login"])) {

    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $sql = "
        SELECT *
        FROM entreprise
        WHERE email = '$email'
        LIMIT 1
    ";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {

        $entreprise = mysqli_fetch_assoc($result);

        $_SESSION["entreprise_id"] = $entreprise["id_entreprise"];
        $_SESSION["entreprise_nom"] = $entreprise["nom"];

        header("Location: dashboard.php");
        exit;

    } else {
        $message = "Aucune entreprise trouvée avec cet email.";
    }
}
?>

<main class="auth-page">

    <section class="auth-container">

        <h1>Connexion entreprise</h1>

        <?php if (!empty($message)) { ?>
            <p class="auth-message"><?php echo $message; ?></p>
        <?php } ?>

        <form method="POST" class="auth-form">

            <div class="form-group">
                <label>Email entreprise</label>
                <input type="email" name="email" required>
            </div>

            <button type="submit" name="entreprise_login">
                Se connecter
            </button>

        </form>

    </section>

</main>

<?php include("../includes/footer.php"); ?>