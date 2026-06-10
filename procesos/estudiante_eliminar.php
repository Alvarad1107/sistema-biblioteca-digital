<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Borrado directo en la tabla estudiantes
    $sql = "DELETE FROM estudiantes WHERE id = $id";
    
    if (!$conn->query($sql)) {
        // En caso de que un préstamo esté bloqueando el borrado por la llave foránea
        echo "Error al eliminar: " . $conn->error;
        exit();
    }
}

header("Location: estudiante_lista.php");
exit();
?>