<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit(); }
require '../config/conexion.php';
$categorias = $conn->query("SELECT id, nombre FROM categorias");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark p-3">
        <div class="container"><a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a><a href="../procesos/logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a></div>
    </nav>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg col-md-8 mx-auto">
            <h2 class="mb-4 text-center">Registrar Libro</h2>
            <form action="../procesos/libro_guardar.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3"><label>Código</label><input type="text" class="form-control" name="codigo" required></div>
                    <div class="col-md-6 mb-3">
                        <label>Categoría</label>
                        <select class="form-select" name="categoria_id" required>
                            <option value="">Selecciona...</option>
                            <?php while($cat = $categorias->fetch_assoc()): ?><option value="<?php echo $cat['id']; ?>"><?php echo $cat['nombre']; ?></option><?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3"><label>Título</label><input type="text" class="form-control" name="titulo" required></div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label>Autor</label><input type="text" class="form-control" name="autor" required></div>
                    <div class="col-md-6 mb-3"><label>Editorial</label><input type="text" class="form-control" name="editorial"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4"><label>Año</label><input type="number" class="form-control" name="anio_publicacion"></div>
                    <div class="col-md-6 mb-4"><label>Stock</label><input type="number" class="form-control" name="stock" value="1" required></div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="libro_lista.php" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>