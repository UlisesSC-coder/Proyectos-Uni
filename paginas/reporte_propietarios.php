<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Propietarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-volver {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h2>Reporte General de la Tabla Catálogo: Propietarios</h2>
    
    <a href="alta_tabla1_ulises.php" class="btn-volver">Capturar Nuevo Propietario</a>

    <?php
    // 1. Mandar llamar la conexión a la base de datos
    require_once("conexion_hosting_ulises.php");

    try {
        // 2. Preparar la sentencia SELECT
        $sql = "SELECT * FROM Propietarios";
        $stmt = $conn->query($sql);
        
        // 3. Obtener todos los registros
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 4. Comprobar si hay registros para mostrar
        if (count($registros) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>A. Paterno</th>
                    <th>A. Materno</th>
                    <th>RFC</th>
                    <th>CURP</th>
                    <th>Fecha Registro</th>
                    <th>Domicilio</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Fecha Nacimiento</th>
                  </tr>";

            // 5. Recorrer los registros y dibujarlos en filas de la tabla
            foreach ($registros as $fila) {
                echo "<tr>";
                echo "<td>" . $fila['id_propietario'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['apellido_paterno'] . "</td>";
                echo "<td>" . $fila['apellido_materno'] . "</td>";
                echo "<td>" . $fila['rfc'] . "</td>";
                echo "<td>" . $fila['curp'] . "</td>";
                echo "<td>" . $fila['fecha_registro'] . "</td>";
                echo "<td>" . $fila['domicilio'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";
                echo "<td>" . $fila['correo_electronico'] . "</td>";
                echo "<td>" . $fila['fecha_nacimiento'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay registros guardados en la tabla Propietarios todavía.</p>";
        }

    } catch(PDOException $e) {
        echo "<h2>Error al realizar la consulta:</h2> " . $e->getMessage();
    }
    ?>

</body>
</html>