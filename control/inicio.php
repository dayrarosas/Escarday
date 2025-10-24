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

$sql = "SELECT id, nombre, numerodecontrol, rol, foto FROM alumnos";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Alumnos</title>
    <style>
        table, th, td { border: 1px solid black; }
        body { font-family: Helvetica, Arial; margin: 20px; background-color: #fffefedc; }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .escarday { background: linear-gradient(135deg, #667eea 0%, #2d3aafff 100%); color: white; text-align: center; padding: 20px; font-size: 24px; }
        thead th { background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%); color: white; padding: 15px; }
        tbody tr:nth-child(4n+1) { background-color: #d6a8d2ff; }
        tbody tr:nth-child(4n+2) { background-color: #b0f5b6ff; }
        tbody tr:nth-child(4n+3) { background-color: #b8bdf7ff; }
        tbody tr:nth-child(4n) { background-color: #9cf5a0ff; }
        tbody tr:hover { background-color: #fff9c4 !important; transform: scale(1.02); box-shadow: 0 4px 8px rgba(0,0,0,0.2); transition: all 0.3s; cursor: pointer; }
        td { padding: 12px; text-align: center; vertical-align: middle; }
        td img { width: 120px; height: 150px; object-fit: cover; border-radius: 8px; border: 3px solid #ddd; }
        td img:hover { transform: scale(1.1); border-color: #4a90e2; }
        .btn-eliminar {
            background-color: #e24a4a;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-eliminar:hover { background-color: #c0392b; }
    </style>
</head>
<body>
    <h1>Lista de Alumnos</h1>

    <?php if (mysqli_num_rows($resultado) > 0): ?>
        <table>
            <thead>
                <tr><th colspan="6" class="escarday">EQUIPO ESCARDAY</th></tr>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Número de Control</th>
                    <th>Rol</th>
                    <th>Foto</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><a href="https://www.google.com/search?q=<?php echo urlencode($row["nombre"]); ?>" target="_blank"><?php echo $row["nombre"]; ?></a></td>
                    <td><?php echo $row["numerodecontrol"]; ?></td>
                    <td><?php echo $row["rol"]; ?></td>
                    <td><img src="<?php echo $row['foto']; ?>" alt="Foto de <?php echo $row['nombre']; ?>"></td>
                    <td>
                        
                        <form action="eliminar.php" method="POST" onsubmit="return confirm('¿Quieres eliminar a <?php echo $row['nombre']; ?>?');">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay alumnos registrados</p>
    <?php endif; ?>
</body>
</html>

<?php mysqli_close($conexion); ?>
