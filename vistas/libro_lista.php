<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit(); }
require '../config/conexion.php';
$resultado = $conn->query("SELECT libros.id, libros.codigo, libros.titulo, libros.autor, libros.stock, categorias.nombre AS categoria FROM libros LEFT JOIN categorias ON libros.categoria_id = categorias.id");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark p-3">
        <div class="container"><a class="navbar-brand fw-bold" href="dashboard.php">Biblioteca Digital</a><a href="../procesos/logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a></div>
    </nav>
    <div class="container mt-5 mb-5">
        <div class="card p-4 shadow-lg">
            <div class="d-flex justify-content-between mb-4">
                <h2 class="m-0">Inventario de Libros</h2>
                <a href="libro_form.php" class="btn btn-primary">Nuevo Libro</a>
            </div>
            <table class="table table-hover table-dark mb-0">
                <thead><tr><th>Código</th><th>Título</th><th>Autor</th><th>Categoría</th><th>Stock</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php while($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $fila['codigo']; ?></td>
                            <td><?php echo $fila['titulo']; ?></td>
                            <td><?php echo $fila['autor']; ?></td>
                            <td><?php echo $fila['categoria']; ?></td>
                            <td><?php echo $fila['stock']; ?></td>
                            <td>
                                <a href="libro_editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="../procesos/libro_eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="mt-4"><a href="dashboard.php" class="btn btn-outline-secondary">Volver</a></div>
        </div>
    </div>
</body>
</html>