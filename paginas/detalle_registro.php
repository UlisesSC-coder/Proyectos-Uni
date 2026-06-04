<?php
    //********************** PASO 1: Conexión *************************************
    require_once "conexion.php";
    header('Content-Type: text/html; charset=utf-8');

    //********************** PASO 2: Recuperar el ID de la URL ********************
    // Usamos $_GET['id'] porque viene desde la liga de la página anterior
    $id_recibido = $_GET['id'];

    //********************** PASO 3: Consulta Individual **************************
    // Buscamos solo el registro que coincida con la clave castral recibida
    $sql = "SELECT * FROM Predios WHERE clave_castral = '$id_recibido'";

    //********************** PASO 4: Ejecución *************************************
    $result = $conn->query($sql);
    $rows = $result->fetchAll();
 ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detalle del Predio - Catastro</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        .ficha { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 800px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; background-color: #eee; padding: 10px; width: 30%; border: 1px solid #ccc; }
        td { padding: 10px; border: 1px solid #ccc; }
        .btn-regresar { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; font-weight: bold; }
    </style>
</head>
<body>
    
    <div class="ficha">
        <h2 align="center">Detalle Técnico del Predio Seleccionado</h2>
        
        <table>
            <?php
                //********************** PASO 5: Mostrar información ******************
                foreach ($rows as $row) {
            ?>
            <tr>
                <th>Clave Castral:</th>
                <td><?php echo $row['clave_castral']; ?></td>
            </tr>
            <tr>
                <th>Tipo de Propiedad:</th>
                <td><?php echo $row['tipo_propiedad']; ?></td>
            </tr>
            <tr>
                <th>Superficie Terreno:</th>
                <td><?php echo $row['superficie_terreno']; ?></td>
            </tr>
            <tr>
                <th>Superficie Construcción:</th>
                <td><?php echo $row['superficie_construccion']; ?> m²</td>
            </tr>
            <tr>
                <th>Colindancias:</th>
                <td><?php echo $row['colindancias']; ?></td>
            </tr>
            <tr>
                <th>Estatus:</th>
                <td><strong><?php echo $row['estatus']; ?></strong></td>
            </tr>
            <tr>
                <th>Valor Castral:</th>
                <td>$<?php echo number_format($row['valor_castral'], 2); ?></td>
            </tr>
            <tr>
                <th>Ubicación / Domicilio:</th>
                <td><?php echo $row['ubicacion_domicilio']; ?></td>
            </tr>
            <?php } ?>
        </table>

        <br align="center">
        <div align="center">
            <a href="reporte_general_ulises.php" class="btn-regresar"> <<< Regresar al reporte completo</a>
            <br><br>
            <hr>
            <h2>Ulises Sánchez Camarena</h2>
        </div>
    </div>

    <?php
        //********************** PASO 6: Cerrar conexión ******************************
        $conn = null;
    ?>
</body>
</html>