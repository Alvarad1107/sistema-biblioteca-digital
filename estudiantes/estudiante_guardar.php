<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../index.php");
    exit();
}
require '../config/conexion.php';

$carnet = $_POST['carnet'];
$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO estudiantes (carnet, nombre_completo, correo, carrera, telefono) 
        VALUES ('$carnet', '$nombre_completo', '$correo', '$carrera', '$telefono')";

if ($conn->query($sql) === TRUE) {
    header("Location: estudiante_form.php?status=success");
    exit();
} else {
    echo "Error al guardar el estudiante: " . $conn->error;
}
?>