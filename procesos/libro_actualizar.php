<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

$id = $_POST['id'];
$codigo = $_POST['codigo'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$anio = empty($_POST['anio_publicacion']) ? 'NULL' : $_POST['anio_publicacion'];
$categoria_id = $_POST['categoria_id'];
$stock = $_POST['stock'];

$conn->query("UPDATE libros SET codigo = '$codigo', titulo = '$titulo', autor = '$autor', editorial = '$editorial', anio_publicacion = $anio, categoria_id = $categoria_id, stock = $stock WHERE id = $id");
header("Location: ../vistas/libro_lista.php");
exit();
?>