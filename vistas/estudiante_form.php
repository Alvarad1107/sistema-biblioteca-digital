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
    <title>Nuevo Estudiante - Biblioteca</title>
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
        <div class="card p-4 shadow-lg col-md-8 mx-auto">
            <h2 class="mb-4 text-center">Registrar Estudiante</h2>
            
            <form action="../procesos/estudiante_guardar.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Carnet</label>
                        <input type="text" class="form-control" name="carnet" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" name="nombre_completo" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Carrera</label>
                    <input type="text" class="form-control" name="carrera" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="correo" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="estudiante_lista.php" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>