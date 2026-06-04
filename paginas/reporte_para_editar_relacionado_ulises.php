<?php
include("conexion_hosting_ulises.php");

// Consulta multitabla con INNER JOIN
$sql = "SELECT p.*, pr.nombre, pr.apellido_paterno, pr.apellido_materno 
        FROM Predios p 
        INNER JOIN Propietarios pr ON p.id_propietario = pr.id_propietario";
$stmt = $conn->query($sql);
$registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte para Editar - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: Arial; text-align: center; }
        .tabla-reporte { width: 85%; margin: auto; border-collapse: collapse; background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        th { background: #000080; color: white; padding: 12px; }
        td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn-editar { color: #000080; font-weight: bold; text-decoration: none; }
        .btn-editar:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h2 style="color: #000080; margin-top: 30px;">SISTEMA DE CATASTRO - REGISTROS RELACIONADOS</h2>
    <p>Selecciona el registro que deseas modificar:</p>
    
    <table class="tabla-reporte">
        <thead>
            <tr>
                <th>Clave Catastral</th>
                <th>Propietario</th>
                <th>Tipo Propiedad</th>
                <th>Ubicación</th>
                <th>Estatus</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($registros as $row): ?>
            <tr>
                <td><strong><?php echo $row['clave_castral']; ?></strong></td>
                <td><?php echo $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno']; ?></td>
                <td><?php echo $row['tipo_propiedad']; ?></td>
                <td><?php echo $row['ubicacion_domicilio']; ?></td>
                <td><?php echo $row['estatus']; ?></td>
                <td>
                    <a class="btn-editar" href="editar_registro_relacionado.php?id=<?php echo $row['clave_castral']; ?>">✏️ EDITAR</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>