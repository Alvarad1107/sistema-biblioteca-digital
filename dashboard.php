<?php
require 'config/seguridad.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e2e8f0; color: #333333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #2b3a30; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 0.8rem 0; }
        .navbar-brand { color: #ffffff !important; font-weight: 700; font-size: 1.3rem; }
        .navbar-brand span { color: #a8bba1; font-weight: 400; }
        
        .btn-logout { border: 1px solid #ff6b6b; color: #ff6b6b; border-radius: 6px; transition: all 0.2s; text-decoration: none; }
        .btn-logout:hover { background-color: #ff6b6b; color: #ffffff; }
        
        .main-card { background-color: #f4f1ea; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); padding: 2.5rem; }
        .badge-rol { background-color: #2b3a30; font-size: 0.9rem; padding: 0.4em 0.8em; border-radius: 6px; color: white;}
        
        .module-card { background-color: #ffffff; border: none; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: transform 0.2s ease, box-shadow 0.2s ease; text-align: center; padding: 1.5rem; height: 100%; }
        .module-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .module-card h4 { color: #2b3a30; font-weight: 600; margin-bottom: 10px; }
        .module-card p { color: #666666; font-size: 0.9rem; margin-bottom: 20px; }
        
        .btn-dark-green { background-color: #2b3a30; color: #ffffff; border: none; border-radius: 6px; font-weight: 500; width: 100%; padding: 0.5rem; text-decoration: none; display: inline-block; transition: background-color 0.2s;}
        .btn-dark-green:hover { background-color: #1e2922; color: #ffffff; }
    </style>
</head>
<body>

    <nav class="navbar mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand m-0" href="dashboard.php">Biblioteca<span>Digital</span></a>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-sm btn-logout px-3 py-2">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="main-card">


    <?php
        $nombres = explode(' ', $_SESSION['nombre_completo']);
        $primer_nombre = $nombres[0];
        $ultima_letra = mb_strtolower(mb_substr($primer_nombre, -1, 1, 'UTF-8'), 'UTF-8');
        $saludo = ($ultima_letra == 'a') ? 'Bienvenida' : 'Bienvenido';
    ?>
        <h1 class="fw-bold" style="color: #2b3a30;"><?= $saludo ?>, <?= htmlspecialchars($_SESSION['nombre_completo']) ?></h1>
        
<p class="mb-4" style="font-size: 1.1rem;">
    Nivel de acceso: 
    <span class="badge rounded-2" style="background-color: #2b3a30; color: #ffffff; padding: 8px 12px; font-weight: normal;">
        <?= htmlspecialchars($_SESSION['nivel_acceso']) ?>
    </span>
</p>

<?php if (isset($_GET['error']) && $_GET['error'] == 'denegado'): ?>
    <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
        <strong><i class="bi bi-shield-lock"></i> Acceso Denegado:</strong> Tu nivel de usuario no tiene los permisos necesarios para entrar a esa sección o realizar esa acción.
    </div>
<?php endif; ?>
<p class="text-muted mb-5">Panel de administración principal. Selecciona una de las herramientas de abajo para comenzar a trabajar.</p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="module-card">
                        <h4>Categorías</h4>
                        <p>Registrar clasificaciones.</p>
                        <a href="categorias/categoria_lista.php" class="btn-dark-green">Abrir</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="module-card">
                        <h4>Libros</h4>
                        <p>Gestión de inventario.</p>
                        <a href="libros/libro_lista.php" class="btn-dark-green">Abrir</a>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="module-card">
                    <h4>Préstamos</h4>
                    <p>Control de salidas y devoluciones.</p>
                    <a href="prestamos/prestamo_lista.php" class="btn-dark-green">Abrir</a>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="module-card">
                        <h4>Estudiantes</h4>
                        <p>Gestión de usuarios/clientes.</p>
                        <a href="estudiantes/estudiante_lista.php" class="btn-dark-green">Abrir</a>
                    </div>
                </div>
                <?php if ($_SESSION['nivel_acceso'] == 'Administrador'): ?>
                <div class="col-md-4">
                    <div class="module-card">
                        <h4>Gestión de Usuarios</h4>
                        <p>Añadir y administrar empleados.</p>
                        <a href="usuarios/usuario_lista.php" class="btn-dark-green">Abrir</a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($_SESSION['nivel_acceso'] == 'Administrador' || $_SESSION['nivel_acceso'] == 'Supervisor'): ?>
                <div class="col-md-4">
                    <div class="module-card">
                        <h4>Reportes</h4>
                        <p>Estadísticas e historial.</p>
                        <a href="reportes.php" class="btn-dark-green">Abrir</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>