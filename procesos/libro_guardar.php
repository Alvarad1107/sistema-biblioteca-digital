<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$codigo = $_POST['codigo'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$anio_publicacion = empty($_POST['anio_publicacion']) ? 'NULL' : $_POST['anio_publicacion'];
$categoria_id = $_POST['categoria_id'];
$stock = $_POST['stock'];

$sql = "INSERT INTO libros (codigo, titulo, autor, editorial, anio_publicacion, categoria_id, stock) 
        VALUES ('$codigo', '$titulo', '$autor', '$editorial', $anio_publicacion, $categoria_id, $stock)";

if ($conn->query($sql) === TRUE) {
    header("Location: libro_form.php?status=success");
    exit();
} else {
    header("Location: libro_form.php?status=error");
    exit();
}
?>