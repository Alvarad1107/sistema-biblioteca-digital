<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$sql = "INSERT INTO categorias (nombre, descripcion) VALUES ('$nombre', '$descripcion')";
if ($conn->query($sql) === TRUE) {
    header("Location: ../vistas/categoria_form.php?status=success");
} else {
    header("Location: ../vistas/categoria_form.php?status=error");
}
exit();
?>