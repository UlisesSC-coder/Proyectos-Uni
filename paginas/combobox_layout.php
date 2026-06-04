<?php
    // Conexión a la base de datos
    require_once "conexion.php";

    // Consulta para recuperar los registros
    $sql = "SELECT * FROM empleados";

    // Ejecutamos la consulta
    $result = $conn->query($sql);

    // Recuperamos los registros en un arreglo
    $rows = $result->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout para prácticas de PHP</title>
    <style>
        /* Estilos básicos para el Layout */
        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            padding: 20px;
            font-family: sans-serif;
        }
        .item {
            border: 1px solid #ccc;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .item1 { grid-column: 1 / span 2; } /* Encabezado ocupando 2 columnas */
        
        select, input[type="submit"] {
            margin-top: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>

<div class="grid">
    <div class="item item1">Caja 1 - Encabezado del Sistema</div>
    <div class="item item2">Caja 2 - Información Lateral</div>
    
    <div class="item item3">
        <h3>Consulta de Departamentos</h3>
        <form action="detalle_departamento.php" method="post" id="formulario1">
            <div>
                <p>
                    <label for="departamento">Id del empleado:</label>
                    <select name="departamento" id="departamento">
                        <option value="0">Selecciona un registro...</option>
                        <?php
                        foreach ($rows as $row) {
                            // Cambiado a 'numero' y 'nombre' según tu imagen
                            echo '<option value="'.$row['numero'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>&nbsp;</p>
                <p>
                    <input type="submit" name="buscarDpto" value=" Buscar datos del departamento " />
                </p>
            </div>
        </form>
    </div>

    <div class="item item4">Caja 4 - Pie de página o sección adicional</div>
</div>

</body>
</html>