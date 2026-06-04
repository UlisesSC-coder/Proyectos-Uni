<?php
    //********************** PASO 1 *************************************
    require_once "conexion.php";

    //********************** PASO 2 *************************************
    // Consulta exacta de la imagen con INNER JOIN
    $sql = "SELECT * FROM departamentos";

    //********************** PASO 3 *************************************
    $result = $conn->query($sql);

    //********************** PASO 4 *************************************
    $rows = $result->fetchAll();
 ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de PHP conectado a MySQL</title>
</head>
<body>
    
    <div align="center">
	<h2>Reporte de la tabla de MySQL en tabla de HTML</h2>	
    <table border="1" width="90%">
        <thead>
            <tr>
                <th>Departamento</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            
        <?php
            //********************** PASO 5 *************************************
            foreach ($rows as $row) {
        ?>
            <tr>
                <td>
					
					<a href="detalle_departamento.php?id=<?php echo $row['departamento']; ?>">
    					<?php echo $row['departamento']; ?>
					</a>
				
				</td>
                <td><?php echo $row['descripcion']; ?></td>
            </tr>
        <?php } ?>
        
        </tbody>
    </table>
	 <h2>Ulises Sánchez Camarena</h2>	
    </div>
     <?php
        //********************** PASO 6 *************************************
        $conn = null;
     ?>
        
</body>
</html>