<?php
require '../config/seguridad.php';
require '../config/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Estudiante - Biblioteca Digital</title>
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
        .btn-dark-green { background-color: #2b3a30; color: #ffffff; border: none; border-radius: 6px; font-weight: 500; padding: 0.6rem 1.5rem; transition: background-color 0.2s; }
        .btn-dark-green:hover { background-color: #1e2922; color: #ffffff; }
        .form-control { border: 1px solid #cccccc; border-radius: 8px; padding: 12px; background-color: #ffffff; }
        .form-control:focus { border-color: #2b3a30; box-shadow: 0 0 0 0.2rem rgba(43, 58, 48, 0.25); }
        label { color: #2b3a30; font-weight: 600; margin-bottom: 8px; font-size: 0.95rem; }
        .btn-return {
            color: #2b3a30;
            background-color: #e2e8f0;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .btn-return:hover {
            background-color: #cbd5e1;
            color: #2b3a30;
        }
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <div class="alert alert-success border-0 mb-4 rounded-3 shadow-sm">Estudiante registrado exitosamente.</div>
                <?php endif; ?>

                <div class="main-card">
                    <h2 class="mb-4 text-center">Registrar Estudiante</h2>
                    
                    <form action="estudiante_guardar.php" method="POST">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Carnet</label>
                                <input type="text" class="form-control" name="carnet" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" name="nombre_completo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Carrera</label>
                                <input type="text" class="form-control" name="carrera" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="estudiante_lista.php" class="btn-return">Volver a la lista</a>
                            <button type="submit" class="btn-dark-green">Guardar Estudiante</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>