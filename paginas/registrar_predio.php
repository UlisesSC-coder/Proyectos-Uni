<?php include("conexion_hosting_ulises.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nuevo Predio</title>
    <style>
        body { background-color: #fdfae7; font-family: 'Times New Roman', Times, serif; }
        .main-container { width: 70%; margin: 30px auto; border: 1px solid #ccc; background-color: #e6e6e6; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #000080; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ccc; box-sizing: border-box; }
        .btn-submit { padding: 10px 20px; background-color: #000080; color: white; border: none; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <div class="main-container">
        <h2>Registrar Nuevo Predio</h2>
        <form action="guardar_predio.php" method="POST">
            <div class="form-group">
                <label>Propietario:</label>
                <select name="id_propietario" required>
                    <?php
                    $stmt = $conn->query("SELECT id_propietario, nombre, apellido_paterno FROM Propietarios");
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$row['id_propietario']."'>".$row['nombre']." ".$row['apellido_paterno']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tipo de Propiedad:</label>
                <input type="text" name="tipo_propiedad" required>
            </div>
            <div class="form-group">
                <label>Superficie Terreno (solo números):</label>
                <input type="number" name="superficie_terreno" step="0.01" required>
            </div>
            <div class="form-group">
                <label>Ubicación:</label>
                <input type="text" name="ubicacion_domicilio" required>
            </div>
            <button type="submit" class="btn-submit">Guardar Predio</button>
        </form>
    </div>
</body>
</html>