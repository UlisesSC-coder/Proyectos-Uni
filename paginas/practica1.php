<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica PHP</title>
</head>
<body>

<?php
// Establecer zona horaria (México)
date_default_timezone_set("America/Mexico_City");

// Variables
$a = 200;
$b = 120;

// Operaciones
$suma = $a + $b;
$resta = $a - $b;
$producto = $a * $b;
$division = $a / $b;

// Fecha y hora
$fecha = date("d/m/Y");
$hora = date("h:i A");
?>

<h3>Aquí van los contenidos a mostrar en tu página web</h3>

<p>Hola mundo desde PHP!</p>
<p>Mi nombre: <b>Ulises Sánchez C</b></p>
<p>Valor de variable</p>

<h3>La fecha de hoy es:</h3>
<p><?php echo $fecha; ?></p>

<h3>La hora actual es:</h3>
<p><?php echo $hora; ?></p>

<h3>SUMA</h3>
<p>La suma es: <?php echo $suma; ?></p>

<h3>RESTA</h3>
<p>La resta es: <?php echo $resta; ?></p>

<h3>PRODUCTO</h3>
<p>La multiplicación es: <?php echo $producto; ?></p>

<h3>DIVISIÓN</h3>
<p>La división es: <?php echo $division; ?></p>

<hr>
<p><b>Este PHP lo programó: Ulises Sánchez C</b></p>

</body>
</html>
