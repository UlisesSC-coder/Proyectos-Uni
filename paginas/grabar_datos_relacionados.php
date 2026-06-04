<?php
// Mandar llamar la conexión correcta
require_once 'conexion_hosting_ulises.php'; 

// Recuperar los valores mediante POST
$clave = $_POST['clave'];
$id_prop = $_POST['id_propietario'];
$tipo = $_POST['tipo'];
$sup_t = $_POST['sup_terreno'];
$sup_c = $_POST['sup_const'];
$colin = $_POST['colindancias'];
$estatus = $_POST['estatus'];
$valor = $_POST['valor'];
$ubi = $_POST['ubicacion'];

// Sentencia INSERT INTO usando PDO
$sql_insert = "INSERT INTO Predios (clave_castral, id_propietario, tipo_propiedad, superficie_terreno, superficie_construccion, colindancias, estatus, valor_castral, ubicacion_domicilio) 
               VALUES (:clave, :id_prop, :tipo, :sup_t, :sup_c, :colin, :estatus, :valor, :ubi)";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardar Datos Relacionados</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; text-align: center; padding: 50px; }
        .caja { background: white; padding: 40px; border-radius: 10px; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .enlace-reporte { display: inline-block; margin-top: 20px; padding: 15px; background: #198754; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .enlace-reporte:hover { background: #157347; }
    </style>
</head>
<body>
    <div class="caja">
        <?php
        try {
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindParam(':clave', $clave);
            $stmt->bindParam(':id_prop', $id_prop);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':sup_t', $sup_t);
            $stmt->bindParam(':sup_c', $sup_c);
            $stmt->bindParam(':colin', $colin);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':ubi', $ubi);
            
            // Ejecutar la sentencia
            $stmt->execute();
            
            echo "<h2 style='color: green;'>¡Predio Registrado Exitosamente!</h2>";
            
            // Mostrar en pantalla los valores insertados
            echo "<h3>Valores insertados:</h3>";
            echo "<p><strong>Clave:</strong> $clave | <strong>Propietario ID:</strong> $id_prop | <strong>Tipo:</strong> $tipo</p>";
            echo "<p><strong>Sup. Terreno:</strong> $sup_t | <strong>Sup. Construcción:</strong> $sup_c</p>";
            echo "<p><strong>Valor:</strong> $$valor | <strong>Estatus:</strong> $estatus</p>";

        } catch(PDOException $e) {
            echo "<h2 style='color: red;'>Error al guardar</h2>";
            echo "<p>" . $e->getMessage() . "</p>";
        }
        $conn = null;
        ?>
        
        <a href="reporte_predios.php" class="enlace-reporte">Reporte de registros capturados en mi tabla tipo RELACIONADA</a>
    </div>
</body>
</html>