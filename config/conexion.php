<?php
// Forzar la zona horaria local para todo el sistema
date_default_timezone_set('America/El_Salvador');

$host = "localhost";
$user = "root";
$pass = "";
$db = "biblioteca_digital";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>