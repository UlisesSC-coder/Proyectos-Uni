<?php
include("conexion_hosting_ulises.php");

// 1. Recuperar valores del formulario
$id_pr     = $_POST['id_propietario'];
$nombre    = $_POST['nombre'];
$paterno   = $_POST['paterno'];
$materno   = $_POST['materno'];
$clave     = $_POST['clave'];
$tipo      = $_POST['tipo'];
$ubicacion = $_POST['ubicacion'];
$estatus   = $_POST['estatus']; // Recuperamos el estatus corregido

try {
    // Iniciamos transacción para asegurar la integridad de ambas tablas
    $conn->beginTransaction();

    // UPDATE 1: Tabla Propietarios
    $sql1 = "UPDATE Propietarios SET nombre = ?, apellido_paterno = ?, apellido_materno = ? WHERE id_propietario = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute([$nombre, $paterno, $materno, $id_pr]);

    // UPDATE 2: Tabla Predios (Incluyendo la columna estatus)
    $sql2 = "UPDATE Predios SET tipo_propiedad = ?, ubicacion_domicilio = ?, estatus = ? WHERE clave_castral = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$tipo, $ubicacion, $estatus, $clave]);

    $conn->commit();
    $exito = true;
} catch (Exception $e) {
    $conn->rollBack();
    $exito = false;
    $error_msg = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estatus Actualización - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: Arial; text-align: center; }
        .aviso { display: inline-block; margin-top: 50px; padding: 30px; background: #fff; border: 3px double #000080; text-align: left; min-width: 450px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .label { font-weight: bold; color: #000080; display: inline-block; width: 140px; }
        .seccion-header { background: #000080; color: white; padding: 5px 10px; margin: 15px 0 10px 0; font-size: 0.9em; font-weight: bold; }
        hr { border: 0; border-top: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="aviso">
        <?php if($exito): ?>
            <h2 style="color: #28a745; text-align: center; margin-top: 0;">¡ACTUALIZACIÓN EXITOSA!</h2>
            <p style="text-align: center;">Los siguientes cambios han sido aplicados en el sistema:</p>
            
            <div class="seccion-header">DATOS DEL PROPIETARIO</div>
            <p><span class="label">Nombre:</span> <?php echo $nombre; ?></p>
            <p><span class="label">Ap. Paterno:</span> <?php echo $paterno; ?></p>
            <p><span class="label">Ap. Materno:</span> <?php echo $materno; ?></p>

            <div class="seccion-header">DATOS DEL PREDIO</div>
            <p><span class="label">Clave Castral:</span> <?php echo $clave; ?></p>
            <p><span class="label">Tipo:</span> <?php echo $tipo; ?></p>
            <p><span class="label">Estatus:</span> <span style="color: blue; font-weight: bold;"><?php echo $estatus; ?></span></p>
            <p><span class="label">Ubicación:</span> <?php echo $ubicacion; ?></p>
            
            <hr>
            <div style="text-align: center; margin-top: 20px;">
                <a href="reporte_predios_ulises.php" style="color:#000080; font-weight:bold; text-decoration: none;">[ VOLVER AL LISTADO ]</a>
            </div>
        <?php else: ?>
            <h2 style="color: red; text-align: center;">ERROR EN EL PROCESO</h2>
            <p>No se pudieron guardar los cambios. Verifique la estructura de su base de datos.</p>
            <p style="background: #fee; padding: 10px; border: 1px solid red; font-family: monospace; font-size: 0.85em;">
                <?php echo $error_msg; ?>
            </p>
            <div style="text-align: center;">
                <a href="javascript:history.back()" style="color:#000080;">Regresar y verificar datos</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>