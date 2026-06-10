<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$sql = "SELECT * FROM estudiantes";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #1e1e1e; border-bottom: 1px solid #333; }
        .card { background-color: #1e1e1e; border: 1px solid #333; border-radius: 10px; }
        .table { color: #e0e0e0; }
        .table th { background-color: #2b2b2b; color: #ffffff; border-color: #444; }
        .table td { border-color: #333; vertical-align: middle; }
        .table-hover tbody tr:hover { background-color: #2a2a2a; color: #ffffff; }
        .btn-add { background-color: #0d6efd; color: white; border: none; }
        .btn-add:hover { background-color: #0b5ed7; color: white; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a>
            <div class="d-flex">
                <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Volver al Panel</a>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="card p-4 shadow-lg">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 text-white">Gestión de Estudiantes</h2>
                <a href="estudiante_form.php" class="btn btn-add px-4 py-2">Registrar Nuevo</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Carnet</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Carrera</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado && $resultado->num_rows > 0): ?>
                            <?php while($fila = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($fila['carnet']) ?></td>
                                    <td><?= htmlspecialchars($fila['nombre_completo']) ?></td>
                                    <td><?= htmlspecialchars($fila['correo']) ?></td>
                                    <td><?= htmlspecialchars($fila['carrera']) ?></td>
                                    <td><?= htmlspecialchars($fila['telefono']) ?></td>
                                    <td>
                                        <a href="estudiante_editar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                                        <a href="estudiante_eliminar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que quieres eliminar a este estudiante?');">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No hay estudiantes registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>