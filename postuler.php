<?php
session_start();

include("includes/db.php");

if(!isset($_SESSION["etudiant_id"])){

    header("Location: connexion.php");
    exit;

}

if(!isset($_GET["id"])){

    header("Location: offres.php");
    exit;

}

$id_offre = intval($_GET["id"]);
$id_etudiant = $_SESSION["etudiant_id"];

$check = "
SELECT *
FROM candidature
WHERE id_etudiant = $id_etudiant
AND id_offre = $id_offre
";

$result_check = mysqli_query($conn, $check);

if(mysqli_num_rows($result_check) > 0){

    echo "Vous avez déjà postulé à cette offre.";
    exit;

}

$sql = "
INSERT INTO candidature
(id_etudiant, id_offre)

VALUES
($id_etudiant, $id_offre)
";

$result = mysqli_query($conn, $sql);

if($result){

    header("Location: candidat/dashboard.php");
    exit;

}else{

    echo "Erreur lors de la candidature.";

}
?>