<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

// Recibimos los datos del formulario
$carnet = $_POST['carnet'];
$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefono'];

// Insertamos directamente en la tabla estudiantes
$sql = "INSERT INTO estudiantes (carnet, nombre_completo, correo, carrera, telefono) 
        VALUES ('$carnet', '$nombre_completo', '$correo', '$carrera', '$telefono')";

if ($conn->query($sql) === TRUE) {
    header("Location: estudiante_form.php?status=success");
    exit();
} else {
    echo "Error al guardar el estudiante: " . $conn->error;
}
?>