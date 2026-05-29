<?php
include("includes/db.php");
include("includes/header.php");

$message = "";

if(isset($_POST["inscription_btn"])){

    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    $password_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $check = "
        SELECT * 
        FROM etudiant
        WHERE email = '$email'
    ";

    $check_result = mysqli_query($conn, $check);

    if(mysqli_num_rows($check_result) > 0){

        $message = "Cet email existe déjà.";

    } else {

        $sql = "
            INSERT INTO etudiant
            (nom, prenom, email, mot_de_passe)

            VALUES
            ('$nom', '$prenom', '$email', '$password_hash')
        ";

        $insert = mysqli_query($conn, $sql);

        if($insert){
            $message = "Inscription réussie.";
        } else {
            $message = "Erreur lors de l'inscription.";
        }

    }

}
?>

<main class="auth-page">

    <section class="auth-container">

        <div class="auth-left">

            <h1>Créer un compte</h1>

            <p>
                Rejoignez la plateforme des stages de l’Université Gustave Eiffel.
            </p>

            <?php if(!empty($message)){ ?>

                <div class="auth-message">
                    <?php echo $message; ?>
                </div>

            <?php } ?>

            <form method="POST" class="auth-form">

                <div class="form-group">
                    <label>Nom</label>

                    <input 
                        type="text"
                        name="nom"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Prénom</label>

                    <input 
                        type="text"
                        name="prenom"
                        required
                    >
                </div>

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

                <button type="submit" name="inscription_btn">
                    S’inscrire
                </button>

            </form>

        </div>

    </section>

</main>

<?php
include("includes/footer.php");
?>