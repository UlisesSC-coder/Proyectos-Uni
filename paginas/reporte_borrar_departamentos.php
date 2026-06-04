<?php
// 1. Proteger la página mediante sesiones
require_once "proteccion.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Conexión directa a tus datos de empleados
$servername = "sql305.infinityfree.com";   
$username = "if0_40967812";           
$password = "AGENTElol008";        
$BaseDatos = "if0_40967812_empleados"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$BaseDatos;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consultamos todos los departamentos para listarlos
    $sql = "SELECT * FROM departamentos ORDER BY departamento ASC";
    $stmt = $conn->query($sql);
    $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Reporte para dar de Baja Departamentos</title>
<style>
    body { background-color: slategray; font-family: sans-serif; }
    #contenedor { margin: auto; width: 960px; background-color: cornsilk; padding: 20px; border-radius: 5px; margin-top: 20px; box-sizing: border-box; }
    header h2 { text-align: center; color: #333; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; background-color: white; margin-top: 10px; }
    th, td { border: 1px solid #333; padding: 10px; text-align: center; }
    th { background-color: midnightblue; color: white; }
    .btn-eliminar { background-color: #cc0000; color: white; padding: 5px 10px; text-decoration: none; font-weight: bold; border-radius: 3px; }
    .btn-eliminar:hover { background-color: red; }
    .btn-volver { display: inline-block; margin-top: 20px; background-color: darkorange; color: white; padding: 10px 15px; text-decoration: none; font-weight: bold; border-radius: 5px; }
    .btn-volver:hover { background-color: #ff9900; }
</style>
</head>
<body>

<div id="contenedor">
    <header>
        <h2>REPORTE GENERAL DE DEPARTAMENTOS (MÓDULO DE BAJAS)</h2>
    </header>
    
    <p>Seleccione el departamento que desea eliminar permanentemente del sistema:</p>
    
    <table>
        <thead>
            <tr>
                <th>Código de Departamento</th>
                <th>Descripción / Nombre</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($departamentos)): ?>
                <tr>
                    <td colspan="3">No hay departamentos registrados actualmente.</td>
                </tr>
            <?php else: ?>
                <?php foreach($departamentos as $dep): ?>
                    <tr>
                        <td><b><?php echo htmlspecialchars($dep['departamento']); ?></b></td>
                        <td><?php echo htmlspecialchars($dep['descripcion']); ?></td>
                        <td>
                            <a href="eliminar_departamento.php?id=<?php echo urlencode($dep['departamento']); ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que quieres eliminar este departamento?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <a href="menu_principal.php" class="btn-volver">Volver al Menú Principal</a>
</div>

</body>
</html>