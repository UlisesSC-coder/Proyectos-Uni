<?php
// Incluimos el archivo de conexión renombrado
include("conexion_empleados.php");

// Recuperamos los datos del Archivo 1
$v_dep = $_POST['departamento'];
$v_desc = $_POST['descripcion'];

// Instrucción SQL
$sql = "INSERT INTO departamentos (departamento, descripcion) VALUES ('$v_dep', '$v_desc')";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de Inserción</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #eef2f3; text-align: center; padding-top: 100px; }
        .alerta { 
            background: white; display: inline-block; padding: 40px; 
            border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .exito { color: #27ae60; font-size: 40px; margin-bottom: 10px; }
        .nombre-alumno { color: #2c3e50; font-weight: bold; border-top: 1px solid #eee; margin-top: 20px; padding-top: 10px; }
        .link { display: inline-block; margin-top: 20px; text-decoration: none; color: #2980b9; }
    </style>
</head>
<body>

<div class="alerta">
    <?php
    if (mysqli_query($conexion, $sql)) {
        echo "<div class='exito'>✔</div>";
        echo "<h3>¡Registro Guardado Satisfactoriamente!</h3>";
        echo "<p>Se registró el departamento: <strong>$v_desc</strong> ($v_dep)</p>";
        echo "<div class='nombre-alumno'>Realizado por: Ulises Sánchez Camarena / Abraham Vega Tapia</div>";
    } else {
        echo "<h3>Error al registrar</h3>";
        echo "Detalle: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
    ?>
    <br>
    <a href="alta_departamentos.php" class="link">← Volver a registrar otro</a>
</div>

</body>
</html>