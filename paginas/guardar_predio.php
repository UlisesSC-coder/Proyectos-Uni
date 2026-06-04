<?php 
include("conexion_hosting_ulises.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO Predios (id_propietario, tipo_propiedad, superficie_terreno, ubicacion_domicilio) 
            VALUES (:id, :tipo, :sup, :ubi)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id'   => $_POST['id_propietario'],
        ':tipo' => $_POST['tipo_propiedad'],
        ':sup'  => $_POST['superficie_terreno'],
        ':ubi'  => $_POST['ubicacion_domicilio']
    ]);
    
    echo "<h2>PREDIO REGISTRADO SATISFACTORIAMENTE</h2>";
    echo "<a href='registrar_predio.php'>Registrar otro predio</a> | ";
    echo "<a href='reporte_para_borrar_ulises.php'>Reporte general</a>";
}
?>