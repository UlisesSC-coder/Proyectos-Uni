<?php 
include("conexion_hosting_ulises.php"); 

// 1. Recuperar TODOS los valores enviados desde el formulario (incluyendo los nuevos)
$id = $_POST['id_propietario'];
$nombre = $_POST['nombre'];
$ape_paterno = $_POST['apellido_paterno'];
$ape_materno = $_POST['apellido_materno'];
$rfc = $_POST['rfc'];
$curp = $_POST['curp']; // Nuevo
$telefono = $_POST['telefono']; // Nuevo
$correo = $_POST['correo_electronico']; // Nuevo

// 2. Actualizar la instrucción SQL para incluir las nuevas columnas
$sql = "UPDATE Propietarios SET 
            nombre = ?, 
            apellido_paterno = ?, 
            apellido_materno = ?, 
            rfc = ?, 
            curp = ?, 
            telefono = ?, 
            correo_electronico = ? 
        WHERE id_propietario = ?";

$stmt = $conn->prepare($sql);

// 3. Ejecutar pasando todos los parámetros en el orden exacto del SQL
$exito = $stmt->execute([
    $nombre, 
    $ape_paterno, 
    $ape_materno, 
    $rfc, 
    $curp, 
    $telefono, 
    $correo, 
    $id
]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estatus de Actualización</title>
    <style>
        body { background-color: #fdfae7; font-family: 'Times New Roman', serif; text-align: center; padding-top: 50px; }
        .mensaje-caja { display: inline-block; padding: 30px; background-color: #e6e6e6; border: 2px solid #000080; box-shadow: 5px 5px 15px rgba(0,0,0,0.1); }
        .btn-regresar { display: inline-block; margin-top: 20px; padding: 10px 25px; background: #000080; color: white; text-decoration: none; font-weight: bold; border-radius: 4px; }
        .btn-regresar:hover { background: #0000b3; }
    </style>
</head>
<body>
    <div class="mensaje-caja">
        <?php if($exito): ?>
            <h2 style="color: #28a745;">¡REGISTRO ACTUALIZADO CORRECTAMENTE!</h2>
            <p>Se han guardado todos los cambios para el propietario con ID: <strong><?php echo $id; ?></strong>.</p>
        <?php else: ?>
            <h2 style="color: #dc3545;">ERROR AL ACTUALIZAR</h2>
            <p>Hubo un problema técnico al intentar guardar los cambios en la base de datos.</p>
        <?php endif; ?>
        
        <br>
        <a href="reporte_para_editar_catalogo_ulises.php" class="btn-regresar">REGRESAR AL REPORTE GENERAL</a>
    </div>
</body>
</html>