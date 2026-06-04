<?php
// Mandar llamar la conexión correcta
require_once 'conexion_hosting_ulises.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Predios</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #0d6efd; color: white; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Reporte de Predios Capturados (INNER JOIN)</h2>
    
    <table>
        <thead>
            <tr>
                <th>Clave Catastral</th>
                <th>Nombre del Propietario (INNER JOIN)</th>
                <th>Tipo</th>
                <th>Terreno</th>
                <th>Valor</th>
                <th>Ubicación</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                // Sentencia SELECT con INNER JOIN
                $sql = "SELECT p.clave_castral, p.tipo_propiedad, p.superficie_terreno, p.valor_castral, p.ubicacion_domicilio, 
                               pr.nombre, pr.apellido_paterno 
                        FROM Predios p 
                        INNER JOIN Propietarios pr ON p.id_propietario = pr.id_propietario";
                
                $stmt = $conn->query($sql);
                
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $fila['clave_castral'] . "</td>";
                    echo "<td>" . $fila['nombre'] . " " . $fila['apellido_paterno'] . "</td>";
                    echo "<td>" . $fila['tipo_propiedad'] . "</td>";
                    echo "<td>" . $fila['superficie_terreno'] . "</td>";
                    echo "<td>$" . number_format($fila['valor_castral'], 2) . "</td>";
                    echo "<td>" . $fila['ubicacion_domicilio'] . "</td>";
                    echo "</tr>";
                }
            } catch(PDOException $e) {
                echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <div style="text-align: center;">
        <a href="alta_tabla2_ulises.php">Volver al Formulario</a>
    </div>
</body>
</html>