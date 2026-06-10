<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM categorias WHERE id = $id");
}
header("Location: ../vistas/categoria_lista.php");
exit();
?>