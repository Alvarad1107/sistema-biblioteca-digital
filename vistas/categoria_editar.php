<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

if (!isset($_GET['id'])) {
    header("Location: categoria_lista.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM categorias WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    header("Location: categoria_lista.php");
    exit();
}

$categoria = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - Biblioteca Digital</title>
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
        h2, label {
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
                <div class="card p-4 shadow-lg">
                    <h2 class="mb-4 text-center">Editar Categoría</h2>
                    
                    <form action="categoria_actualizar.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($categoria['nombre']); ?>" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo htmlspecialchars($categoria['descripcion']); ?></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="categoria_lista.php" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success px-4">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>