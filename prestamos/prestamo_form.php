<?php
require '../config/seguridad.php';
require '../config/conexion.php';

// Obtener estudiantes
$sql_est = "SELECT id, carnet, nombre_completo FROM estudiantes ORDER BY nombre_completo ASC";
$estudiantes = $conn->query($sql_est);

// Obtener libros solo si tienen stock (Regla del negocio)
$sql_lib = "SELECT id, codigo, titulo, stock FROM libros WHERE stock > 0 ORDER BY titulo ASC";
$libros = $conn->query($sql_lib);

// Fecha límite sugerida (7 días después de hoy)
$fecha_sugerida = date('Y-m-d', strtotime('+7 days'));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Préstamo - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e2e8f0; color: #333333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2b3a30; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 0.8rem 0; }
        .navbar-brand { color: #ffffff !important; font-weight: 700; font-size: 1.3rem; }
        .navbar-brand span { color: #a8bba1; font-weight: 400; }
        .main-card { background-color: #f4f1ea; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 2.5rem; }
        .btn-dark-green { background-color: #2b3a30; color: #ffffff; border: none; border-radius: 6px; font-weight: 500; padding: 0.6rem 1.5rem; transition: background-color 0.2s; }
        .btn-dark-green:hover { background-color: #1e2922; color: #ffffff; }
        .btn-return { color: #2b3a30; background-color: #e2e8f0; border: none; border-radius: 6px; font-weight: 600; padding: 0.6rem 1.5rem; text-decoration: none; }
        .form-control, .form-select { border: 1px solid #cccccc; border-radius: 8px; padding: 12px; }
        label { color: #2b3a30; font-weight: 600; margin-bottom: 8px; }
    </style>
</head>
<body>
    <nav class="navbar mb-5">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Biblioteca<span>Digital</span></a>
            <div class="d-flex">
                <a href="../dashboard.php" class="btn btn-sm btn-outline-light text-white me-3 px-3 py-2">Volver al Panel</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="main-card">
                    <h2 class="mb-4 text-center">Registrar Nuevo Préstamo</h2>
                    
                    <form action="prestamo_guardar.php" method="POST">
                        <div class="mb-4">
                            <label class="form-label">Estudiante</label>
                            <select class="form-select" name="estudiante_id" required>
                                <option value="" disabled selected>Seleccione un estudiante...</option>
                                <?php while($est = $estudiantes->fetch_assoc()): ?>
                                    <option value="<?= $est['id'] ?>"><?= htmlspecialchars($est['carnet'] . ' - ' . $est['nombre_completo']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Fecha Prevista de Devolución</label>
                            <input type="date" class="form-control" name="fecha_devolucion_prevista" value="<?= $fecha_sugerida ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Seleccionar Libros (Disponibles)</label>
                            <select class="form-select" name="libros_ids[]" multiple required style="height: 200px;">
                                <?php while($lib = $libros->fetch_assoc()): ?>
                                    <option value="<?= $lib['id'] ?>"><?= htmlspecialchars($lib['codigo'] . ' - ' . $lib['titulo']) ?> (Stock: <?= $lib['stock'] ?>)</option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="prestamo_lista.php" class="btn-return">Cancelar</a>
                            <button type="submit" class="btn-dark-green">Confirmar y Prestar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>