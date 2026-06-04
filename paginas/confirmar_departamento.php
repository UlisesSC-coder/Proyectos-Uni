<?php
// Recibimos los parámetros por la URL de manera segura
$departamento = isset($_GET['dep']) ? htmlspecialchars($_GET['dep']) : 'N/A';
$descripcion  = isset($_GET['desc']) ? htmlspecialchars($_GET['desc']) : 'N/A';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro - Catastro</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 40px; display: flex; flex-direction: column; align-items: center; }
        .contenedor-exito { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px; border-top: 5px solid #5cb85c; text-align: center; }
        h2 { color: #5cb85c; margin-top: 0; }
        .icono-exito { font-size: 50px; color: #5cb85c; margin-bottom: 15px; }
        .tabla-datos { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .tabla-datos th, .tabla-datos td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        .tabla-datos th { background-color: #f2f2f2; color: #333; width: 40%; }
        .btn-menu { background-color: #000080; color: white; padding: 12px 20px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; margin-top: 15px; }
        .btn-menu:hover { background-color: #000066; }
        .btn-otro { background-color: #5bc0de; color: white; padding: 12px 20px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; margin-top: 15px; margin-left: 10px; }
        .btn-otro:hover { background-color: #31b0d5; }
    </style>
</head>
<body>

    <div class="contenedor-exito">
        <div class="icono-exito">✔</div>
        <h2>¡Registro Guardado Exitosamente!</h2>
        <p>El departamento se ha almacenado en el sistema con los siguientes detalles:</p>

        <table class="tabla-datos">
            <tr>
                <th>Código / ID:</th>
                <td><strong><?php echo $departamento; ?></strong></td>
            </tr>
            <tr>
                <th>Descripción:</th>
                <td><?php echo $descripcion; ?></td>
            </tr>
        </table>

        <a href="index.php" class="btn-menu">🏠 Volver al Inicio</a>
        <a href="agregar_departamento.php" class="btn-otro">➕ Agregar Otro</a>
    </div>

</body>
</html>