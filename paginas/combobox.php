<?php
    require_once "conexion.php";

    $sql = "SELECT departamento, descripcion FROM departamentos";
    $result = $conn->query($sql);
    $rows = $result->fetchAll();
    $cuantos = (int)$rows;

    if ($cuantos > 0) { // Usamos las etiquetas de HTML para crear FORMULARIO y |
                        // CAJA DE SELECCION

    echo "<form action='' method='post' id='formulario1'>";

        echo "<label for='departamento'>Selecciona un departamento: </label> <br> <br>";
        echo "<select name='departamento' id='departamento'>";
        echo "<option value='0'>Selecciona un departamento...</option>";

    foreach ($rows as $row) {
        echo '<option value="' . $row['departamento'] . '">' . $row['descripcion'] 
        . '</option>';
    }
    } else {
        echo "<select name='departamento' id='departamento' disabled>";
        echo "<option value='0'>Selecciona un departamento...</option>";
    }

    echo "</select>";
    echo "</form>";
    //Cerramos la conexion a la base de datos ****************************************
    $conn = null;
?>

