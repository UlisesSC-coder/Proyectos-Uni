<?php
include("conexion_hosting_ulises.php");

// 1. Recuperar los registros de la TABLA CATALOGO (Propietarios)
$stmt = $conn->query("SELECT id_propietario, nombre, apellido_paterno FROM Propietarios ORDER BY nombre ASC");
$propietarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Maestro-Detalle AJAX - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: Arial; margin: 20px; }
        .contenedor { width: 900px; margin: auto; background: #fff; padding: 25px; border: 2px solid #000080; border-radius: 8px; }
        .combo-seccion { background: #eee; padding: 20px; border-radius: 5px; text-align: center; margin-bottom: 20px; }
        select { padding: 10px; width: 300px; border: 1px solid #000080; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #000080; color: white; padding: 10px; }
        td { padding: 8px; border: 1px solid #ccc; text-align: center; }
        .footer { font-size: 0.8em; margin-top: 20px; color: #555; }
    </style>

    <script>
    function mostrarPredios(idPropietario) {
        if (idPropietario == "") {
            document.getElementById("tabla_resultados").innerHTML = "<p style='text-align:center;'><b>Selecciona un propietario para conocer sus predios</b></p>";
            return;
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tabla_resultados").innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET", "get_relacionada_ajax.php?id=" + idPropietario, true);
        xmlhttp.send();
    }
    </script>
</head>
<body>

<div class="contenedor">
    <h2 style="color:#000080; text-align:center;">PROGRAMACIÓN WEB - TAREA 15</h2>
    
    <div class="combo-seccion">
        <label><b>Seleccionar Propietario:</b></label><br><br>
        <select name="propietario" onchange="mostrarPredios(this.value)">
            <option value="">-- Selecciona un propietario --</option>
            <?php foreach($propietarios as $p): ?>
                <option value="<?php echo $p['id_propietario']; ?>">
                    <?php echo $p['nombre'] . " " . $p['apellido_paterno']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div id="tabla_resultados">
        <p style="text-align:center;"><b>En esta parte aparecerán los predios del propietario seleccionado</b></p>
    </div>

    <div class="footer">
        <hr>
        Centro Universitario de los Valles<br>
        Lic. en Tecnologías de la Información | Programación Web<br>
        DISEÑO WEB BACK END CON PHP Y MYSQL - <b>ULISES SÁNCHEZ</b>
    </div>
</div>

</body>
</html>