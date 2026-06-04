<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tablas generadas con el ciclo FOR</title>
</head>

<body style="background: #d8d2d5; color: #000000;">

    <div align="center">
        <h3>Ulises Sánchez Camarena</h3>

        <table style="border: 2px solid black; width: 70%;">
            <?php
            // Ciclo FOR
            // $var se inicializa, se establece limite final y se incrementa
            // En este ejemplo del for, se va a REPETIR 10 veces
            for ($var=1; $var<=10; $var++)
            {
                echo "<tr>";
                echo "<td style='border: 2px solid blue;'>". $var ."</td>";
                // Asegúrate de que las imágenes existan en la carpeta ../imagenes/
                echo "<td style='border: 2px solid blue;'><img src='../imagenes/$var.jpg'></td>";
                echo "</tr>";
            } // <--- IMPORTANTE: La llave de cierre debe estar DENTRO de las etiquetas PHP

            // Comentarios originales:
            // Enciende el XAMPP Server
            // Abre el navegador web y visualiza la práctica en localhost
            ?>
        </table>
    </div>

</body>
</html>