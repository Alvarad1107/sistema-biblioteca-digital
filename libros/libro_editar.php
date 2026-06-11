<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../index.php");
    exit();
}

require '../config/conexion.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: libro_lista.php");
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM libros WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $libro = $resultado->fetch_assoc();
} else {
    header("Location: libro_lista.php");
    exit();
}

$sql_cat = "SELECT * FROM categorias";
$resultado_cat = $conn->query($sql_cat);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro - Biblioteca Digital</title>
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
        .form-control, .form-select { border: 1px solid #cccccc; border-radius: 8px; padding: 12px; background-color: #ffffff; }
        .form-control:focus, .form-select:focus { border-color: #2b3a30; box-shadow: 0 0 0 0.2rem rgba(43, 58, 48, 0.25); }
        label { color: #2b3a30; font-weight: 600; margin-bottom: 8px; font-size: 0.95rem; }
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
                <div class="main-card">
                    <h2 class="mb-4 text-center">Modificar Libro</h2>
                    
                    <form action="libro_actualizar.php" method="POST">
                        <input type="hidden" name="id" value="<?= $libro['id'] ?>">
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Código del Libro</label>
                                <input type="text" class="form-control" name="codigo" value="<?= htmlspecialchars($libro['codigo'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Categoría</label>
                                <select class="form-select" name="categoria_id" required>
                                    <option value="" disabled>Selecciona una categoría...</option>
                                    <?php if ($resultado_cat && $resultado_cat->num_rows > 0): ?>
                                        <?php while($cat = $resultado_cat->fetch_assoc()): ?>
                                            <option value="<?= $cat['id'] ?>" <?= ($libro['categoria_id'] == $cat['id']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['nombre']) ?></option>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($libro['titulo'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Autor</label>
                                <input type="text" class="form-control" name="autor" value="<?= htmlspecialchars($libro['autor'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Editorial</label>
                                <input type="text" class="form-control" name="editorial" value="<?= htmlspecialchars($libro['editorial'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Año de Publicación</label>
                                <input type="number" class="form-control" name="anio_publicacion" value="<?= htmlspecialchars($libro['anio_publicacion'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" value="<?= htmlspecialchars($libro['stock'] ?? '1') ?>" min="0" required>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="libro_lista.php" class="text-decoration-none text-secondary fw-bold">← Cancelar</a>
                            <button type="submit" class="btn-dark-green">Actualizar Datos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>