<?php
session_start();

unset($_SESSION["entreprise_id"]);
unset($_SESSION["entreprise_nom"]);

header("Location: connexion.php");
exit;
?>