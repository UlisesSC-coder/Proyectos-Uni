<?php 
include("conexion_empleados.php"); 

$mensaje = "";

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['departamento'];
    $desc = $_POST['descripcion'];

    try {
        $stmt = $conn->prepare("INSERT INTO departamentos (departamento, descripcion) VALUES (:id, :desc)");
        $stmt->execute(['id' => $id, 'desc' => $desc]);
        $mensaje = "DEPARTAMENTO REGISTRADO EXITOSAMENTE";
    } catch(PDOException $e) {
        $mensaje = "Error al registrar: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Departamento</title>
    <style>
        body { background-color: #fdfae7; font-family: 'Times New Roman', Times, serif; }
        .main-container { width: 80%; margin: 50px auto; border: 1px solid #ccc; background-color: #e6e6e6; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header-title { font-weight: bold; font-size: 1.2em; text-transform: uppercase; margin-bottom: 30px; }
        .field-container { margin-bottom: 20px; }
        .field-label { display: inline-block; width: 250px; font-size: 1.1em; }
        input[type="text"] { width: 300px; padding: 5px; border: 1px solid #99c; }
        .button-container { display: flex; justify-content: space-around; margin-top: 40px; }
        .btn-large { display: inline-block; padding: 10px 25px; text-decoration: none; color: #000; background-color: #eee; border: 2px solid #000080; font-size: 1.1em; cursor: pointer; }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header-title"><?php echo $mensaje ? $mensaje : "REGISTRAR NUEVO DEPARTAMENTO"; ?></div>

        <form method="POST">
            <div class="field-container">
                <span class="field-label">Número de departamento:</span>
                <input type="text" name="departamento" required maxlength="2" placeholder="Ej. D0">
            </div>
            <div class="field-container">
                <span class="field-label">Nombre de departamento:</span>
                <input type="text" name="descripcion" required>
            </div>
            
            <div class="button-container">
                <button type="submit" class="btn-large">Guardar Registro</button>
                <a href="reporte_para_borrar_catalogo_ulises.php" class="btn-large">Ir al Reporte</a>
            </div>
        </form>
    </div>
</body>
</html>