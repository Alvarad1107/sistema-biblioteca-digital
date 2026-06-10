<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel - Biblioteca Digital</title>
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
        <div class="card p-5 shadow-lg col-md-10 mx-auto">
            <h2 class="mb-1">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
            <p class="text-muted-dark mb-4">Acceso: <span class="badge bg-primary"><?php echo htmlspecialchars($_SESSION['nivel_acceso']); ?></span></p>
            <hr style="border-color: #444;">
            <div class="row mt-4">
                <div class="col-md-3 mb-3"><div class="card p-3 text-center" style="background:#2b2b2b;"><h5>Categorías</h5><a href="categoria_lista.php" class="btn btn-primary btn-sm">Abrir</a></div></div>
                <div class="col-md-3 mb-3"><div class="card p-3 text-center" style="background:#2b2b2b;"><h5>Libros</h5><a href="libro_lista.php" class="btn btn-primary btn-sm">Abrir</a></div></div>
                <div class="col-md-3 mb-3"><div class="card p-3 text-center" style="background:#2b2b2b;"><h5>Estudiantes</h5><a href="estudiante_lista.php" class="btn btn-primary btn-sm">Abrir</a></div></div>
                <div class="col-md-3 mb-3"><div class="card p-3 text-center" style="background:#2b2b2b;"><h5>Préstamos</h5><a href="prestamo_form.php" class="btn btn-primary btn-sm">Abrir</a></div></div>
            </div>
        </div>
    </div>
</body>
</html>