<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

if (!isset($_GET['id'])) {
    header("Location: libro_lista.php");
    exit();
}

$id = $_GET['id'];
$sql_libro = "SELECT * FROM libros WHERE id = $id";
$resultado_libro = $conn->query($sql_libro);

if ($resultado_libro->num_rows == 0) {
    header("Location: libro_lista.php");
    exit();
}

$libro = $resultado_libro->fetch_assoc();

$sql_cat = "SELECT id, nombre FROM categorias";
$categorias = $conn->query($sql_cat);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro - Biblioteca Digital</title>
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
        .form-control, .form-select {
            background-color: #2b2b2b;
            border: 1px solid #444;
            color: #ffffff;
        }
        .form-control:focus, .form-select:focus {
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

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg">
                    <h2 class="mb-4 text-center">Editar Libro</h2>
                    
                    <form action="libro_actualizar.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="codigo" class="form-label">Código del Libro</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo htmlspecialchars($libro['codigo']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="categoria_id" class="form-label">Categoría</label>
                                <select class="form-select" id="categoria_id" name="categoria_id" required>
                                    <option value="">Selecciona una categoría...</option>
                                    <?php while($cat = $categorias->fetch_assoc()): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $libro['categoria_id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($cat['nombre']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($libro['titulo']); ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="autor" class="form-label">Autor</label>
                                <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($libro['autor']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editorial" class="form-label">Editorial</label>
                                <input type="text" class="form-control" id="editorial" name="editorial" value="<?php echo htmlspecialchars($libro['editorial']); ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="anio_publicacion" class="form-label">Año de Publicación</label>
                                <input type="number" class="form-control" id="anio_publicacion" name="anio_publicacion" value="<?php echo htmlspecialchars($libro['anio_publicacion']); ?>">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($libro['stock']); ?>" required>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="libro_lista.php" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success px-4">Actualizar Libro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>