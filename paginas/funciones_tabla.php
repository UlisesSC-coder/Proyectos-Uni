<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla dinámica con PHP</title>
</head>
<body>

<h3>Ulises Sánchez Camarena</h3>

<?php
// Fecha y hora
date_default_timezone_set("America/Mexico_City");
echo "Fecha de hoy: " . date("d-m-Y") . "<br>";
echo "Hora actual: " . date("H:i:s") . "<br><br>";

// Función solicitada
function MiTabla($Renglones)
{
    echo "<table border='1' width='60%'>";

    for ($i = 1; $i <= $Renglones; $i++) {
        echo "<tr>";
        echo "<td align='center'>Número $i</td>";
        echo "<td align='center'>";
        echo "<img src='../imagenes/$i.jpg' width='80'>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Llamada a la función
MiTabla(5);
?>

</body>
</html>
