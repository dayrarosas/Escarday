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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .success {
            color: #22c55e;
            font-size: 48px;
            margin-bottom: 20px;
        }

        .error {
            color: #ef4444;
            font-size: 48px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .error-message {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            padding: 15px;
            margin-bottom: 20px;
            text-align: left;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
    </style>
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
