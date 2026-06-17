require '../config/seguridad.php';
require '../config/conexion.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $check_sql = "SELECT id FROM libros WHERE categoria_id = $id LIMIT 1";
    $check_resultado = $conn->query($check_sql);

    if ($check_resultado && $check_resultado->num_rows > 0) {
        echo "<script>
                alert('No se puede eliminar esta categoría porque hay libros registrados que la están usando. Elimina o cambia la categoría de esos libros primero.');
                window.location.href = 'categoria_lista.php';
            </script>";
        exit();
    } else {
        $sql = "DELETE FROM categorias WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: categoria_lista.php");
            exit();
        } else {
            echo "Error al eliminar: " . $conn->error;
        }
    }
} else {
    header("Location: categoria_lista.php");
    exit();
}
?>