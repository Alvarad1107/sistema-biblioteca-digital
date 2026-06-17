<?php
require '../config/seguridad.php';
require '../config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE id = $id";
    $conn->query($sql);
}
header("Location: usuario_lista.php");
exit();
?>