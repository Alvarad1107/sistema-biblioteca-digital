<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}
require '../config/conexion.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_prestamo = intval($_GET['id']);
    
    $conn->begin_transaction();

    try {
        // 1. Cambiar estado y fecha en la cabecera
        $fecha_devolucion_real = date('Y-m-d');
        $sql_update_prestamo = "UPDATE prestamos SET estado = 'devuelto', fecha_devolucion_real = '$fecha_devolucion_real' WHERE id = $id_prestamo";
        $conn->query($sql_update_prestamo);

        // 2. Obtener los libros para devolver el stock
        $sql_detalles = "SELECT id_libro, cantidad FROM detalle_prestamo WHERE id_prestamo = $id_prestamo";
        $resultado_detalles = $conn->query($sql_detalles);

        while($detalle = $resultado_detalles->fetch_assoc()) {
            $id_libro = $detalle['id_libro'];
            $cantidad = $detalle['cantidad'];
            
            // Regla de Stock: Restaurar sumando la cantidad original
            $sql_restaurar_stock = "UPDATE libros SET stock = stock + $cantidad WHERE id = $id_libro";
            $conn->query($sql_restaurar_stock);
        }

        $conn->commit();
        header("Location: prestamo_lista.php?status=devuelto");

    } catch (Exception $e) {
        $conn->rollback();
        $error_msg = urlencode("Ocurrió un error al procesar la devolución.");
        header("Location: prestamo_lista.php?error=$error_msg");
    }
} else {
    header("Location: prestamo_lista.php");
}
?>