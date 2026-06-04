<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pagina web dinamica de la sesion 4</title>
<style>
    .contenedor {
        width: 100%;
        text-align: center;
    }

    table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</head>

<body>
<div class="contenedor">

<h2>Ulises Sanchez Camarena</h2>

<table>
    <tr>
        <th>Número</th>
        <th>Cuadrado</th>
        <th>Tipo</th>
    </tr>

<?php

$numero = 1;

while ($numero <= 100) {

    $cuadrado = $numero * $numero;

    if ($numero % 2 == 0) {
        $tipo = "PAR";
    } else {
        $tipo = "NON";
    }

    echo "<tr>";
    echo "<td>$numero</td>";
    echo "<td>$cuadrado</td>";
    echo "<td>$tipo</td>";
    echo "</tr>";

    $numero++;
}

?>

</table>

</div>
</body>
</html>
