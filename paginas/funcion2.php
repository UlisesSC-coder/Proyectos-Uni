<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Funciones con 2 parámetros en PHP</title>
    <?php
        //Funcion definida por el programador con 2 parámetros
        //En este caso se esperan 2 números
        function operacion($numero1, $numero2)
        {
            if($numero1 == ""){
                $numero1 = 0;
            }
            if($numero2 == ""){
                $numero2 = 0;
            }
            //Dentro del cuerpo de la función se usan los 2 parámetros
            $suma = ($numero1 + $numero2);
            echo "La suma de $numero1 + $numero2 es = " . $suma;
            echo "<br>";

            //Dentro del cuerpo de la función se usan los 2 parámetros
            $producto = ($numero1 * $numero2);
            echo "El producto de $numero1 x $numero2 es = " . $producto;
            echo "<br>";
        }
    ?>
</head>
<body>
    <h1>Esto se ve en pantalla</h1><br>
    <?php
        //Se manda llamar la función con su nombre de función
        //Pero al ser función de 2 parámetros, se le tiene que enviar los
        //2 valores de lo contrario dará error o un resultado "raro" :'-(
        operacion(6, 6);
        //http://localhost/prograweb2026a/paginas/funcion2.php
    ?>
</body>
</html>