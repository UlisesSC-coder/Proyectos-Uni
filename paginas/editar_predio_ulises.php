<?php
include("conexion_hosting_ulises.php");
$id = $_GET['id']; 

$stmt = $conn->prepare("SELECT p.*, pr.nombre, pr.apellido_paterno, pr.apellido_materno 
                        FROM Predios p 
                        INNER JOIN Propietarios pr ON p.id_propietario = pr.id_propietario 
                        WHERE p.clave_castral = ?");
$stmt->execute([$id]);
$reg = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: Arial; }
        .form-caja { width: 550px; margin: auto; background: #fff; padding: 25px; border: 2px solid #000080; border-radius: 8px; box-shadow: 5px 5px 15px rgba(0,0,0,0.1); }
        input { width: 95%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; }
        .btn-save { background: #000080; color: white; padding: 12px; width: 100%; border: none; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: #000060; }
        label { font-weight: bold; color: #333; }
    </style>
    
    <script>
    function validarFormulario() {
        let nombre = document.getElementById("nombre").value.trim();
        let paterno = document.getElementById("paterno").value.trim();
        let materno = document.getElementById("materno").value.trim();
        let tipo = document.getElementById("tipo").value.trim();
        let ubicacion = document.getElementById("ubicacion").value.trim();
        let estatus = document.getElementById("estatus").value.trim();
        
        let regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/;

        if (nombre === "" || !regexLetras.test(nombre)) {
            alert("Error: El nombre es obligatorio.");
            document.getElementById("nombre").focus();
            return false;
        }
        if (paterno === "" || !regexLetras.test(paterno)) {
            alert("Error: El apellido paterno es obligatorio.");
            document.getElementById("paterno").focus();
            return false;
        }
        if (materno === "" || !regexLetras.test(materno)) {
            alert("Error: El apellido materno es obligatorio.");
            document.getElementById("materno").focus();
            return false;
        }
        if (tipo === "" || !regexLetras.test(tipo)) {
            alert("Error: El tipo de propiedad es obligatorio.");
            document.getElementById("tipo").focus();
            return false;
        }
        if (ubicacion.length < 5) {
            alert("Error: La ubicación debe tener al menos 5 caracteres.");
            document.getElementById("ubicacion").focus();
            return false;
        }
        if (estatus === "" || !regexLetras.test(estatus)) {
            alert("Error: El estatus es obligatorio.");
            document.getElementById("estatus").focus();
            return false;
        }
        return true; 
    }
    </script>
</head>
<body>
    <div class="form-caja">
        <h2 style="color:#000080; text-align:center;">MODIFICAR REGISTRO CATASTRAL</h2>
        <form action="actualizar_predio_ulises.php" method="POST" onsubmit="return validarFormulario()">
            
            <input type="hidden" name="id_propietario" value="<?php echo $reg['id_propietario']; ?>">
            
            <label>Clave Castral (No editable):</label>
            <input type="text" name="clave" value="<?php echo $reg['clave_castral']; ?>" readonly style="background:#eee;">

            <hr>
            <h3 style="color:#000080;">Datos del Propietario</h3>
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $reg['nombre']; ?>">

            <label>Apellido Paterno:</label>
            <input type="text" name="paterno" id="paterno" value="<?php echo $reg['apellido_paterno']; ?>">

            <label>Apellido Materno:</label>
            <input type="text" name="materno" id="materno" value="<?php echo $reg['apellido_materno']; ?>">

            <hr>
            <h3 style="color:#000080;">Datos del Predio</h3>
            <label>Tipo de Propiedad:</label>
            <input type="text" name="tipo" id="tipo" value="<?php echo $reg['tipo_propiedad']; ?>">

            <label>Ubicación Domicilio:</label>
            <input type="text" name="ubicacion" id="ubicacion" value="<?php echo $reg['ubicacion_domicilio']; ?>">

            <label>Estatus:</label>
            <input type="text" name="estatus" id="estatus" value="<?php echo $reg['estatus']; ?>">

            <button type="submit" class="btn-save">GUARDAR CAMBIOS COMPLETOS</button>
        </form>
    </div>
</body>
</html>