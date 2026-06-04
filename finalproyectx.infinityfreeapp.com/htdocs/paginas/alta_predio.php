<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}

include("../conexion_hosting_ulises.php");

// CONSULTA PARA EXTRAER LOS PROPIETARIOS EXISTENTES
$propietarios = [];
try {
    $stmt_prop = $conn->query("SELECT id_propietario, nombre, apellido_paterno, apellido_materno FROM Propietarios ORDER BY id_propietario DESC");
    $propietarios = $stmt_prop->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Silencioso o log interno
}

$mensaje = "";
$tipo_mensaje = "";

// Variables para mantener los datos en el formulario en caso de error
$id_propietario = '';
$tipo_propiedad = '';
$superficie_terreno = '';
$superficie_construccion = '';
$colindancias = '';
$estatus = '';
$valor_castral = '';
$ubicacion_domicilio = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_propietario          = isset($_POST['id_propietario']) ? trim($_POST['id_propietario']) : '';
    $tipo_propiedad          = isset($_POST['tipo_propiedad']) ? trim($_POST['tipo_propiedad']) : '';
    $superficie_terreno      = isset($_POST['superficie_terreno']) ? trim($_POST['superficie_terreno']) : '';
    $superficie_construccion = isset($_POST['superficie_construccion']) ? trim($_POST['superficie_construccion']) : '';
    $colindancias           = isset($_POST['colindancias']) ? trim($_POST['colindancias']) : '';
    $estatus                = isset($_POST['estatus']) ? trim($_POST['estatus']) : '';
    $valor_castral          = isset($_POST['valor_castral']) ? trim($_POST['valor_castral']) : '';
    $ubicacion_domicilio    = isset($_POST['ubicacion_domicilio']) ? trim($_POST['ubicacion_domicilio']) : '';

    if (!empty($id_propietario) && !empty($tipo_propiedad) && !empty($superficie_terreno) && !empty($superficie_construccion) && !empty($colindancias) && !empty($estatus) && !empty($valor_castral) && !empty($ubicacion_domicilio)) {
        try {
            $sql = "INSERT INTO Predios (id_propietario, tipo_propiedad, superficie_terreno, superficie_construccion, colindancias, estatus, valor_castral, ubicacion_domicilio) 
                    VALUES (:id_prop, :tipo, :sup_t, :sup_c, :col, :est, :valor, :ubica)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':id_prop'=> $id_propietario,
                ':tipo'   => $tipo_propiedad,
                ':sup_t'  => $superficie_terreno,
                ':sup_c'  => $superficie_construccion,
                ':col'    => $colindancias,
                ':est'    => $estatus,
                ':valor'  => $valor_castral,
                ':ubica'  => $ubicacion_domicilio
            ]);

            // CAPTURAMOS LA NUEVA CLAVE CASTRAL AUTOASIGNADA
            $nueva_clave_castral = $conn->lastInsertId();

            $_SESSION['ultimo_predio'] = [
                'clave_castral'           => $nueva_clave_castral,
                'id_propietario'          => $id_propietario,
                'tipo_propiedad'          => $tipo_propiedad,
                'superficie_terreno'      => $superficie_terreno,
                'superficie_construccion' => $superficie_construccion,
                'colindancias'            => $colindancias,
                'estatus'                 => $estatus,
                'valor_castral'           => $valor_castral,
                'ubicacion_domicilio'     => $ubicacion_domicilio
            ];

            header("Location: exito_predio.php");
            exit();

        } catch (PDOException $e) {
            $mensaje = "Error al registrar predio: " . $e->getMessage();
            $tipo_mensaje = "error";
        }
    } else {
        $mensaje = "Por favor, completa todos los campos obligatorios.";
        $tipo_mensaje = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Alta Predio</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/validacion_alta_predio.js?v=<?php echo time(); ?>" defer></script>
</head>
<body class="dashboard-page">

    <nav class="nav-container-canva">
        <ul class="main-menu-canva">
            <li class="menu-item-canva"><a href="menu.php">Inicio</a></li>
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
                    <li><a href="consulta_usuarios.php">Ver Usuarios</a></li> 
                </ul>
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
                    <li><a href="modificar_usuario.php">Modificar Usuario</a></li> 
                </ul>
            </li>
            <li class="menu-item-canva">
                <a href="#">Bajas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="baja_propietario.php">Eliminar Propietario</a></li>
                    <li><a href="baja_predio.php">Eliminar Predio</a></li>
                    <li><a href="baja_usuario.php">Eliminar Usuario</a></li> 
                </ul>
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
            <li class="menu-item-canva"><a href="../index.php" class="btn-salir-canva">Salir</a></li>
        </ul>
    </nav>

    <div class="form-container-canva">
        <h2>Registrar Nuevo Predio</h2>
        <p>Introduce la información oficial del inmueble. La Clave Catastral será asignada automáticamente por el sistema.</p>

        <?php if (!empty($mensaje)): ?>
            <div class="alerta-canva <?php echo $tipo_mensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form id="formPredio" action="" method="POST" novalidate>
            <div class="form-row-canva">
                <div class="grupo-formulario-canva ancho-completo">
                    <label for="id_propietario">Propietario Legal *</label>
                    <select id="id_propietario" name="id_propietario">
                        <option value="">-- Seleccione un Propietario --</option>
                        <?php foreach ($propietarios as $prop): ?>
                            <option value="<?php echo $prop['id_propietario']; ?>" <?php echo ($id_propietario == $prop['id_propietario']) ? 'selected' : ''; ?>>
                                ID: #<?php echo $prop['id_propietario']; ?> - <?php echo htmlspecialchars($prop['nombre'] . ' ' . $prop['apellido_paterno'] . ' ' . $prop['apellido_materno']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row-canva">
                <div class="grupo-formulario-canva">
                    <label for="tipo_propiedad">Tipo de Propiedad *</label>
                    <input type="text" id="tipo_propiedad" name="tipo_propiedad" placeholder="Ej. local comercial, departamento" value="<?php echo htmlspecialchars($tipo_propiedad); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="estatus">Estatus *</label>
                    <input type="text" id="estatus" name="estatus" placeholder="Ej. Renta, Activo, Venta" value="<?php echo htmlspecialchars($estatus); ?>">
                </div>
            </div>

            <div class="form-row-canva">
                <div class="grupo-formulario-canva">
                    <label for="superficie_terreno">Superficie Terreno (m²) *</label>
                    <input type="number" step="0.01" id="superficie_terreno" name="superficie_terreno" placeholder="Ej. 60" value="<?php echo htmlspecialchars($superficie_terreno); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="superficie_construccion">Superficie Construcción (m²) *</label>
                    <input type="number" step="0.01" id="superficie_construccion" name="superficie_construccion" placeholder="Ej. 55.00" value="<?php echo htmlspecialchars($superficie_construccion); ?>">
                </div>
            </div>

            <div class="form-row-canva">
                <div class="grupo-formulario-canva">
                    <label for="valor_castral">Valor Catastral ($) *</label>
                    <input type="number" step="0.01" id="valor_castral" name="valor_castral" placeholder="Ej. 900000" value="<?php echo htmlspecialchars($valor_castral); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="colindancias">Colindancias *</label>
                    <input type="text" id="colindancias" name="colindancias" placeholder="Ej. Este, Oeste, Sur, Norte" value="<?php echo htmlspecialchars($colindancias); ?>">
                </div>
            </div>

            <div class="grupo-formulario-canva">
                <label for="ubicacion_domicilio">Ubicación / Domicilio del Predio *</label>
                <input type="text" id="ubicacion_domicilio" name="ubicacion_domicilio" placeholder="Calle, Número, Colonia o Comunidad del Inmueble" value="<?php echo htmlspecialchars($ubicacion_domicilio); ?>">
            </div>

            <button type="submit" id="btnGuardarPredio" class="btn-guardar-canva">Guardar Predio</button>
        </form>
    </div>

</body>
</html>