<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../vistas/index.php"); exit(); }
require '../config/conexion.php';

$libro_id = $_POST['libro_id'];
$est_id = $_POST['estudiante_id'];
$user_id = $_SESSION['usuario_id'];
$fecha_prestamo = date('Y-m-d');
$fecha_dev = $_POST['fecha_devolucion_prevista'];

$conn->begin_transaction();
try {
    $conn->query("INSERT INTO prestamos (libro_id, estudiante_id, usuario_id, fecha_prestamo, fecha_devolucion_prevista) VALUES ($libro_id, $est_id, $user_id, '$fecha_prestamo', '$fecha_dev')");
    $conn->query("UPDATE libros SET stock = stock - 1 WHERE id = $libro_id");
    $conn->commit();
    header("Location: ../vistas/dashboard.php?status=prestamo_ok");
} catch (Exception $e) {
    $conn->rollback();
    header("Location: ../vistas/prestamo_form.php?error=1");
}
exit();
?>