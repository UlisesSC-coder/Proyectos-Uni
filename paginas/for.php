<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ciclo FOR</title>
</head>

<body style="background:#ea288c; color:#000000;">
<?php

    //Ciclo FOR ****************************************
    for($var=1; $var<=6; $var++) // <--- lleva tres elementos
    // $var se inicializa, se establece límite final y se incrementa
    // En este ejemplo del for, se va a REPETIR 6 veces ************
    {
        echo ("El valor de x es: " . $var . "<br>");
        echo "<h" . $var . ">" . "Abraham " . $var . "</h" . $var . ">";
    }

    // Enciende el WAMP Server
    // Abre el navegador web (Firefox)
    // Visualiza la práctica en
    // http://localhost/prograweb2026a/paginas/for.php
?>
</body>
</html>
</body>
</html>