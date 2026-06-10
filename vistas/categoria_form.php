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
    <title>Nueva Categoría - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .navbar {
            background-color: #1e1e1e;
            border-bottom: 1px solid #333;
        }
        .navbar-brand {
            color: #ffffff !important;
        }
        .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 10px;
            color: #ffffff !important;
        }
        .form-control {
            background-color: #2b2b2b;
            border: 1px solid #444;
            color: #ffffff;
        }
        .form-control:focus {
            background-color: #333;
            border-color: #0d6efd;
            color: #ffffff;
            box-shadow: none;
        }
        h2 {
            color: #ffffff !important;
        }
        label {
            color: #ffffff !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <div class="alert alert-success bg-success text-white border-0 mb-4" role="alert">
                        Categoría guardada exitosamente.
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                    <div class="alert alert-danger bg-danger text-white border-0 mb-4" role="alert">
                        Error al guardar la categoría o el nombre ya existe.
                    </div>
                <?php endif; ?>

                <div class="card p-4 shadow-lg">
                    <h2 class="mb-4 text-center">Registrar Categoría</h2>
                    
                    <form action="categoria_guardar.php" method="POST">
                        <div class="mb-3">
                            <label临时 for="nombre" class="form-label">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="dashboard.php" class="btn btn-outline-secondary">Volver</a>
                            <button type="submit" class="btn btn-primary px-4">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>