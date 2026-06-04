<?php include("conexion_hosting_ulises.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Completo de Propietarios</title>
    <style>
        body { background-color: #fdfae7; font-family: 'Times New Roman', Times, serif; }
        .main-container { width: 95%; margin: 20px auto; border: 1px solid #ccc; background-color: #e6e6e6; padding: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 0.9em; }
        th, td { border: 1px solid #99c; padding: 8px; text-align: center; }
        th { background-color: #000080; color: white; }
        .btn-delete { color: red; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>
    <div class="main-container">
        <h2 align="center">Catálogo Completo de Propietarios</h2>
        <table>
            <tr>
                <th>ID</th><th>Nombre</th><th>Ap. Paterno</th><th>Ap. Materno</th>
                <th>RFC</th><th>CURP</th><th>Domicilio</th><th>Teléfono</th>
                <th>Correo</th><th>F. Nacimiento</th><th>F. Registro</th><th>Acción</th>
            </tr>
            <?php
            // Seleccionamos todas las columnas según tu base de datos
            $sql = "SELECT id_propietario, nombre, apellido_paterno, apellido_materno, rfc, curp, domicilio, telefono, correo_electronico, fecha_nacimiento, fecha_registro FROM Propietarios";
            $resultado = $conn->query($sql);
            
            while($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$fila['id_propietario']."</td>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$fila['apellido_paterno']."</td>";
                echo "<td>".$fila['apellido_materno']."</td>";
                echo "<td>".$fila['rfc']."</td>";
                echo "<td>".$fila['curp']."</td>";
                echo "<td>".$fila['domicilio']."</td>";
                echo "<td>".$fila['telefono']."</td>";
                echo "<td>".$fila['correo_electronico']."</td>";
                echo "<td>".$fila['fecha_nacimiento']."</td>";
                echo "<td>".$fila['fecha_registro']."</td>";
                echo "<td><a class='btn-delete' href='eliminar_registro_catalogo.php?id=".$fila['id_propietario']."' 
                      onclick=\"return confirm('¿Está seguro de eliminar al propietario ".$fila['nombre']."?');\">Eliminar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>