<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$sql = "SELECT libros.id, libros.codigo, libros.titulo, libros.autor, libros.stock, categorias.nombre AS categoria 
        FROM libros 
        LEFT JOIN categorias ON libros.categoria_id = categorias.id";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Libros - Biblioteca Digital</title>
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
        }
        .table {
            color: #ffffff;
        }
        .table-dark th {
            background-color: #2b2b2b;
            border-color: #444;
        }
        .table td, .table th {
            border-color: #444;
            background-color: transparent !important;
            color: #ffffff !important;
        }
        .table-hover tbody tr:hover td {
            background-color: #333333 !important;
        }
        h2 {
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
            <div class="col-md-12">
                <div class="card p-4 shadow-lg">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="m-0">Inventario de Libros</h2>
                        <a href="libro_form.php" class="btn btn-primary">Nuevo Libro</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-dark mb-0">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($resultado->num_rows > 0): ?>
                                    <?php while($fila = $resultado->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($fila['codigo']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['titulo']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['autor']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['categoria']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['stock']); ?></td>
                                            <td>
                                                <a href="libro_editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                                <a href="libro_eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este libro?');">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No hay libros registrados.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        <a href="dashboard.php" class="btn btn-outline-secondary">Volver al Panel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>