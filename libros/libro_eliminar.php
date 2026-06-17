<?php
require '../config/seguridad.php';
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