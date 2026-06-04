<?php
include("conexion_hosting_ulises.php");

// 1. Recuperar valores enviados por POST
$clave         = $_POST['clave'];
$id_propietario = $_POST['id_propietario'];
$tipo          = $_POST['tipo'];
$ubicacion     = $_POST['ubicacion'];
$estatus       = $_POST['estatus'];

try {
    // 2. Sentencia SQL tipo UPDATE exigida por la práctica
    $sql = "UPDATE Predios SET id_propietario = ?, tipo_propiedad = ?, ubicacion_domicilio = ?, estatus = ? WHERE clave_castral = ?";
    $stmt = $conn->prepare($sql);
    $exito = $stmt->execute([$id_propietario, $tipo, $ubicacion, $estatus, $clave]);

    // Consultamos el nombre del propietario seleccionado para mostrarlo completo en el resumen final
    $stmt_prop = $conn->prepare("SELECT nombre, apellido_paterno, apellido_materno FROM Propietarios WHERE id_propietario = ?");
    $stmt_prop->execute([$id_propietario]);
    $propietario_actualizado = $stmt_prop->fetch(PDO::FETCH_ASSOC);
    $nombre_completo = $propietario_actualizado['nombre'] . " " . $propietario_actualizado['apellido_paterno'] . " " . $propietario_actualizado['apellido_materno'];

} catch (Exception $e) {
    $exito = false;
    $error_msg = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aviso de Actualización - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: Arial; text-align: center; }
        .aviso { display: inline-block; margin-top: 50px; padding: 30px; background: #fff; border: 3px double #000080; text-align: left; min-width: 450px; }
        .label { font-weight: bold; color: #000080; display: inline-block; width: 140px; }
    </style>
</head>
<body>
    <div class="aviso">
        <?php if($exito): ?>
            <h2 style="color: #28a745; text-align: center;">¡REGISTRO ACTUALIZADO EN LA BASE DE DATOS!</h2>
            <p style="text-align: center;"><strong>Resumen de datos procesados mediante UPDATE:</strong></p>
            <hr>
            <p><span class="label">Clave Catastral:</span> <?php echo $clave; ?></p>
            <p><span class="label">ID Propietario (FK):</span> <?php echo $id_propietario; ?> (<?php echo $nombre_completo; ?>)</p>
            <p><span class="label">Tipo Propiedad:</span> <?php echo $tipo; ?></p>
            <p><span class="label">Ubicación:</span> <?php echo $ubicacion; ?></p>
            <p><span class="label">Estatus:</span> <?php echo $estatus; ?></p>
            <hr>
            <div style="text-align: center; margin-top: 20px;">
                <a href="reporte_para_editar_relacionado_ulises.php" style="color:#000080; font-weight:bold; text-decoration: none;">[ 🔙 REGRESAR AL REPORTE GENERAL ]</a>
            </div>
        <?php else: ?>
            <h2 style="color: red; text-align: center;">ERROR AL ACTUALIZAR</h2>
            <p>Detalle técnico: <?php echo $error_msg; ?></p>
            <a href="javascript:history.back()">Regresar al Formulario</a>
        <?php endif; ?>
    </div>
</body>
</html>