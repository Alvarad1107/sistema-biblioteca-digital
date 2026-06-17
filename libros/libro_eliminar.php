<?php
session_start();

if (!isset($_SESSION['correo']) || $_SESSION['nivel_acceso'] != 'Administrador') {
    header("Location: ../dashboard.php");
    exit();
}

require '../config/conexion.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM libros WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        
        header("Location: libro_lista.php");
        exit();
    } else {
        echo "Error al eliminar: " . $conn->error;
        exit();
    }
} else {
    
    header("Location: libro_lista.php");
    exit();
}
?>