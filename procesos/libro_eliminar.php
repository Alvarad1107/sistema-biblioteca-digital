<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM libros WHERE id = $id";
    $conn->query($sql);
}

header("Location: libro_lista.php");
exit();
?>