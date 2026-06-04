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
    <title>Sentencia IF</title>
</head>

<body style="background:#000000; color:#FFFFFF;">
<?php

    $contenedor = "DIAS";

    if($contenedor == "DIAS") // <---- Esto es TRUE o FALSE
    {
        //Se ejecuta si es verdadero ***************
        $saludo = "<h2>Buenos DIAS mortal !!!</h2>";
        echo ("<marquee>" . $saludo . "</marquee>");
    } else { // <--- Esto se ejecuta si es FALSO lo del //paréntesis()

        $saludo = "<h2>No te quiero saludar !!!!!!</h2>";
        echo ("<marquee>" . $saludo . "</marquee>");
    }

    // Enciende el XAMPP Server
    // Abre el navegador web (Firefox)
    // Visualiza la práctica en
    // http://localhost/prograweb2026a/paginas/if.php

?>
</body>
</html>
</body>
</html>