<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Propietarios</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; }
    </style>
    <script>
        // Validación con JAVASCRIPT
        function validarFormulario() {
            // Arreglo con los IDs de todos los campos que debemos validar
            const campos = [
                'nombre', 'apellido_paterno', 'apellido_materno', 'rfc', 
                'fecha_registro', 'curp', 'domicilio', 'telefono', 
                'correo_electronico', 'fecha_nacimiento'
            ];

            // Recorremos cada campo para verificar si está vacío
            for(let i = 0; i < campos.length; i++) {
                let valor = document.getElementById(campos[i]).value;
                if(valor.trim() === "") {
                    alert("El campo " + campos[i].replace('_', ' ').toUpperCase() + " no puede estar vacío.");
                    document.getElementById(campos[i]).focus();
                    return false; // Detiene el envío del formulario
                }
            }
            return true; // Si todo está lleno, permite el envío
        }
    </script>
</head>
<body>

    <h2>Captura de Datos - Catálogo de Propietarios</h2>
    
    <form action="grabar_datos.php" method="POST" onsubmit="return validarFormulario()">
        
        <div class="form-group">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre">
        </div>

        <div class="form-group">
            <label for="apellido_paterno">Apellido Paterno:</label><br>
            <input type="text" id="apellido_paterno" name="apellido_paterno">
        </div>

        <div class="form-group">
            <label for="apellido_materno">Apellido Materno:</label><br>
            <input type="text" id="apellido_materno" name="apellido_materno">
        </div>

        <div class="form-group">
            <label for="rfc">RFC:</label><br>
            <input type="text" id="rfc" name="rfc" maxlength="13">
        </div>

        <div class="form-group">
            <label for="fecha_registro">Fecha de Registro:</label><br>
            <input type="date" id="fecha_registro" name="fecha_registro">
        </div>

        <div class="form-group">
            <label for="curp">CURP:</label><br>
            <input type="text" id="curp" name="curp" maxlength="18">
        </div>

        <div class="form-group">
            <label for="domicilio">Domicilio:</label><br>
            <input type="text" id="domicilio" name="domicilio">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" maxlength="11">
        </div>

        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico:</label><br>
            <input type="email" id="correo_electronico" name="correo_electronico">
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">
        </div>

        <div class="form-group">
            <input type="submit" value="Guardar Propietario">
        </div>

    </form>

</body>
</html>