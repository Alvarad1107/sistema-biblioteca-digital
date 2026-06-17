<?php
require '../config/seguridad.php';
require '../config/conexion.php';

$sql = "SELECT * FROM estudiantes";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estudiantes - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e2e8f0; color: #333333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2b3a30; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 0.8rem 0; }
        .navbar-brand { color: #ffffff !important; font-weight: 700; font-size: 1.3rem; }
        .navbar-brand span { color: #a8bba1; font-weight: 400; }
        .btn-outline-light-custom { border: 1px solid #ffffff; color: #ffffff; border-radius: 6px; transition: all 0.2s; }
        .btn-outline-light-custom:hover { background-color: #ffffff; color: #2b3a30; }
        .btn-logout { border: 1px solid #ff6b6b; color: #ff6b6b; border-radius: 6px; transition: all 0.2s; }
        .btn-logout:hover { background-color: #ff6b6b; color: #ffffff; }
        .main-card { background-color: #f4f1ea; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 2.5rem; }
        h2 { color: #2b3a30; font-weight: 700; }
        .btn-dark-green { background-color: #2b3a30; color: #ffffff; border: none; border-radius: 6px; font-weight: 500; padding: 0.6rem 1.5rem; text-decoration: none; display: inline-block; }
        .btn-dark-green:hover { background-color: #1e2922; color: #ffffff; }
        .table-container { background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; margin-top: 1.5rem; }
        .table { margin-bottom: 0; }
        .table th { background-color: #2b3a30; color: #ffffff; font-weight: 600; padding: 16px; border: none; }
        .table td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #eedec3; color: #4a4a4a; }
        .table-hover tbody tr:hover { background-color: #faf9f6; }
        .btn-action-edit { color: #2b3a30; border: 1px solid #2b3a30; font-weight: 600; border-radius: 6px; }
        .btn-action-edit:hover { background-color: #2b3a30; color: #ffffff; }
    </style>
</head>
<body>

    <nav class="navbar mb-5">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Biblioteca<span>Digital</span></a>
            <div class="d-flex">
                <a href="../dashboard.php" class="btn btn-sm btn-outline-light-custom me-3 px-3 py-2">Volver al Panel</a>
                <a href="../logout.php" class="btn btn-sm btn-logout px-3 py-2">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="main-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Gestión de Estudiantes</h2>
                <a href="estudiante_form.php" class="btn-dark-green">Registrar Nuevo</a>
            </div>

            <div class="table-container table-responsive">
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
                                    <td class="fw-bold"><?= htmlspecialchars($fila['carnet']) ?></td>
                                    <td><?= htmlspecialchars($fila['nombre_completo']) ?></td>
                                    <td><?= htmlspecialchars($fila['correo']) ?></td>
                                    <td><?= htmlspecialchars($fila['carrera']) ?></td>
                                    <td><?= htmlspecialchars($fila['telefono']) ?></td>
                                    <td class="text-nowrap">
                                        <?php if ($_SESSION['nivel_acceso'] == 'Administrador' || $_SESSION['nivel_acceso'] == 'Supervisor'): ?>
                                            <a href="estudiante_editar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-action-edit me-2">Editar</a>
                                        <?php endif; ?>

                                        <?php if ($_SESSION['nivel_acceso'] == 'Administrador'): ?>
                                            <a href="estudiante_eliminar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('¿Eliminar este estudiante?');">Eliminar</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No hay estudiantes registrados en el sistema.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>