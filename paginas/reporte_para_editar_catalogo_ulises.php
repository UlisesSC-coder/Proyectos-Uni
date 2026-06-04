<?php 
// 1. Conexión a la base de datos
include("conexion_hosting_ulises.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte para Editar - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: 'Times New Roman', Times, serif; }
        .container { width: 95%; margin: 30px auto; background-color: #e6e6e6; padding: 20px; border: 1px solid #ccc; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        h2 { color: #000080; text-align: center; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background-color: white; font-size: 14px; }
        th { background-color: #000080; color: white; padding: 12px; text-align: center; border: 1px solid #fff; }
        td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        .btn-editar { padding: 5px 12px; background: #eee; border: 1px solid #000080; cursor: pointer; font-weight: bold; font-family: 'Times New Roman', serif; transition: 0.3s; }
        .btn-editar:hover { background: #000080; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reporte Completo de Propietarios</h2>
        <p style="text-align: center;">Listado general de registros en la base de datos.</p>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>RFC</th>
                    <th>CURP</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta con todos los campos de la tabla Propietarios
                $query = "SELECT id_propietario, nombre, apellido_paterno, apellido_materno, rfc, curp, telefono, correo_electronico FROM Propietarios";
                $stmt = $conn->query($query);

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_propietario'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['apellido_paterno'] . "</td>";
                    echo "<td>" . $row['apellido_materno'] . "</td>";
                    echo "<td>" . $row['rfc'] . "</td>";
                    echo "<td>" . $row['curp'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['correo_electronico'] . "</td>";
                    // Columna de Acciones
                    echo "<td>
                            <a href='editar_registro_catalogo.php?id=" . $row['id_propietario'] . "'>
                                <button type='button' class='btn-editar'>Editar</button>
                            </a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>