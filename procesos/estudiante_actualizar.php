<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

$id = $_POST['id'];
$carnet = $_POST['carnet'];
$nombre = $_POST['nombre_completo'];
$carrera = $_POST['carrera'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$conn->query("UPDATE estudiantes SET carnet='$carnet', nombre_completo='$nombre', carrera='$carrera', telefono='$telefono', correo='$correo' WHERE id=$id");
header("Location: ../vistas/estudiante_lista.php");
exit();
?>