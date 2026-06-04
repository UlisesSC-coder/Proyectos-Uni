<?php
require_once 'conexion_hosting_ulises.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Predios - Ulises</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding: 20px; display: flex; justify-content: center;}
        .contenedor { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        .grupo { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px;}
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #0d6efd; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; }
        button:hover { background: #0b5ed7; }
    </style>
</head>
<body>

<div class="contenedor">
    <h2 style="text-align: center;">Registro de Predio (Tabla Relacionada)</h2>
    
    <form name="formPredio" action="grabar_datos_relacionados.php" method="POST" onsubmit="return validar()">
        
        <div class="grupo">
            <label>Clave Catastral:</label>
            <input type="text" id="clave" name="clave" placeholder="Ej. 001-A">
        </div>

        <div class="grupo">
            <label>Propietario (Catálogo):</label>
            <select id="id_propietario" name="id_propietario">
                <option value="">-- Selecciona al Propietario --</option>
                <?php
                // Llenamos el combo con los dueños
                $sql_dueños = "SELECT id_propietario, nombre, apellido_paterno FROM Propietarios";
                $stmt = $conn->query($sql_dueños);
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$fila['id_propietario'].'">'.$fila['nombre'].' '.$fila['apellido_paterno'].'</option>';
                }
                ?>
            </select>
        </div>

        <div class="grupo">
            <label>Tipo de Propiedad:</label>
            <select id="tipo" name="tipo">
                <option value="">-- Selecciona --</option>
                <option value="lote">Lote</option>
                <option value="casa habitacion">Casa Habitación</option>
                <option value="departamento">Departamento</option>
                <option value="local comercial">Local Comercial</option>
            </select>
        </div>

        <div class="grupo">
            <label>Superficie Terreno (Ej. 120 m2):</label>
            <input type="text" id="sup_terreno" name="sup_terreno">
        </div>

        <div class="grupo">
            <label>Superficie Construcción (Metros cuadrados):</label>
            <input type="number" step="0.01" id="sup_const" name="sup_const">
        </div>

        <div class="grupo">
            <label>Colindancias:</label>
            <textarea id="colindancias" name="colindancias" rows="2"></textarea>
        </div>

        <div class="grupo">
            <label>Estatus:</label>
            <input type="text" id="estatus" name="estatus" placeholder="Ej. Activo, En venta...">
        </div>

        <div class="grupo">
            <label>Valor Catastral ($):</label>
            <input type="number" id="valor" name="valor">
        </div>

        <div class="grupo">
            <label>Ubicación / Domicilio del predio:</label>
            <input type="text" id="ubicacion" name="ubicacion">
        </div>

        <button type="submit">Guardar Predio</button>
    </form>
</div>

<script>
// Validación estricta solicitada en las instrucciones
function validar() {
    let campos = ["clave", "id_propietario", "tipo", "sup_terreno", "sup_const", "colindancias", "estatus", "valor", "ubicacion"];
    for (let i = 0; i < campos.length; i++) {
        if (document.getElementById(campos[i]).value.trim() === "") {
            alert("Error: El campo '" + campos[i] + "' no puede estar vacío.");
            return false;
        }
    }
    return true;
}
</script>
</body>
</html>