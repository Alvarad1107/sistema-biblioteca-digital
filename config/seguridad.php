<?php
session_start();

// 1. Si no hay sesión, se expulsa al login.
if (!isset($_SESSION['correo']) || !isset($_SESSION['nivel_acceso'])) {
    header("Location: ../index.php");
    exit();
}

$rol = $_SESSION['nivel_acceso'];
$archivo_actual = basename($_SERVER['PHP_SELF']); // Detecta en qué archivo está navegando el usuario

// 2. Bibliotecario (Solo lectura, préstamos y nuevos libros)
if ($rol == 'Bibliotecario') {
    $bloqueados_bibliotecario = [
        'categoria_form.php', 'categoria_guardar.php', 'categoria_editar.php', 'categoria_actualizar.php', 'categoria_eliminar.php',
        'estudiante_form.php', 'estudiante_guardar.php', 'estudiante_editar.php', 'estudiante_actualizar.php', 'estudiante_eliminar.php',
        'libro_editar.php', 'libro_actualizar.php', 'libro_eliminar.php',
        'usuario_lista.php', 'usuario_form.php', 'usuario_guardar.php', 'usuario_editar.php', 'usuario_eliminar.php',
        'reportes.php'
    ];
    
    if (in_array($archivo_actual, $bloqueados_bibliotecario)) {
        header("Location: ../dashboard.php"); // Lo rebota al inicio
        exit();
    }
}

// 3. Supervisor (Hace de todo, pero no elimina cosas críticas ni gestiona usuarios)
if ($rol == 'Supervisor') {
    $bloqueados_supervisor = [
        'categoria_eliminar.php', 
        'libro_eliminar.php',
        'usuario_lista.php', 'usuario_form.php', 'usuario_guardar.php', 'usuario_editar.php', 'usuario_eliminar.php'
    ];
    
    if (in_array($archivo_actual, $bloqueados_supervisor)) {
        header("Location: ../dashboard.php");
        exit();
    }
}

// El Administrador no tiene bloqueos (solamente no puede eliminar historial de préstamos realizados).
?>