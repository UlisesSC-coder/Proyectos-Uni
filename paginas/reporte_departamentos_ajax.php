<?php
require_once "conexion_hosting_ulises.php";
header('Content-Type: text/html; charset=utf-8');

// Consulta para el primer ComboBox
$sql = "SELECT departamento, descripcion FROM departamentos";
$result = $conn->query($sql);
$departamentos = $result->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Consulta de Empleados</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            background-color: #e9ecef; 
            margin: 0; 
            padding: 40px; 
        }
        .main-card { 
            background: white; 
            max-width: 600px; 
            margin: auto; 
            padding: 30px; 
            border-radius: 12px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.1); 
            text-align: center;
        }
        h2 { color: #2c3e50; }
        label { 
            font-weight: bold; 
            margin-bottom: 8px; 
            display: block;
            color: #34495e; 
        }
        select { 
            width: 100%; 
            max-width: 300px; 
            padding: 10px; 
            border-radius: 8px; 
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
    </style>
    <script>
    function buscarEmpleados(departamento){
        const comboEmpleados = document.getElementById("comboEmpleados");
        
        if(departamento == ""){
            comboEmpleados.innerHTML = "<option>Seleccione un empleado...</option>";
            return;
        }

        fetch("get_empleados.php?id=" + departamento)
            .then(response => response.text())
            .then(data => {
                comboEmpleados.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
                comboEmpleados.innerHTML = "<option>Error al cargar</option>";
            });
    }
    </script>
</head>
<body>

<div class="main-card">
    <h2>Consulta Dinámica de Empleados</h2>
    <p>Selecciona un departamento para ver sus empleados</p>

    <label>Departamento:</label>
    <select onchange="buscarEmpleados(this.value)">
        <option value="">-- Seleccione Departamento --</option>
        <?php foreach ($departamentos as $d): ?>
            <option value="<?php echo $d['departamento']; ?>">
                <?php echo $d['descripcion']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Empleados:</label>
    <select id="comboEmpleados">
        <option>Esperando selección...</option>
    </select>

    <hr>
    <h3>Ulises Sánchez Camarena</h3>
</div>

</body>
</html>