<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php"); exit();
}
include("../conexion_hosting_ulises.php");

$clave = isset($_GET['clave']) ? intval($_GET['clave']) : 0;

$propietarios = [];
try {
    $propietarios = $conn->query("SELECT id_propietario, nombre, apellido_paterno, apellido_materno FROM Propietarios ORDER BY id_propietario DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al cargar propietarios: " . $e->getMessage(); exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_prop    = trim($_POST['id_propietario']);
    $tipo_p     = trim($_POST['tipo_propiedad']);
    $sup_t      = trim($_POST['superficie_terreno']);
    $sup_c      = trim($_POST['superficie_construccion']);
    $col        = trim($_POST['colindancias']);
    $estatus    = trim($_POST['estatus']);
    $valor      = trim($_POST['valor_castral']);
    $ubicacion  = trim($_POST['ubicacion_domicilio']);

    $nombre_propietario_seleccionado = "No identificado";
    foreach ($propietarios as $p) {
        if ($p['id_propietario'] == $id_prop) {
            $nombre_propietario_seleccionado = $p['nombre'] . ' ' . $p['apellido_paterno'] . ' ' . $p['apellido_materno'];
            break;
        }
    }

    try {
        $sql = "UPDATE Predios SET id_propietario=:id_prop, tipo_propiedad=:tipo, superficie_terreno=:sup_t, superficie_construccion=:sup_c, colindancias=:col, estatus=:est, valor_castral=:val, ubicacion_domicilio=:ubica WHERE clave_castral=:clave";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id_prop'=>$id_prop, ':tipo'=>$tipo_p, ':sup_t'=>$sup_t, ':sup_c'=>$sup_c,
            ':col'=>$col, ':est'=>$estatus, ':val'=>$valor, ':ubica'=>$ubicacion, ':clave'=>$clave
        ]);

        $_SESSION['predio_editado'] = [
            'clave_castral' => $clave, 
            'id_propietario' => $id_prop,
            'nombre_propietario' => $nombre_propietario_seleccionado,
            'tipo_propiedad' => $tipo_p, 
            'superficie_terreno' => $sup_t,
            'superficie_construccion' => $sup_c, 
            'colindancias' => $col, 
            'estatus' => $estatus, 
            'valor_castral' => $valor, 
            'ubicacion_domicilio' => $ubicacion
        ];
        header("Location: exito_editar_predio.php"); exit();
    } catch (PDOException $e) { echo "Error al actualizar predio: " . $e->getMessage(); exit(); }
}

$stmt = $conn->prepare("SELECT * FROM Predios WHERE clave_castral = :clave");
$stmt->execute([':clave' => $clave]);
$predio = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$predio) { echo "No se encontró el predio."; exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Predio</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/validacion_editar_predio.js?v=<?php echo time(); ?>" defer></script>
</head>
<body class="dashboard-page">

   <nav class="nav-container-canva">
        <ul class="main-menu-canva">
            
            <li class="menu-item-canva">
                <a href="menu.php">Inicio</a>
            </li>

            <li class="menu-item-canva">
                <a href="#">Altas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="alta_propietario.php">Alta de Propietario</a></li>
                    <li><a href="alta_predio.php">Alta de Predio</a></li>
                    <li><a href="alta_usuario.php">Alta de Usuario</a></li>
                </ul>
            </li>

            <li class="menu-item-canva">
    <a href="#">Consultas ▼</a>
    <ul class="dropdown-menu-canva">
        <li><a href="consulta_propietario.php">Ver Propietarios</a></li>
        <li><a href="consulta_predio.php">Ver Predios</a></li>
        <li><a href="consulta_usuarios.php">Ver Usuarios</a></li> </ul>
</li>

            <li class="menu-item-canva">
                <a href="#">Búsquedas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="buscar_propietario.php">Buscar Propietario</a></li>
                    <li><a href="buscar_predio.php">Buscar Predio</a></li>
                    <li><a href="buscar_usuario.php">Buscar Usuario</a></li>
                </ul>
            </li>

            <li class="menu-item-canva">
                <a href="#">Actualizaciones ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="modificar_propietario.php">Modificar Propietario</a></li>
                    <li><a href="modificar_predio.php">Modificar Predio</a></li>
                    <li><a href="modificar_usuario.php">Modificar Usuario</a></li> </ul>
            </li>

            <li class="menu-item-canva">
                <a href="#">Bajas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="baja_propietario.php">Eliminar Propietario</a></li>
                    <li><a href="baja_predio.php">Eliminar Predio</a></li>
                    <li><a href="baja_usuario.php">Eliminar Usuario</a></li> </ul>
            </li>

            <li class="menu-item-canva">
                <a href="#">Reportes ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="reporte_propietarios.php">PDF Propietarios</a></li>
                    <li><a href="reporte_predios.php">PDF Predios Generales</a></li>
                    <li><a href="reporte_historial.php">PDF Cuenta Catastral</a></li>
                    <li><a href="reporte_usuarios.php">PDF Usuarios</a></li>
                </ul>
            </li>

            <li class="menu-item-canva">
                <a href="../index.php" class="btn-salir-canva">Salir</a>
            </li>

        </ul>
    </nav>

    <div class="form-container-canva" style="margin-top: 40px;">
        <h2>Modificar Ficha Catastral</h2>
        <br>
        <form id="formEditarPredio" action="" method="POST">
            <div class="grupo-formulario-canva">
                <label>Clave Catastral (No Modificable)</label>
                <input type="text" value="#<?php echo $clave; ?>" class="input-bloqueado" readonly style="background-color: #f1f3f5; color: #718096; cursor: not-allowed; font-weight: bold;">
            </div>
            
            <div class="grupo-formulario-canva">
                <label for="id_propietario">Propietario Asignado (Llave Foránea) *</label>
                <select id="id_propietario" name="id_propietario" style="width:100%; padding:12px; border:1px solid #dcdfe4; border-radius:8px; box-sizing:border-box; background-color: #ffffff;">
                    <?php foreach ($propietarios as $prop): ?>
                        <option value="<?php echo $prop['id_propietario']; ?>" <?php echo ($prop['id_propietario'] == $predio['id_propietario']) ? 'selected' : ''; ?>>
                            ID: #<?php echo $prop['id_propietario']; ?> - <?php echo htmlspecialchars($prop['nombre'] . ' ' . $prop['apellido_paterno']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row-canva" style="margin-top:15px;">
                <div class="grupo-formulario-canva">
                    <label for="tipo_propiedad">Tipo de Propiedad *</label>
                    <input type="text" id="tipo_propiedad" name="tipo_propiedad" value="<?php echo htmlspecialchars($predio['tipo_propiedad']); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="estatus">Estatus *</label>
                    <input type="text" id="estatus" name="estatus" value="<?php echo htmlspecialchars($predio['estatus']); ?>">
                </div>
            </div>

            <div class="form-row-canva">
                <div class="grupo-formulario-canva">
                    <label for="superficie_terreno">Superficie Terreno (m²) *</label>
                    <input type="number" step="0.01" id="superficie_terreno" name="superficie_terreno" value="<?php echo htmlspecialchars($predio['superficie_terreno']); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="superficie_construccion">Superficie Construcción (m²) *</label>
                    <input type="number" step="0.01" id="superficie_construccion" name="superficie_construccion" value="<?php echo htmlspecialchars($predio['superficie_construccion']); ?>">
                </div>
            </div>

            <div class="form-row-canva">
                <div class="grupo-formulario-canva">
                    <label for="valor_castral">Valor Catastral ($) *</label>
                    <input type="number" step="0.01" id="valor_castral" name="valor_castral" value="<?php echo htmlspecialchars($predio['valor_castral']); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="colindancias">Colindancias *</label>
                    <input type="text" id="colindancias" name="colindancias" value="<?php echo htmlspecialchars($predio['colindancias']); ?>">
                </div>
            </div>

            <div class="grupo-formulario-canva">
                <label for="ubicacion_domicilio">Ubicación / Domicilio del Predio *</label>
                <input type="text" id="ubicacion_domicilio" name="ubicacion_domicilio" value="<?php echo htmlspecialchars($predio['ubicacion_domicilio']); ?>">
            </div>
            <br>
            <button type="submit" class="btn-guardar-canva">Guardar Cambios</button>
            <a href="modificar_predio.php" style="display:block; text-align:center; margin-top:15px; color:#4a5568; text-decoration:none;">◀ Cancelar y Volver</a>
        </form>
    </div>
</body>
</html>