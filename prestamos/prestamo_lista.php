<?php
require '../config/seguridad.php';
require '../config/conexion.php';

// Regla de negocio automática: Actualizar estado a "atrasado"
$sql_update_atrasados = "UPDATE prestamos SET estado = 'atrasado' WHERE estado = 'activo' AND fecha_devolucion_prevista < CURDATE()";
$conn->query($sql_update_atrasados);

// Obtener la lista de préstamos con los nombres de los libros y el bibliotecario
$sql = "SELECT p.*, e.nombre_completo AS estudiante, e.carnet, u.nombre_completo AS bibliotecario,
            (SELECT GROUP_CONCAT(l.titulo SEPARATOR '<br>• ') 
                FROM detalle_prestamo dp 
                JOIN libros l ON dp.id_libro = l.id 
                WHERE dp.id_prestamo = p.id) AS libros_prestados
        FROM prestamos p
        JOIN estudiantes e ON p.estudiante_id = e.id
        JOIN usuarios u ON p.usuario_id = u.id
        ORDER BY p.fecha_prestamo DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Préstamos - Biblioteca Digital</title>
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
        .table th { background-color: #2b3a30; color: #ffffff; font-weight: 600; padding: 16px; border: none; }
        .table td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #eedec3; color: #4a4a4a; }
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

    <div class="container-fluid px-5 mb-5">
        <div class="main-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Control de Préstamos</h2>
                <a href="prestamo_form.php" class="btn-dark-green">Registrar Préstamo</a>
            </div>

            <?php if (isset($_GET['status']) && $_GET['status'] == 'devuelto'): ?>
                <div class="alert alert-success border-0 rounded-3 shadow-sm">Los libros han sido devueltos y el stock se ha actualizado correctamente.</div>
            <?php endif; ?>
            <?php if (isset($_GET['status']) && $_GET['status'] == 'guardado'): ?>
                <div class="alert alert-success border-0 rounded-3 shadow-sm">Préstamo registrado y stock descontado exitosamente.</div>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger border-0 rounded-3 shadow-sm"><?= htmlspecialchars($_GET['error']) ?></div>
            <?php endif; ?>

            <div class="table-container table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            <th>Libros</th>
                            <th>F. Préstamo</th>
                            <th>F. Prevista</th>
                            <th>Estado</th>
                            <th>Procesado por</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado && $resultado->num_rows > 0): ?>
                            <?php while($fila = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($fila['estudiante']) ?></strong><br><small class="text-muted"><?= htmlspecialchars($fila['carnet']) ?></small></td>
                                    <td>• <?= $fila['libros_prestados'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($fila['fecha_prestamo'])) ?></td>
                                    <td class="<?= ($fila['estado'] == 'atrasado') ? 'text-danger fw-bold' : '' ?>"><?= date('d/m/Y', strtotime($fila['fecha_devolucion_prevista'])) ?></td>
                                    <td>
                                        <?php 
                                            if($fila['estado'] == 'activo') echo '<span class="badge bg-primary">Activo</span>';
                                            elseif($fila['estado'] == 'atrasado') echo '<span class="badge bg-danger">Atrasado</span>';
                                            else echo '<span class="badge bg-success">Devuelto</span><br><small class="text-muted">'.date('d/m/Y', strtotime($fila['fecha_devolucion_real'])).'</small>';
                                        ?>
                                    </td>
                                    <td><small><?= htmlspecialchars($fila['bibliotecario']) ?></small></td>
                                    <td>
                                        <?php if($fila['estado'] == 'activo' || $fila['estado'] == 'atrasado'): ?>
                                            <a href="prestamo_devolver.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-outline-success fw-bold" onclick="return confirm('¿Confirmar que el estudiante devolvió todos estos libros?');">Registrar Devolución</a>
                                        <?php else: ?>
                                            <span class="text-muted">Completado</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center py-5 text-muted">No hay préstamos registrados.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>