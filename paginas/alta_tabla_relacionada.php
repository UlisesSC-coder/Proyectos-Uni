<?php
// Mandamos llamar a tu archivo de conexión exacto
require 'conexion_empleados.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Empleado - Ulises Sánchez Camarena</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5; display: flex; justify-content: center;
            align-items: center; min-height: 100vh; margin: 0; padding: 20px;
        }
        .formulario-contenedor {
            background-color: #ffffff; padding: 40px; border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); width: 100%; max-width: 450px;
        }
        h2 { text-align: center; color: #1c1e21; margin-bottom: 30px; }
        .grupo-input { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #4b4f56; font-weight: 600; font-size: 14px; }
        input[type="text"], input[type="number"], select {
            width: 100%; padding: 12px; border: 1px solid #dddfe2;
            border-radius: 8px; box-sizing: border-box; font-size: 16px;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus, input[type="number"]:focus, select:focus {
            border-color: #1877f2; outline: none; box-shadow: 0 0 0 2px #e7f3ff;
        }
        /* Botón Principal (Guardar) */
        .btn-primario {
            width: 100%; padding: 12px; background-color: #4b00e0; /* Tono morado/azul de tu imagen */
            background: linear-gradient(90deg, #4b00e0 0%, #1877f2 100%);
            color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold;
            cursor: pointer; transition: opacity 0.2s; margin-bottom: 15px;
        }
        .btn-primario:hover { opacity: 0.9; }
        
        /* Botón Secundario (Ver Reporte) */
        .btn-secundario {
            display: block; width: 100%; padding: 12px; background-color: #00a8ff; 
            color: white; text-align: center; text-decoration: none; border-radius: 8px; 
            font-size: 16px; font-weight: bold; box-sizing: border-box; transition: background-color 0.2s;
        }
        .btn-secundario:hover { background-color: #0097e6; }
        
        .credito { text-align: center; font-size: 12px; color: #8a8d91; margin-top: 20px; }
    </style>
</head>
<body>

    <div class="formulario-contenedor">
        <h2>Registrar Nuevo Empleado</h2>
        
        <form name="formEmpleado" action="grabar_tabla_relacionada.php" method="POST" onsubmit="return validarFormulario()">
            
            <div class="grupo-input">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej. Juan Pérez López">
            </div>

            <div class="grupo-input">
                <label for="id_departamento">Departamento (Catálogo):</label>
                <select id="id_departamento" name="id_departamento">
                    <option value="">-- Selecciona un departamento --</option>
                    <?php
                    // Usamos la variable $conn que viene de tu archivo conexion_empleados.php
                    $query_catalogo = "SELECT departamento, descripcion FROM departamentos";
                    $stmt = $conn->query($query_catalogo);
                    
                    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $fila['departamento'] . '">' . $fila['descripcion'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="grupo-input">
                <label for="salario">Salario (Mensual):</label>
                <input type="number" id="salario" name="salario" step="0.01" min="0" placeholder="Ej. 15000.00">
            </div>

            <div class="grupo-input">
                <label for="categoria">Categoría (Puesto):</label>
                <input type="text" id="categoria" name="categoria" placeholder="Ej. Analista Senior">
            </div>

            <div class="grupo-input">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo">
                    <option value="">-- Selecciona sexo --</option>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                    <option value="X">No Binario / Otro</option>
                </select>
            </div>

            <button type="submit" class="btn-primario">Guardar Empleado</button>
            
            <a href="tabla_empleados.php" class="btn-secundario">Ver Reporte de Empleados</a>

        </form>
        <div class="credito">Ulises Sánchez Camarena</div>
    </div>

    <script>
        function validarFormulario() {
            var nombre = document.getElementById("nombre").value;
            var depto = document.getElementById("id_departamento").value;
            var salario = document.getElementById("salario").value;
            var categoria = document.getElementById("categoria").value;
            var sexo = document.getElementById("sexo").value;

            if (nombre.trim() === "" || depto === "" || salario === "" || categoria.trim() === "" || sexo === "") {
                alert("Por favor, completa TODOS los campos del formulario. Son obligatorios.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>