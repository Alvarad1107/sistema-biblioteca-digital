<?php
require '../config/seguridad.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e2e8f0; color: #333333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2b3a30; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 0.8rem 0; }
        .navbar-brand { color: #ffffff !important; font-weight: 700; font-size: 1.3rem; }
        .navbar-brand span { color: #a8bba1; font-weight: 400; }
        .main-card { background-color: #f4f1ea; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 2.5rem; }
        .btn-dark-green { background-color: #2b3a30; color: #ffffff; border: none; border-radius: 6px; font-weight: 500; padding: 0.6rem 1.5rem; transition: background-color 0.2s; }
        .btn-dark-green:hover { background-color: #1e2922; color: #ffffff; }
        .form-control, .form-select { border: 1px solid #cccccc; border-radius: 8px; padding: 12px; }
        label { color: #2b3a30; font-weight: 600; margin-bottom: 8px; }
    </style>
</head>
<body>
    <nav class="navbar mb-5">
        <div class="container">
            <a class="navbar-brand" href="../dashboard.php">Biblioteca<span>Digital</span></a>
            <div class="d-flex">
                <a href="../dashboard.php" class="btn btn-sm btn-outline-light text-white px-3 py-2">Volver al Panel</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="main-card">
                    <h2 class="mb-4 text-center">Registrar Nuevo Empleado</h2>
                    
                    <form action="usuario_guardar.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" name="nombre_completo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico (Para iniciar sesión)</label>
                            <input type="email" class="form-control" name="correo" required>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="clave" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nivel de Acceso (Rol)</label>
                                <select class="form-select" name="nivel_acceso" required>
                                    <option value="" disabled selected>Seleccione el rol...</option>
                                    <option value="Bibliotecario">Bibliotecario</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Administrador">Administrador</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="usuario_lista.php" class="text-decoration-none" style="color: #2b3a30; font-weight: 600;">Cancelar</a>
                            <button type="submit" class="btn-dark-green">Guardar Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>