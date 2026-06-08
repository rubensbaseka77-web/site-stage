<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION["admin"])) {
    header("Location: connexion.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    mysqli_query($conn, "DELETE FROM candidature WHERE id_offre = $id");
    mysqli_query($conn, "DELETE FROM offre_stage WHERE id_offre = $id");
}

header("Location: offres.php");
exit;
?>