<?php
$servidor = "127.0.0.1";
$usuario = "root";
$password = "";
$bd = "apm";
$puerto = 3307;  
$conexion = mysqli_connect($servidor, $usuario, $password, $bd, $puerto);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Alumno</title>
    
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST['id'])) {
            $id = mysqli_real_escape_string($conexion, $_POST['id']);

            $sql = "DELETE FROM alumnos WHERE id = $id";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo '<div class="success">✓</div>';
                echo '<h2>¡Eliminado con éxito!</h2>';
                echo '<p>El alumno se eliminó correctamente de la base de datos.</p>';
            } else {
                echo '<div class="error">✗</div>';
                echo '<h2>Error al eliminar</h2>';
                echo '<div class="error-message">' . mysqli_error($conexion) . '</div>';
            }
            
            echo '<a href="inicio.php" class="btn">Volver al inicio</a>';
        } else {
            echo '<div class="error">⚠</div>';
            echo '<h2>Error</h2>';
            echo '<p>No se recibió ningún ID para eliminar.</p>';
            echo '<a href="inicio.php" class="btn">Volver al inicio</a>';
        }

        mysqli_close($conexion);
        ?>
    </div>
</body>
</html>

