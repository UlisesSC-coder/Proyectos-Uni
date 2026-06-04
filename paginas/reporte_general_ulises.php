<?php
    require_once "conexion_hosting_ulises.php";
  
    header('Content-Type: text/html; charset=utf-8');

    $sql = "SELECT Predios.clave_castral, 
                   Propietarios.nombre, 
                   Propietarios.apellido_paterno, 
                   Predios.tipo_propiedad, 
                   Predios.ubicacion_domicilio 
            FROM Predios 
            INNER JOIN Propietarios ON Predios.id_propietario = Propietarios.id_propietario";

    $result = $conn->query($sql);
    $rows = $result->fetchAll();
 ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Catastro - Ulises Sánchez</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 90%; margin: 20px auto; }
        table { border-collapse: collapse; width: 100%; }
        th { background-color: #2c3e50; color: white; padding: 12px; }
        td { padding: 10px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:hover { background-color: #f1f1f1; }
        a { color: #2980b9; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    
    <div class="container" align="center">
        <h2>Gestión de Catastro Municipal</h2>
        <p>Haga clic en el <strong>Nombre del Propietario</strong> para ver los detalles técnicos del predio.</p>
        
        <table>
            <thead>
                <tr>
                    <th>Propietario</th>
                    <th>Tipo de Propiedad</th>
                    <th>Ubicación</th>
                </tr>
            </thead>
            <tbody>
                
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td>
                        <a href="detalle_registro.php?id=<?php echo $row['clave_castral']; ?>">
                            <?php echo $row['nombre'] . " " . $row['apellido_paterno']; ?>
                        </a>
                    </td>
                    <td><?php echo $row['tipo_propiedad']; ?></td>
                    <td><?php echo $row['ubicacion_domicilio']; ?></td>
                </tr>
            <?php } ?>
            
            </tbody>
        </table>

        <br>
        <hr>
        <h2 style="color: #34495e;">Ulises Sánchez Camarena</h2>    
    </div>

    <?php $conn = null; ?>
</body>
</html>