<?php
include("conexion_hosting_ulises.php");

$id = $_GET['id'];

if (!empty($id)) {
    // Consulta con INNER JOIN para cumplir con la regla de mostrar nombres y no IDs
    $sql = "SELECT p.clave_castral, p.tipo_propiedad, p.ubicacion_domicilio, p.estatus, 
                   CONCAT(pr.nombre, ' ', pr.apellido_paterno) as dueno
            FROM Predios p
            INNER JOIN Propietarios pr ON p.id_propietario = pr.id_propietario
            WHERE p.id_propietario = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultados) > 0) {
        echo "<h3 style='color:#000080;'>Tabla de datos de MySQL generada con PHP y AJAX</h3>";
        echo "<table>
                <thead>
                    <tr>
                        <th>ID / Clave</th>
                        <th>Tipo de Propiedad</th>
                        <th>Ubicación</th>
                        <th>Estatus</th>
                        <th>Propietario (Catalogo)</th>
                    </tr>
                </thead>
                <tbody>";
        
        foreach ($resultados as $fila) {
            echo "<tr>
                    <td>{$fila['clave_castral']}</td>
                    <td>{$fila['tipo_propiedad']}</td>
                    <td>{$fila['ubicacion_domicilio']}</td>
                    <td>{$fila['estatus']}</td>
                    <td>{$fila['dueno']}</td>
                  </tr>";
        }
        
        echo "</tbody></table>";
    } else {
        echo "<p style='color:red; text-align:center; padding:20px;'>No se encontraron predios vinculados a este propietario.</p>";
    }
}
?>