<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit(); }
require '../config/conexion.php';
$resultado = $conn->query("SELECT id, nombre, descripcion FROM categorias");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark p-3">
        <div class="container"><a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a><a href="../procesos/logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a></div>
    </nav>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg col-md-10 mx-auto">
            <div class="d-flex justify-content-between mb-4"><h2 class="m-0">Categorías</h2><a href="categoria_form.php" class="btn btn-primary">Nueva</a></div>
            <table class="table table-hover table-dark mb-0">
                <thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php while($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $fila['id']; ?></td><td><?php echo $fila['nombre']; ?></td><td><?php echo $fila['descripcion']; ?></td>
                            <td><a href="categoria_editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-warning">Editar</a> <a href="../procesos/categoria_eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-danger">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="mt-4"><a href="dashboard.php" class="btn btn-outline-secondary">Volver</a></div>
        </div>
    </div>
</body>
</html>