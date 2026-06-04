<?php
// 1. Línea de código de la conexión hacia la base de datos
$conexion = mysqli_connect("localhost", "root", "", "empresa_db");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// 2. Recuperar los valores capturados en el formulario del ARCHIVO 1 (guardados en variables locales)
$nombre_capturado = $_POST['nombre'];
$apellidos_capturados = $_POST['apellidos'];
$id_departamento_capturado = $_POST['id_departamento'];

// 3. Instrucción INSERT INTO de SQL
$sql_insert = "INSERT INTO empleados (nombre, apellidos, id_departamento) 
               VALUES ('$nombre_capturado', '$apellidos_capturados', '$id_departamento_capturado')";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Inserción</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .mensaje-contenedor {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 400px;
        }
        .exito { color: #28a745; }
        .error { color: #dc3545; }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        a:hover { background-color: #5a6268; }
    </style>
</head>
<body>

    <div class="mensaje-contenedor">
        <?php
        // 4 y 5. Ejecutar la instrucción INSERT INTO y Mostrar el aviso en pantalla
        if (mysqli_query($conexion, $sql_insert)) {
            echo "<h2 class='exito'>¡Registro Exitoso!</h2>";
            echo "<p>El empleado <strong>$nombre_capturado $apellidos_capturados</strong> ha sido guardado de manera satisfactoria en la base de datos MySQL.</p>";
        } else {
            echo "<h2 class='error'>Error al guardar</h2>";
            echo "<p>Hubo un problema: " . mysqli_error($conexion) . "</p>";
        }

        // Cerramos la conexión
        mysqli_close($conexion);
        ?>
        <a href="alta_tabla_relacionada.php">Volver al Formulario</a>
    </div>

</body>
</html>