<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../index.php");
    exit();
}

require '../config/conexion.php';

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
        body { background-color: #44505f88; color: #333333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2b3a30; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 1rem 0; }
        .navbar-brand { color: #ffffff !important; font-weight: 700; font-size: 1.3rem; }
        .navbar-brand span { color: #a8bba1; font-weight: 400; }
        
        .btn-outline-light-custom { border: 1px solid #ffffff; color: #ffffff; border-radius: 6px; }
        .btn-outline-light-custom:hover { background-color: #81965f; color: #314638; }
        .btn-danger-custom { background-color: #ad5b63; color: white; border: none; border-radius: 6px; }
        .btn-danger-custom:hover { background-color: #613136; color: white; }
        
        .main-card { background-color: #f4f1ea; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 2.5rem; }
        
        .btn-dark-green { background-color: #53722ace; color: #ffffff; border: none; border-radius: 6px; font-weight: 500; padding: 0.5rem 1.5rem; text-decoration: none; display: inline-block; transition: background-color 0.2s; }
        .btn-dark-green:hover { background-color: #398659; color: #ffffff; }

        
        .table-container { background-color: #967a7a; border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0; }
        .table { margin-bottom: 0; color: #333333; }
        .table th { background-color: #e2e8f0; color: #273d2e; font-weight: 600; border-bottom: none; padding: 15px; }
        .table td { vertical-align: middle; border-bottom: 1px solid #e2e8f0; padding: 15px; }
        .table-hover tbody tr:hover { background-color: #f8f9fa; }
        
        h2 { color: #222e26; font-weight: 700; }
    </style>
</head>
<body>

    <nav class="navbar mb-5">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Biblioteca<span>Digital</span></a>
            <div class="d-flex">
                <a href="../dashboard.php" class="btn btn-sm btn-outline-light-custom me-3 px-3 py-2">Volver al Panel</a>
                <a href="../logout.php" class="btn btn-sm btn-danger-custom px-3 py-2">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="main-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Gestión de Estudiantes</h2>
                <a href="estudiante_form.php" class="btn-dark-green">Registrar Nuevo</a>
            </div>

            <div class="table-container">
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
                                        <a href="estudiante_editar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-outline-secondary fw-bold">Editar</a>
                                        <a href="estudiante_eliminar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('¿Seguro que quieres eliminar a este estudiante?');">Eliminar</a>
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