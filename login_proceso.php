<?php
session_start();
require 'config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $sql = "SELECT id, nombre_completo, correo, clave, nivel_acceso FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre_completo'] = $usuario['nombre_completo'];
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['nivel_acceso'] = $usuario['nivel_acceso'];

        header("Location: dashboard.php");
        exit();
    } else {
    
        header("Location: index.php?error=1");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>