<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit(); }
require '../config/conexion.php';
$id = $_GET['id'];
$libro = $conn->query("SELECT * FROM libros WHERE id = $id")->fetch_assoc();
$categorias = $conn->query("SELECT id, nombre FROM categorias");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark p-3">
        <div class="container"><a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a></div>
    </nav>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg col-md-8 mx-auto">
            <h2 class="mb-4 text-center">Editar Libro</h2>
            <form action="../procesos/libro_actualizar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">
                <div class="row">
                    <div class="col-md-6 mb-3"><label>Código</label><input type="text" class="form-control" name="codigo" value="<?php echo $libro['codigo']; ?>" required></div>
                    <div class="col-md-6 mb-3">
                        <label>Categoría</label>
                        <select class="form-select" name="categoria_id" required>
                            <?php while($cat = $categorias->fetch_assoc()): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $libro['categoria_id']) ? 'selected' : ''; ?>><?php echo $cat['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3"><label>Título</label><input type="text" class="form-control" name="titulo" value="<?php echo $libro['titulo']; ?>" required></div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label>Autor</label><input type="text" class="form-control" name="autor" value="<?php echo $libro['autor']; ?>" required></div>
                    <div class="col-md-6 mb-3"><label>Editorial</label><input type="text" class="form-control" name="editorial" value="<?php echo $libro['editorial']; ?>"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4"><label>Año</label><input type="number" class="form-control" name="anio_publicacion" value="<?php echo $libro['anio_publicacion']; ?>"></div>
                    <div class="col-md-6 mb-4"><label>Stock</label><input type="number" class="form-control" name="stock" value="<?php echo $libro['stock']; ?>" required></div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="libro_lista.php" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>