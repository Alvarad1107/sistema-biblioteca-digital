<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require '../config/conexion.php';

$sql = "SELECT id, nombre, descripcion FROM categorias";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorías - Biblioteca Digital</title>
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-4 shadow-lg">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="m-0">Categorías Registradas</h2>
                        <a href="categoria_form.php" class="btn btn-primary">Nueva Categoría</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-dark mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($resultado->num_rows > 0): ?>
                                    <?php while($fila = $resultado->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $fila['id']; ?></td>
                                            <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                                            <td>
                                                <a href="categoria_editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                                <a href="categoria_eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?');">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No hay categorías registradas.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        <a href="../dashboard.php" class="btn btn-outline-secondary">Volver al Panel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>