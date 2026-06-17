<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../index.php");
    exit();
}

require '../config/conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$sql = "UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = '$id'";
$conn->query($sql);

header("Location: categoria_lista.php");
exit();
?>