<?php 
include("conexion_hosting_ulises.php"); 

$id = $_GET['id'];

// 1. Obtenemos TODOS los datos antes de borrar para poder mostrarlos
$sql_select = "SELECT * FROM Propietarios WHERE id_propietario = :id";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->execute([':id' => $id]);
$datos = $stmt_select->fetch(PDO::FETCH_ASSOC);

// 2. Intentamos eliminar
try {
    $sql_delete = "DELETE FROM Propietarios WHERE id_propietario = :id";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->execute([':id' => $id]);
    $mensaje = "PROPIETARIO ELIMINADO DE FORMA CORRECTA";
} catch(PDOException $e) {
    $mensaje = "ERROR: NO SE PUDO ELIMINAR (Tiene dependencias en otras tablas)";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Propietario</title>
    <style>
        body { background-color: #fdfae7; font-family: 'Times New Roman', Times, serif; }
        .main-container { width: 80%; margin: 50px auto; border: 1px solid #ccc; background-color: #e6e6e6; padding: 20px; }
        .header-title { font-weight: bold; font-size: 1.2em; text-transform: uppercase; margin-bottom: 20px; color: #000080; }
        .data-field { margin-bottom: 10px; border-bottom: 1px solid #ccc; padding: 5px; }
        .btn-large { padding: 10px 25px; border: 2px solid #000080; background-color: #eee; cursor: pointer; text-decoration: none; color: #000; font-size: 1.1em; display: inline-block; margin: 10px; }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header-title"><?php echo $mensaje; ?></div>
        
        <?php if ($datos): ?>
            <div class="data-field"><strong>ID:</strong> <?php echo $datos['id_propietario']; ?></div>
            <div class="data-field"><strong>Nombre:</strong> <?php echo $datos['nombre'] . " " . $datos['apellido_paterno'] . " " . $datos['apellido_materno']; ?></div>
            <div class="data-field"><strong>RFC:</strong> <?php echo $datos['rfc']; ?></div>
            <div class="data-field"><strong>CURP:</strong> <?php echo $datos['curp']; ?></div>
            <div class="data-field"><strong>Domicilio:</strong> <?php echo $datos['domicilio']; ?></div>
            <div class="data-field"><strong>Teléfono:</strong> <?php echo $datos['telefono']; ?></div>
            <div class="data-field"><strong>Correo:</strong> <?php echo $datos['correo_electronico']; ?></div>
            <div class="data-field"><strong>F. Nacimiento:</strong> <?php echo $datos['fecha_nacimiento']; ?></div>
            <div class="data-field"><strong>F. Registro:</strong> <?php echo $datos['fecha_registro']; ?></div>
        <?php endif; ?>
        
        <div style="text-align:center;">
            <a href="registrar_departamento.php" class="btn-large">Registrar otro propietario</a>
            <a href="reporte_para_borrar_catalogo_ulises.php" class="btn-large">Reporte para borrar Propietarios</a>
        </div>
    </div>
</body>
</html>