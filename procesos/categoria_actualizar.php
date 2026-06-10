<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$conn->query("UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id");
header("Location: ../vistas/categoria_lista.php");
exit();
?>