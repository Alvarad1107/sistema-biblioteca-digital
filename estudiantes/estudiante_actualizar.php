<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../index.php");
    exit();
}
require '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $carnet = $_POST['carnet'];
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $carrera = $_POST['carrera'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE estudiantes SET carnet = '$carnet', nombre_completo = '$nombre_completo', correo = '$correo', carrera = '$carrera', telefono = '$telefono' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: estudiante_lista.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
} else {
    header("Location: estudiante_lista.php");
    exit();
}
?>