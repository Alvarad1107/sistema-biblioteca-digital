<?php
require '../config/seguridad.php';
require '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM estudiantes WHERE id = $id";
    $conn->query($sql);
}
header("Location: estudiante_lista.php");
exit();
?>