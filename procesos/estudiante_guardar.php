<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

$carnet = $_POST['carnet'];
$nombre = $_POST['nombre_completo'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$conn->query("INSERT INTO estudiantes (carnet, nombre_completo, carrera, telefono, correo) VALUES ('$carnet', '$nombre', '$carrera', '$telefono', '$correo')");
header("Location: ../vistas/estudiante_lista.php");
exit();
?>