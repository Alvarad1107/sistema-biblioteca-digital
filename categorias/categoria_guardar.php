<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require '../config/conexion.php';

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$sql = "INSERT INTO categorias (nombre, descripcion) VALUES ('$nombre', '$descripcion')";

if ($conn->query($sql) === TRUE) {
    header("Location: categoria_form.php?status=success");
    exit();
} else {
    header("Location: categoria_form.php?status=error");
    exit();
}
?>