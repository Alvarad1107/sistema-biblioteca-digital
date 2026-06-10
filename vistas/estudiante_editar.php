<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

// Validamos que venga un ID válido por la URL
if (!isset($_GET['id'])) {
    header("Location: estudiante_lista.php");
    exit();
}

$id = $_GET['id'];

// Buscamos los datos actuales del estudiante
$sql = "SELECT * FROM estudiantes WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $estudiante = $resultado->fetch_assoc();
} else {
    // Si el ID no existe, lo mandamos de regreso
    header("Location: estudiante_lista.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #ffffff; }
        .navbar { background-color: #1e1e1e; border-bottom: 1px solid #333; }
        .card { background-color: #1e1e1e; border: 1px solid #333; border-radius: 10px; }
        .form-control { background-color: #2b2b2b; border: 1px solid #444; color: #ffffff; }
        .form-control:focus { background-color: #333; border-color: #0d6efd; color: #ffffff; box-shadow: none; }
        label { color: #e0e0e0; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg">
                    <h2 class="mb-4 text-center text-white">Modificar Estudiante</h2>
                    
                    <form action="estudiante_actualizar.php" method="POST">
                        <input type="hidden" name="id" value="<?= $estudiante['id'] ?>">
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Carnet</label>
                                <input type="text" class="form-control" name="carnet" value="<?= htmlspecialchars($estudiante['carnet']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" name="nombre_completo" value="<?= htmlspecialchars($estudiante['nombre_completo']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo" value="<?= htmlspecialchars($estudiante['correo']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Carrera</label>
                                <input type="text" class="form-control" name="carrera" value="<?= htmlspecialchars($estudiante['carrera']) ?>" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" value="<?= htmlspecialchars($estudiante['telefono']) ?>">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="estudiante_lista.php" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning px-4 text-dark fw-bold">Actualizar Datos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>