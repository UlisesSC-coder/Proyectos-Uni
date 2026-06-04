<?php
include("conexion_hosting_ulises.php");


$sql = "SELECT p.clave_castral, pr.nombre, pr.apellido_paterno, p.tipo_propiedad, p.estatus, p.ubicacion_domicilio 
        FROM Predios p 
        INNER JOIN Propietarios pr ON p.id_propietario = pr.id_propietario";
$stmt = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Relacionado - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: Arial, sans-serif; }
        .container { width: 90%; margin: 30px auto; background: white; padding: 20px; border: 2px solid #000080; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #000080; color: white; padding: 10px; text-transform: uppercase; }
        td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        .btn-edit { background: #000080; color: white; padding: 5px 10px; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align:center; color:#000080;">SISTEMA DE CATASTRO - REPORTE RELACIONADO</h2>
        <table>
            <tr>
                <th>Clave</th>
                <th>Propietario</th>
                <th>Tipo</th>
                <th>Estatus</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['clave_castral']; ?></td>
                <td><?php echo $row['nombre'] . " " . $row['apellido_paterno']; ?></td>
                <td><?php echo $row['tipo_propiedad']; ?></td>
                <td><?php echo $row['estatus']; ?></td>
                <td><?php echo $row['ubicacion_domicilio']; ?></td>
                <td><a class="btn-edit" href="editar_predio_ulises.php?id=<?php echo $row['clave_castral']; ?>">EDITAR</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>