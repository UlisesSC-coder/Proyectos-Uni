<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Funciones con 2 parámetros en PHP</title>
    <?php

        function SaludoPersonalizado($param1, $param2)
        {
            if ($param1 >= 1 && $param1 <= 11){
                echo "-- Buenos días " . $param2 . "<br><br>";
            } else {
                echo "-- Tus valores están fuera del parámetro";
                echo "<br><br>";
            }
        }
    ?>
</head>
<body>
    <h1>Esto se ve en pantalla</h1>
    Estos son los resultados de llamar 3 veces la función: <br><br>
    <?php
        SaludoPersonalizado(9, "Batman");
        SaludoPersonalizado(20, "Goku");
        SaludoPersonalizado(5, "Programador de PHP");
    ?>
    <h2>Texto después de la función de PHP</h2>
</body>
</html>