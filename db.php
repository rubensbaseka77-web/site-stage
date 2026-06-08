<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "site_stage";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Erreur connexion : " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>