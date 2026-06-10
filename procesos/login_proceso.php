<?php
session_start();
require '../config/conexion.php';

$correo = $_POST['correo'];
$clave = $_POST['clave'];

$sql = "SELECT id, nombre_completo, nivel_acceso, estado FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 1) {
    $usuario = $resultado->fetch_assoc();
    
    if ($usuario['estado'] == 'Activo') {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre_completo'];
        $_SESSION['nivel_acceso'] = $usuario['nivel_acceso'];
        
        header("Location: ../vistas/dashboard.php");
        exit();
    } else {
        header("Location: ../vistas/index.php?error=inactivo");
        exit();
    }
} else {
    header("Location: ../vistas/index.php?error=credenciales");
    exit();
}
?>