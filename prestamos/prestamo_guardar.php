<?php
session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}
require '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id']; // El empleado logueado que procesa el préstamo
    $estudiante_id = $_POST['estudiante_id'];
    $fecha_devolucion_prevista = $_POST['fecha_devolucion_prevista'];
    $fecha_prestamo = date('Y-m-d');
    $libros_ids = $_POST['libros_ids']; 

    // Regla: Limitar a máximo 3 libros activos por estudiante
    $sql_check = "SELECT COUNT(dp.id) as total_activos FROM detalle_prestamo dp JOIN prestamos p ON dp.id_prestamo = p.id WHERE p.estudiante_id = $estudiante_id AND p.estado IN ('activo', 'atrasado')";
    $resultado_check = $conn->query($sql_check);
    $fila_check = $resultado_check->fetch_assoc();
    
    if (($fila_check['total_activos'] + count($libros_ids)) > 3) {
        $error_msg = urlencode("El estudiante excede el límite de 3 libros prestados simultáneamente.");
        header("Location: prestamo_lista.php?error=$error_msg");
        exit();
    }

    $conn->begin_transaction();

    try {
        // 1. Guardar la Cabecera
        $sql_prestamo = "INSERT INTO prestamos (usuario_id, estudiante_id, fecha_prestamo, fecha_devolucion_prevista, estado) 
                        VALUES ($usuario_id, $estudiante_id, '$fecha_prestamo', '$fecha_devolucion_prevista', 'activo')";
        $conn->query($sql_prestamo);
        $id_prestamo = $conn->insert_id;

        // 2. Guardar Detalles y Descontar Stock
        foreach ($libros_ids as $id_libro) {
            // Guardar detalle con los nombres de columna
            $sql_detalle = "INSERT INTO detalle_prestamo (id_prestamo, id_libro, cantidad) VALUES ($id_prestamo, $id_libro, 1)";
            $conn->query($sql_detalle);

            // Regla de Stock
            $sql_stock = "UPDATE libros SET stock = stock - 1 WHERE id = $id_libro";
            $conn->query($sql_stock);
        }

        $conn->commit();
        header("Location: prestamo_lista.php?status=guardado");

    } catch (Exception $e) {
        $conn->rollback();
        $error_msg = urlencode("Error al registrar el préstamo.");
        header("Location: prestamo_lista.php?error=$error_msg");
    }
} else {
    header("Location: prestamo_lista.php");
}
?>