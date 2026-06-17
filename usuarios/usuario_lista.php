<?php
require '../config/seguridad.php';
require '../config/conexion.php';

$sql = "SELECT id, nombre_completo, correo, nivel_acceso FROM usuarios ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e2e8f0; color: #333333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2b3a30; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 0.8rem 0; }
        .navbar-brand { color: #ffffff !important; font-weight: 700; font-size: 1.3rem; }
        .navbar-brand span { color: #a8bba1; font-weight: 400; }
        .btn-outline-light-custom { border: 1px solid #ffffff; color: #ffffff; border-radius: 6px; transition: all 0.2s; }
        .btn-outline-light-custom:hover { background-color: #ffffff; color: #2b3a30; }
        .main-card { background-color: #f4f1ea; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 2.5rem; }
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
                <a href="../dashboard.php" class="btn btn-sm btn-outline-light-custom px-3 py-2">Volver al Panel</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="main-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0" style="color: #2b3a30; font-weight: 700;">Administración de Usuarios</h2>
                <a href="usuario_form.php" class="btn-dark-green">Registrar Nuevo</a>
            </div>
            
            <div class="mb-4">
                <input type="text" id="buscador" class="form-control form-control-lg shadow-sm" placeholder="🔍 Escribe para buscar por nombre, correo o rol..." style="border: 2px solid #e2e8f0; border-radius: 10px;">
            </div>

            <?php if (isset($_GET['status']) && $_GET['status'] == 'guardado'): ?>
                <div class="alert alert-success border-0 rounded-3 shadow-sm">Usuario registrado exitosamente.</div>
            <?php endif; ?>

            <div class="table-container table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Correo Electrónico</th>
                            <th>Nivel de Acceso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado && $resultado->num_rows > 0): ?>
                            <?php while($fila = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td class="fw-bold"><?= $fila['id'] ?></td>
                                    <td><?= htmlspecialchars($fila['nombre_completo']) ?></td>
                                    <td><?= htmlspecialchars($fila['correo']) ?></td>
                                    <td>
                                        <?php if($fila['nivel_acceso'] == 'Administrador'): ?>
                                            <span class="badge bg-danger">Administrador</span>
                                        <?php elseif($fila['nivel_acceso'] == 'Supervisor'): ?>
                                            <span class="badge bg-warning text-dark">Supervisor</span>
                                        <?php else: ?>
                                            <span class="badge bg-primary">Bibliotecario</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($_SESSION['correo'] != $fila['correo']): ?>
                                            <a href="usuario_eliminar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('¿Seguro que deseas eliminar este usuario del sistema?');">Eliminar</a>
                                        <?php else: ?>
                                            <span class="text-muted small">Tu sesión actual</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Buscador en tiempo real
        document.getElementById('buscador').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll('tbody tr');
            filas.forEach(function(fila) {
                let textoFila = fila.textContent.toLowerCase();
                if (textoFila.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>