<?php
    //********************** PASO 1 *************************************
    require_once "conexion.php";

    //********************** PASO 2 *************************************
    // Cambiado a $_POST y validando el nombre 'departamento' que viene del select
    if(isset($_POST["departamento"]) && $_POST["departamento"] != "0") {
        $id_empleado = (int)$_POST["departamento"];
    } else {
        header("Location: combobox_layout.php");
        exit;
    }

    //********************** PASO 3 *************************************
    // Consulta SQL ajustada a la tabla empleados y la columna numero
    $sql = "SELECT * FROM empleados WHERE numero = " . $id_empleado;
    $result = $conn->query($sql);

    //********************** PASO 4 *************************************
    $rows = $result->fetchAll();

    // Verificamos si se encontró el registro
    if (!$rows) {
        echo "Empleado no encontrado.";
        exit;
    }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Detalle del Empleado</title>
</head>
<body>
    
    <div align="center">
        <h2>Detalle del Empleado Seleccionado</h2>
        
        <table border="1" width="80%">
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Categoría</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //********************** PASO 5 *************************************
                    foreach ($rows as $row) {
                ?>
                <tr>
                    <td><?php echo $row['numero']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['salario']; ?></td>
                    <td><?php echo $row['categoria']; ?></td>
                    <td><?php echo $row['sexo']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <br>
        <a href="combobox_layout.php"> <<< Regresar al reporte completo</a>

        <h2>Ulises Sánchez Camarena</h2>
    </div>

    <?php
        //********************** PASO 6 *************************************
        $conn = null;
    ?>
</body>
</html>