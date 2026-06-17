<?php
require '../config/seguridad.php';
require '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave']; 
    $nivel_acceso = $_POST['nivel_acceso'];

    $sql = "INSERT INTO usuarios (nombre_completo, correo, clave, nivel_acceso) VALUES ('$nombre_completo', '$correo', '$clave', '$nivel_acceso')";

    if ($conn->query($sql) === TRUE) {
        header("Location: usuario_lista.php?status=guardado");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>