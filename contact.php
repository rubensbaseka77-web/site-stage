<?php
include("includes/db.php");
include("includes/header.php");

$message = "";

if (isset($_POST["contact_btn"])) {
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $sujet = mysqli_real_escape_string($conn, $_POST["sujet"]);
    $message_contact = mysqli_real_escape_string($conn, $_POST["message"]);

    $message = "Votre message a bien été envoyé.";
}
?>
<link rel="stylesheet" href="contact.css">
<main class="contact-page">

    <section class="page-title">
        <h1>Contactez-nous</h1>
        <p>Contactez-nous via ce formulaire et nous vous répondrons rapidement.</p>
    </section>

    <section class="contact-layout">

        <div class="contact-info">
            <div>
                <h3>Par e-mail</h3>
                <p>gustave-eiffel@gmail.com</p>
            </div>

            <div>
                <h3>Par téléphone</h3>
                <p>01 23 45 67 89</p>
            </div>

            <div>
                <h3>Adresse</h3>
                <p>17 rue Alfred Nobel, 77420 Champs-sur-Marne</p>
            </div>
        </div>

        <form method="POST" class="contact-form">

            <?php if (!empty($message)) { ?>
                <p class="success-message"><?php echo $message; ?></p>
            <?php } ?>

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" required>
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Sujet</label>
                <input type="text" name="sujet" required>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="message" required></textarea>
            </div>

            <button type="submit" name="contact_btn">
                Envoyer
            </button>

        </form>

    </section>

</main>

<?php include("includes/footer.php"); ?>

