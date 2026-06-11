<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e2e8f0; 
            color: #333333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #2b3a30; /* Verde oscuro elegante */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1.3rem;
        }
        .navbar-brand span {
            color: #a8bba1; 
            font-weight: 400;
        }
        .main-card {
            background-color: #f4f1ea; 
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 2.5rem;
        }
        .badge-rol {
            background-color: #2b3a30;
            font-size: 0.9rem;
            padding: 0.4em 0.8em;
            border-radius: 6px;
        }
        .module-card {
            background-color: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-align: center;
            padding: 1.5rem;
            height: 100%;
        }
        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .module-card h4 {
            color: #2b3a30;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .module-card p {
            color: #666666;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        .btn-dark-green {
            background-color: #2b3a30;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            width: 100%;
            padding: 0.5rem;
            text-decoration: none;
            display: inline-block;
        }
        .btn-dark-green:hover {
            background-color: #1e2922;
            color: #ffffff;
        }
        .btn-outline-light-custom {
            border: 1px solid #ffffff;
            color: #ffffff;
            border-radius: 6px;
        }
        .btn-outline-light-custom:hover {
            background-color: #ffffff;
            color: #2b3a30;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Biblioteca<span>Digital</span></a>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-outline-light-custom btn-sm px-3">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="main-card">
                    
                    <div class="mb-5">
                        <h1 class="fw-bold text-dark mb-2">Bienvenido, Admin General</h1>
                        <p class="mb-3">Nivel de acceso: <span class="badge text-white badge-rol">Administrador</span></p>
                        <p class="text-muted">Panel de administración principal. Selecciona una de las herramientas de abajo para comenzar a trabajar.</p>
                    </div>
                    
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
                                <h4>Estudiantes</h4>
                                <p>Gestión de usuarios/clientes.</p>
                                <a href="estudiantes/estudiante_lista.php" class="btn-dark-green">Abrir</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>