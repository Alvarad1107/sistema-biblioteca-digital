<?php
require '../config/seguridad.php';
require '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO categorias (nombre, descripcion) VALUES ('$nombre', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        header("Location: categoria_lista.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: categoria_lista.php");
    exit();
}
?>