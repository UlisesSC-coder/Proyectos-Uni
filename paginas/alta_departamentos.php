<?php include("conexion_empleados.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Departamentos | CUVALLES</title>
    <style>
        body { font-family: 'Segoe UI', Arial; background: #eef2f3; display: flex; justify-content: center; padding-top: 50px; }
        .contenedor { 
            background: white; padding: 30px; border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 400px; 
            border-top: 5px solid #2980b9;
        }
        h2 { color: #2c3e50; text-align: center; margin-bottom: 5px; }
        .alumno { text-align: center; color: #7f8c8d; font-size: 0.9em; margin-bottom: 25px; }
        label { display: block; font-weight: bold; color: #34495e; margin-bottom: 5px; }
        input[type="text"] { 
            width: 100%; padding: 12px; margin-bottom: 20px; 
            border: 1px solid #dcdde1; border-radius: 8px; box-sizing: border-box;
            transition: 0.3s;
        }
        input[type="text"]:focus { border-color: #2980b9; outline: none; box-shadow: 0 0 5px rgba(41,128,185,0.3); }
        .btn-enviar { 
            width: 100%; background: #27ae60; color: white; padding: 12px; 
            border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold;
        }
        .btn-enviar:hover { background: #219150; }
    </style>
    <script>
        function validar() {
            var dep = document.getElementById("dep").value;
            var desc = document.getElementById("desc").value;
            if (dep.trim() == "" || desc.trim() == "") {
                alert("⚠️ Los campos de Clave y Descripción no pueden quedar vacíos.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<div class="contenedor">
    <h2>Nuevo Departamento</h2>
    <p class="alumno">Estudiante: Ulises Sánchez / Abraham Vega</p>

    <form action="grabar_departamento.php" method="POST" onsubmit="return validar()">
        <label>Clave (Máx 2 caracteres):</label>
        <input type="text" name="departamento" id="dep" maxlength="2" placeholder="Ej: TI">

        <label>Descripción / Nombre:</label>
        <input type="text" name="descripcion" id="desc" maxlength="50" placeholder="Ej: Recursos Humanos">

        <input type="submit" value="Guardar en Base de Datos" class="btn-enviar">
    </form>
</div>

</body>
</html>