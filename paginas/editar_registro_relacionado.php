<?php
include("conexion_hosting_ulises.php");
$id = $_GET['id']; 

// 1. Recuperar el registro único mediante INNER JOIN
$stmt = $conn->prepare("SELECT p.*, pr.nombre, pr.apellido_paterno, pr.apellido_materno 
                        FROM Predios p 
                        INNER JOIN Propietarios pr ON p.id_propietario = pr.id_propietario 
                        WHERE p.clave_castral = ?");
$stmt->execute([$id]);
$reg = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Recuperar todos los propietarios para llenar el ComboBox (Llave foránea)
$stmt_propietarios = $conn->query("SELECT id_propietario, nombre, apellido_paterno FROM Propietarios");
$lista_propietarios = $stmt_propietarios->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: Arial; }
        .form-caja { width: 550px; margin: auto; background: #fff; padding: 25px; border: 2px solid #000080; border-radius: 8px; box-shadow: 5px 5px 15px rgba(0,0,0,0.1); }
        input, select { width: 95%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; }
        .btn-save { background: #000080; color: white; padding: 12px; width: 100%; border: none; font-weight: bold; cursor: pointer; }
        label { font-weight: bold; color: #333; }
    </style>
    
    <script>
    function validarFormulario() {
        let tipo = document.getElementById("tipo").value.trim();
        let ubicacion = document.getElementById("ubicacion").value.trim();
        let estatus = document.getElementById("estatus").value.trim();
        let propietario = document.getElementById("id_propietario").value;
        let regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/;

        if (propietario === "") {
            alert("Error: Debe seleccionar un propietario.");
            return false;
        }
        if (tipo === "" || !regexLetras.test(tipo)) {
            alert("Error: El tipo de propiedad es obligatorio (solo letras).");
            document.getElementById("tipo").focus();
            return false;
        }
        if (ubicacion.length < 5) {
            alert("Error: La ubicación debe tener al menos 5 caracteres.");
            document.getElementById("ubicacion").focus();
            return false;
        }
        if (estatus === "" || !regexLetras.test(estatus)) {
            alert("Error: El estatus es obligatorio (solo letras).");
            document.getElementById("estatus").focus();
            return false;
        }
        return true; 
    }
    </script>
</head>
<body>
    <div class="form-caja">
        <h2 style="color:#000080; text-align:center;">EDITAR REGISTRO RELACIONADO</h2>
        
        <form action="actualizar_relacionado.php" method="POST" onsubmit="return validarFormulario()">
            
            <input type="hidden" name="clave" value="<?php echo $reg['clave_castral']; ?>">
            
            <label>Clave Catastral (Llave Primaria - Deshabilitada):</label>
            <input type="text" value="<?php echo $reg['clave_castral']; ?>" disabled style="background:#eee;">

            <hr>
            <h3 style="color:#000080;">Relación (Llave Foránea)</h3>
            <label>Seleccionar Propietario:</label>
            <select name="id_propietario" id="id_propietario">
                <?php foreach($lista_propietarios as $prop): ?>
                    <option value="<?php echo $prop['id_propietario']; ?>" <?php echo ($prop['id_propietario'] == $reg['id_propietario']) ? 'selected' : ''; ?>>
                        <?php echo $prop['nombre'] . " " . $prop['apellido_paterno']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <hr>
            <h3 style="color:#000080;">Datos del Predio</h3>
            <label>Tipo de Propiedad:</label>
            <input type="text" name="tipo" id="tipo" value="<?php echo $reg['tipo_propiedad']; ?>">

            <label>Ubicación Domicilio:</label>
            <input type="text" name="ubicacion" id="ubicacion" value="<?php echo $reg['ubicacion_domicilio']; ?>">

            <label>Estatus:</label>
            <input type="text" name="estatus" id="estatus" value="<?php echo $reg['estatus']; ?>">

            <button type="submit" class="btn-save">EJECUTAR UPDATE DE SQL</button>
        </form>
    </div>
</body>
</html>