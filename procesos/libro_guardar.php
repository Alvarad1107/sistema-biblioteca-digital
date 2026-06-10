<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

$codigo = $_POST['codigo'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$anio = empty($_POST['anio_publicacion']) ? 'NULL' : $_POST['anio_publicacion'];
$categoria_id = $_POST['categoria_id'];
$stock = $_POST['stock'];

$sql = "INSERT INTO libros (codigo, titulo, autor, editorial, anio_publicacion, categoria_id, stock) 
        VALUES ('$codigo', '$titulo', '$autor', '$editorial', $anio, $categoria_id, $stock)";

if ($conn->query($sql) === TRUE) {
    header("Location: ../vistas/libro_form.php?status=success");
} else {
    header("Location: ../vistas/libro_form.php?status=error");
}
exit();
?>