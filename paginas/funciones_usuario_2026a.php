<?php
$numero = $_POST["BoxNumbers"];

function CrearTabla($numero) {

    echo "<table border='1' width='700' align='center'>";

    for ($i = 1; $i <= $numero; $i++) {

        echo "<tr>";

        echo "<td>$numero</td>";
        echo "<td>$numero</td>";
        echo "<td>$numero</td>";

        echo "</tr>";
    }

    echo "</table>";
}

CrearTabla($numero);

echo "<br><br>";

$tunombre = $_POST["txt_tunombre"];

echo "Este reto de PHP lo programó " . $tunombre;

?>