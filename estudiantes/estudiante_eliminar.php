<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../index.php");
    exit();
}
require '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM estudiantes WHERE id = $id";
    $conn->query($sql);
}
header("Location: estudiante_lista.php");
exit();
?>