<?php
// Mandamos llamar tu conexión
require_once("conexion_hosting_ulises.php");

try {
    // Esta es la orden para hacer que la columna sea Auto Incrementable
    $sql = "ALTER TABLE Propietarios MODIFY id_propietario INT(10) AUTO_INCREMENT";
    
    // Ejecutamos la orden
    $conn->exec($sql);
    
    echo "<h2 style='color: green; text-align: center; font-family: sans-serif; margin-top: 50px;'>
          ¡LISTO! ✅<br>Tu tabla Propietarios ha sido reparada con éxito.
          <br><br>Ya puedes ir a probar tu formulario.
          </h2>";

} catch(PDOException $e) {
    echo "<h2 style='color: red; text-align: center; font-family: sans-serif; margin-top: 50px;'>
          Fallo al intentar arreglar la tabla: <br>" . $e->getMessage() . "
          </h2>";
}
?>