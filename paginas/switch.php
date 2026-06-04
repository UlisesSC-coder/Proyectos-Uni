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
    <meta charset="utf-8">
    <title>Sentencia Switch</title>
</head>
<body style="background:#4e1bc3; color:#FFFFFF;">
<?php
    $contenedor = "DIA";
    switch ($contenedor) {
        case "dia": // <<<<< --- Estos son 2 puntos
            echo "<h1>Buenos dias (en minuscula) !!!</h1>";
            break;
        case "DIA": // <<<<< --- Estos son 2 puntos
            echo "<h1>Buenos dias (en Mayuscula)!!!</h1>";
            break;
        case "tarde": // <<<<< --- Estos son 2 puntos
            echo "<h1>Buenas tardes !!!</h1>";
            break;
        case "noche": // <<<<< --- Estos son 2 puntos
            echo "<h1>Buenas noches !!!</h1>";
            break;
        default: // <<<<< --- Estos son 2 puntos
            echo "<h1>No te quiero saludar !!!</h1>";
            break;
    }
    // Abre el navegador web (Firefox)
    // Visualiza la práctica en
    // http://localhost/prograweb2026a/paginas/switch.php
?>
</body>
</html>
</body>
</html>