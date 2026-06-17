<?php
require 'config/seguridad.php';
require 'config/conexion.php';

// 1. Libros Disponibles (Suma de todo el stock actual)
$sql_disponibles = "SELECT SUM(stock) AS total FROM libros";
$res_disp = $conn->query($sql_disponibles);
$total_disponibles = $res_disp->fetch_assoc()['total'] ?? 0;

// 2. Libros Prestados (Suma de cantidades en préstamos no devueltos)
$sql_prestados = "SELECT SUM(dp.cantidad) AS total FROM detalle_prestamo dp JOIN prestamos p ON dp.id_prestamo = p.id WHERE p.estado IN ('activo', 'atrasado')";
$res_prest = $conn->query($sql_prestados);
$total_prestados = $res_prest->fetch_assoc()['total'] ?? 0;

// 3. Estudiantes con Préstamos Activos (Conteo sin repetir carnet)
$sql_est_activos = "SELECT COUNT(DISTINCT estudiante_id) AS total FROM prestamos WHERE estado IN ('activo', 'atrasado')";
$res_est_act = $conn->query($sql_est_activos);
$total_estudiantes = $res_est_act->fetch_assoc()['total'] ?? 0;

// 4. Libros Más Prestados (Top 5 histórico agrupado por ID)
$sql_top = "SELECT l.titulo, l.codigo, SUM(dp.cantidad) AS veces_prestado 
            FROM detalle_prestamo dp 
            JOIN libros l ON dp.id_libro = l.id 
            GROUP BY l.id 
            ORDER BY veces_prestado DESC LIMIT 5";
$res_top = $conn->query($sql_top);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e2e8f0; color: #333333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2b3a30; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 0.8rem 0; }
        .navbar-brand { color: #ffffff !important; font-weight: 700; font-size: 1.3rem; }
        .navbar-brand span { color: #a8bba1; font-weight: 400; }
        .btn-outline-light-custom { border: 1px solid #ffffff; color: #ffffff; border-radius: 6px; transition: all 0.2s; }
        .btn-outline-light-custom:hover { background-color: #ffffff; color: #2b3a30; }
        .main-card { background-color: #f4f1ea; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 2.5rem; }
        .stat-card { background-color: #ffffff; border-radius: 12px; padding: 1.5rem; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; height: 100%;}
        .stat-number { font-size: 2.5rem; font-weight: 700; color: #2b3a30; margin-bottom: 0.5rem; }
        .stat-label { color: #666666; font-weight: 600; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px;}
        .table-container { background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; margin-top: 1.5rem; }
        .table th { background-color: #2b3a30; color: #ffffff; font-weight: 600; padding: 16px; border: none; }
        .table td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #eedec3; color: #4a4a4a; }
    </style>
</head>
<body>
    <nav class="navbar mb-5">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Biblioteca<span>Digital</span></a>
            <div class="d-flex">
                <a href="dashboard.php" class="btn btn-sm btn-outline-light-custom px-3 py-2">Volver al Panel</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="main-card">
            <h2 class="mb-4" style="color: #2b3a30; font-weight: 700;">Reportes Estadísticos</h2>
            
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="stat-card border-bottom border-success border-4">
                        <div class="stat-number"><?= htmlspecialchars($total_disponibles) ?></div>
                        <div class="stat-label">Libros Disponibles en Inventario</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card border-bottom border-warning border-4">
                        <div class="stat-number"><?= htmlspecialchars($total_prestados) ?></div>
                        <div class="stat-label">Libros Prestados (Sin devolver)</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card border-bottom border-info border-4">
                        <div class="stat-number"><?= htmlspecialchars($total_estudiantes) ?></div>
                        <div class="stat-label">Estudiantes con Préstamos Activos</div>
                    </div>
                </div>
            </div>

            <h4 class="mb-3" style="color: #2b3a30; font-weight: 600;">Libros Más Prestados (Histórico)</h4>
            <div class="table-container table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Título del Libro</th>
                            <th class="text-center">Total de Préstamos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($res_top && $res_top->num_rows > 0): ?>
                            <?php while($fila = $res_top->fetch_assoc()): ?>
                                <tr>
                                    <td class="fw-bold"><?= htmlspecialchars($fila['codigo']) ?></td>
                                    <td><?= htmlspecialchars($fila['titulo']) ?></td>
                                    <td class="text-center h5 mb-0"><span class="badge bg-success rounded-pill px-3"><?= htmlspecialchars($fila['veces_prestado']) ?></span></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center py-4 text-muted">Aún no hay historial de préstamos.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>