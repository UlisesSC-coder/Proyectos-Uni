<?php 
include("conexion_hosting_ulises.php"); 
$id = $_GET['id'];

// 1. Obtener datos antes de borrar
$sql_select = "SELECT * FROM Predios WHERE clave_castral = :id";
$stmt = $conn->prepare($sql_select);
$stmt->execute([':id' => $id]);
$datos = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Ejecutar borrado
$sql_delete = "DELETE FROM Predios WHERE clave_castral = :id";
$stmt_del = $conn->prepare($sql_delete);
$stmt_del->execute([':id' => $id]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Eliminación</title>
</head>
<body>
    <h2>Predio eliminado correctamente</h2>
    <h3>Información del registro eliminado:</h3>
    <p>Clave: <?php echo $datos['clave_castral']; ?></p>
    <p>Ubicación: <?php echo $datos['ubicacion_domicilio']; ?></p>
    <p>Tipo: <?php echo $datos['tipo_propiedad']; ?></p>
    
    <br>
    <a href="reporte_para_borrar_ulises.php">Regresar al Reporte General</a>
</body>
</html>