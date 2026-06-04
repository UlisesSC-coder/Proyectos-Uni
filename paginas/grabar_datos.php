<?php
// 1. Mandar llamar la conexión a la base de datos exacta de Ulises
require_once("conexion_hosting_ulises.php"); 

// 2. Recuperar valores de las cajas de texto mediante $_POST
$nombre = $_POST["nombre"];
$apellido_paterno = $_POST["apellido_paterno"];
$apellido_materno = $_POST["apellido_materno"];
$rfc = $_POST["rfc"];
$fecha_registro = $_POST["fecha_registro"];
$curp = $_POST["curp"];
$domicilio = $_POST["domicilio"];
$telefono = $_POST["telefono"];
$correo_electronico = $_POST["correo_electronico"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];

// 3. Escribir la sentencia INSERT INTO para la tabla Propietarios
$variable_INSERT = "INSERT INTO Propietarios (nombre, apellido_paterno, apellido_materno, rfc, fecha_registro, curp, domicilio, telefono, correo_electronico, fecha_nacimiento) 
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$rfc', '$fecha_registro', '$curp', '$domicilio', '$telefono', '$correo_electronico', '$fecha_nacimiento')";

try {
    // 4. Ejecutar la sentencia INSERT
    $conn->exec($variable_INSERT);
    
    echo "<h2>¡Registro de Propietario guardado exitosamente!</h2>";
    
    // 5. Mostrar en pantalla los valores recién insertados
    echo "<h3>Datos capturados:</h3>";
    echo "<ul>";
    echo "<li><strong>Nombre completo:</strong> $nombre $apellido_paterno $apellido_materno</li>";
    echo "<li><strong>RFC:</strong> $rfc</li>";
    echo "<li><strong>CURP:</strong> $curp</li>";
    echo "<li><strong>Fecha de Registro:</strong> $fecha_registro</li>";
    echo "<li><strong>Domicilio:</strong> $domicilio</li>";
    echo "<li><strong>Teléfono:</strong> $telefono</li>";
    echo "<li><strong>Correo:</strong> $correo_electronico</li>";
    echo "<li><strong>Fecha de Nacimiento:</strong> $fecha_nacimiento</li>";
    echo "</ul>";

} catch(PDOException $e) {
    echo "<h2>Error al insertar los datos:</h2> " . $e->getMessage();
}

echo "<hr>";

// PASO 4: Colocar LA LIGA o ENLACE al reporte general
echo '<a href="reporte_propietarios.php" style="display:inline-block; padding:10px 15px; background-color:#007bff; color:white; text-decoration:none; font-weight:bold; border-radius:5px;">';
echo 'Reporte general de mi tabla CATALOGO';
echo '</a>';
?>