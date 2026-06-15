<?php
session_start();

require 'config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        
        $_SESSION['correo'] = $fila['correo'];
        $_SESSION['nombre_completo'] = $fila['nombre_completo'];
        $_SESSION['nivel_acceso'] = $fila['nivel_acceso'];

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