<?php 
include("conexion_hosting_ulises.php"); 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM Propietarios WHERE id_propietario = ?");
    $stmt->execute([$id]);
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro - Ulises Sánchez</title>
    <style>
        body { background-color: #fdfae7; font-family: Arial, sans-serif; }
        .form-container { width: 60%; margin: 40px auto; background-color: #e6e6e6; padding: 25px; border: 1px solid #000; }
        h2 { color: #000080; text-align: center; text-transform: uppercase; border-bottom: 2px solid #000080; padding-bottom: 10px; }
        label { display: block; font-weight: bold; color: #000080; margin-top: 12px; }
        input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; box-sizing: border-box; }
        
        /* Estilo para el campo que no se puede editar (como en tu imagen) */
        .readonly-field { background-color: #eee; cursor: not-allowed; color: #555; border: 1px solid #bbb; }
        
        .button-group { display: flex; gap: 15px; margin-top: 25px; }
        .btn-update { flex: 2; padding: 15px; background-color: #000080; color: white; border: none; font-weight: bold; cursor: pointer; font-size: 16px; }
        .btn-update:hover { background-color: #0000b3; }
        .btn-cancel { flex: 1; padding: 15px; background-color: #888; color: white; border: none; font-weight: bold; cursor: pointer; font-size: 16px; text-decoration: none; text-align: center; line-height: 1.2; }
        .btn-cancel:hover { background-color: #666; }
        .required-mark { color: red; }
    </style>
    
    <script>
        function validarFormulario() {
            let nom = document.getElementById('nombre').value.trim();
            let pat = document.getElementById('apellido_paterno').value.trim();
            let mat = document.getElementById('apellido_materno').value.trim();
            let rfc = document.getElementById('rfc').value.trim();
            let curp = document.getElementById('curp').value.trim();
            let tel = document.getElementById('telefono').value.trim();
            let email = document.getElementById('correo_electronico').value.trim();

            let regexLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
            let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (nom === "" || !regexLetras.test(nom)) { alert("El NOMBRE es obligatorio y solo debe contener letras."); return false; }
            if (pat === "" || !regexLetras.test(pat)) { alert("El APELLIDO PATERNO es obligatorio y solo debe contener letras."); return false; }
            if (mat === "" || !regexLetras.test(mat)) { alert("El APELLIDO MATERNO es obligatorio y solo debe contener letras."); return false; }
            if (rfc.length < 12 || rfc.length > 13) { alert("El RFC debe tener entre 12 y 13 caracteres."); return false; }
            if (curp.length !== 18) { alert("La CURP debe ser de 18 caracteres."); return false; }
            if (tel.length !== 10 || isNaN(tel)) { alert("El TELÉFONO debe tener 10 dígitos numéricos."); return false; }
            if (email === "" || !regexCorreo.test(email)) { alert("Ingrese un formato de correo válido."); return false; }
            return true;
        }

        function soloNumeros(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
            return true;
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Editar Datos del Propietario</h2>
        <form action="actualizar_catalogo.php" method="POST" onsubmit="return validarFormulario()">
            
            <label>ID del Propietario:</label>
            <input type="text" value="<?php echo $registro['id_propietario']; ?>" class="readonly-field" readonly>
            
            <input type="hidden" name="id_propietario" value="<?php echo $registro['id_propietario']; ?>">

            <label>Nombre(s) <span class="required-mark">*</span>:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $registro['nombre']; ?>">

            <label>Apellido Paterno <span class="required-mark">*</span>:</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo $registro['apellido_paterno']; ?>">

            <label>Apellido Materno <span class="required-mark">*</span>:</label>
            <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo $registro['apellido_materno']; ?>">

            <label>RFC <span class="required-mark">*</span>:</label>
            <input type="text" id="rfc" name="rfc" value="<?php echo $registro['rfc']; ?>" maxlength="13" style="text-transform: uppercase;">

            <label>CURP <span class="required-mark">*</span>:</label>
            <input type="text" id="curp" name="curp" value="<?php echo $registro['curp']; ?>" maxlength="18" style="text-transform: uppercase;">

            <label>Teléfono <span class="required-mark">*</span>:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $registro['telefono']; ?>" maxlength="10" onkeypress="return soloNumeros(event)">

            <label>Correo Electrónico <span class="required-mark">*</span>:</label>
            <input type="text" id="correo_electronico" name="correo_electronico" value="<?php echo $registro['correo_electronico']; ?>">

            <div class="button-group">
                <button type="submit" class="btn-update">GUARDAR CAMBIOS</button>
                <a href="reporte_para_editar_catalogo_ulises.php" class="btn-cancel">CANCELAR</a>
            </div>
        </form>
    </div>
</body>
</html>