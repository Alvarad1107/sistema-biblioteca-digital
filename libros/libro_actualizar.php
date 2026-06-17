<?php
require '../config/seguridad.php';
require '../config/conexion.php';

$id = $_POST['id'];
$codigo = $_POST['codigo'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];

$anio_publicacion = empty($_POST['anio_publicacion']) ? "NULL" : "'" . $_POST['anio_publicacion'] . "'";

$categoria_id = $_POST['categoria_id'];
$stock = $_POST['stock'];

$sql = "UPDATE libros SET 
        codigo = '$codigo',
        titulo = '$titulo',
        autor = '$autor',
        editorial = '$editorial',
        anio_publicacion = $anio_publicacion,
        categoria_id = '$categoria_id',
        stock = '$stock'
        WHERE id = '$id'";

$conn->query($sql);

header("Location: libro_lista.php");
exit();
?>