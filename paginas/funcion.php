<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Funciones con parámetros en PHP</title>
    <?php
        //Funcion definida por el programador con 1 parámetro de entrada
        //Entre los paréntesis de la función va una(s) variable(s)
        function saludo($nombre)
        {
            //El parámetro de entrada se usa dentro del cuerpo de la
            //función
            echo "BUENOS DIAS " . $nombre;
            echo "<br>";
        }
    ?>
</head>
<body>
    <h1>Esto se ve en pantalla</h1>
    <br />
    <?php
        //Se manda llamar la función con su nombre de función
        //Pero además por ser una función con parámetro de entrada
        //se le agrega el valor que queremos enviar a la función

        saludo("BATMAN");
        saludo("Superman");
        saludo("Programador de PHP");
        //http://localhost/prograweb2026a/paginas/funcion.php
    ?>
</body>
</html>