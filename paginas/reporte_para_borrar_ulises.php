<?php include("conexion_hosting_ulises.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte para Borrar</title>
    <script>
        function confirmarBorrado(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este predio? Esta acción no se puede deshacer.")) {
                window.location.href = 'eliminar_registro.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h2>Lista de Predios (Reporte para Borrar)</h2>
    <table border="1">
        <tr>
            <th>Clave Castral</th>
            <th>Propietario</th> <th>Tipo Propiedad</th>
            <th>Ubicación</th>
            <th>Acción</th>
        </tr>
        <?php
        // Consulta con INNER JOIN para traer el nombre del propietario
        $sql = "SELECT p.clave_castral, pr.nombre, pr.apellido_paterno, p.tipo_propiedad, p.ubicacion_domicilio 
                FROM Predios p 
                INNER JOIN Propietarios pr ON p.id_propietario = pr.id_propietario";
        $result = $conn->query($sql);
        while($fila = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$fila['clave_castral']."</td>";
            echo "<td>".$fila['nombre']." ".$fila['apellido_paterno']."</td>";
            echo "<td>".$fila['tipo_propiedad']."</td>";
            echo "<td>".$fila['ubicacion_domicilio']."</td>";
            // Liga que llama a la función JavaScript
            echo "<td><a href='#' onclick='confirmarBorrado(".$fila['clave_castral'].")'>Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>