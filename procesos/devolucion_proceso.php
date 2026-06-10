<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

if (isset($_GET['id'])) {
    $prestamo_id = $_GET['id'];
    $fecha_real = date('Y-m-d');

    $res = $conn->query("SELECT libro_id FROM prestamos WHERE id = $prestamo_id AND estado = 'Activo'");
    
    if ($res->num_rows > 0) {
        $libro_id = $res->fetch_assoc()['libro_id'];
        
        $conn->begin_transaction();
        try {
            $conn->query("UPDATE prestamos SET estado = 'Finalizado', fecha_devolucion_real = '$fecha_real' WHERE id = $prestamo_id");
            $conn->query("UPDATE libros SET stock = stock + 1 WHERE id = $libro_id");
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
        }
    }
}
header("Location: ../vistas/dashboard.php?status=devolucion_ok");
exit();
?>