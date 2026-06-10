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
    <title>Nueva Categoría - Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark p-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a>
            <a href="../procesos/logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg col-md-6 mx-auto">
            <h2 class="mb-4 text-center">Registrar Categoría</h2>
            
            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div class="alert alert-success bg-success text-white border-0 mb-4" role="alert">Categoría guardada exitosamente.</div>
            <?php endif; ?>
            <?php if (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                <div class="alert alert-danger bg-danger text-white border-0 mb-4" role="alert">Error al guardar o el nombre ya existe.</div>
            <?php endif; ?>

            <form action="../procesos/categoria_guardar.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nombre de la Categoría</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="3"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="categoria_lista.php" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>