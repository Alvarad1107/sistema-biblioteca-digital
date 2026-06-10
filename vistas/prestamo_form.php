<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit(); }
require '../config/conexion.php';
$libros = $conn->query("SELECT id, titulo, stock FROM libros WHERE stock > 0");
$estudiantes = $conn->query("SELECT id, carnet, nombre_completo FROM estudiantes");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark p-3"><div class="container"><a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a></div></nav>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg col-md-8 mx-auto">
            <h2 class="mb-4 text-center">Registrar Préstamo</h2>
            <form action="../procesos/prestamo_guardar.php" method="POST">
                <div class="mb-3"><label>Libro</label><select class="form-select" name="libro_id" required><option value="">Seleccione...</option><?php while($l = $libros->fetch_assoc()) echo "<option value='{$l['id']}'>{$l['titulo']} (Stock: {$l['stock']})</option>"; ?></select></div>
                <div class="mb-3"><label>Estudiante</label><select class="form-select" name="estudiante_id" required><option value="">Seleccione...</option><?php while($e = $estudiantes->fetch_assoc()) echo "<option value='{$e['id']}'>{$e['nombre_completo']}</option>"; ?></select></div>
                <div class="mb-4"><label>Fecha Devolución</label><input type="date" class="form-control" name="fecha_devolucion_prevista" required></div>
                <div class="d-flex justify-content-between"><a href="dashboard.php" class="btn btn-outline-secondary">Cancelar</a><button type="submit" class="btn btn-primary">Confirmar</button></div>
            </form>
        </div>
    </div>
</body>
</html>