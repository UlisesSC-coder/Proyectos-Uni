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

$mensaje = "";
$tipo_mensaje = "";

$nombre_form            = '';
$apellido_paterno_form  = '';
$apellido_materno_form  = '';
$rfc_form               = '';
$curp_form              = '';
$telefono_form          = '';
$correo_form            = '';
$fecha_nacimiento_form  = '';
$domicilio_form         = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_form            = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido_paterno_form  = isset($_POST['apellido_paterno']) ? trim($_POST['apellido_paterno']) : '';
    $apellido_materno_form  = isset($_POST['apellido_materno']) ? trim($_POST['apellido_materno']) : '';
    $rfc_form               = isset($_POST['rfc']) ? trim($_POST['rfc']) : '';
    $curp_form              = isset($_POST['curp']) ? trim($_POST['curp']) : '';
    $telefono_form          = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $correo_form            = isset($_POST['correo_electronico']) ? trim($_POST['correo_electronico']) : '';
    $fecha_nacimiento_form  = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';
    $domicilio_form         = isset($_POST['domicilio']) ? trim($_POST['domicilio']) : '';

    if (!empty($nombre_form) && !empty($apellido_paterno_form) && !empty($apellido_materno_form) && !empty($fecha_nacimiento_form) && !empty($rfc_form) && !empty($curp_form) && !empty($telefono_form) && !empty($correo_form) && !empty($domicilio_form)) {
        try {
            $sql = "INSERT INTO Propietarios (nombre, apellido_paterno, apellido_materno, rfc, curp, telefono, correo_electronico, fecha_nacimiento, domicilio, fecha_registro) 
                    VALUES (:nombre, :apellido_paterno, :apellido_materno, :rfc, :curp, :telefono, :correo_electronico, :fecha_nacimiento, :domicilio, NOW())";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre_form);
            $stmt->bindParam(':apellido_paterno', $apellido_paterno_form);
            $stmt->bindParam(':apellido_materno', $apellido_materno_form);
            $stmt->bindParam(':rfc', $rfc_form);
            $stmt->bindParam(':curp', $curp_form);
            $stmt->bindParam(':telefono', $telefono_form);
            $stmt->bindParam(':correo_electronico', $correo_form);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento_form);
            $stmt->bindParam(':domicilio', $domicilio_form);
            
            if ($stmt->execute()) {
                $id_generado = $conn->lastInsertId();
                
                $_SESSION['ultimo_registro'] = [
                    'id_propietario'     => $id_generado,
                    'nombre'             => $nombre_form,
                    'apellido_paterno'   => $apellido_paterno_form,
                    'apellido_materno'   => $apellido_materno_form,
                    'rfc'                => $rfc_form,
                    'curp'               => $curp_form,
                    'telefono'           => $telefono_form,
                    'correo_electronico' => $correo_form,
                    'fecha_nacimiento'   => $fecha_nacimiento_form,
                    'domicilio'          => $domicilio_form,
                    'fecha_registro'     => date("Y-m-d H:i:s")
                ];
                
                header("Location: exito_propietario.php");
                exit();
            } else {
                $mensaje = "No se pudo registrar al propietario de forma interna.";
                $tipo_mensaje = "error";
            }
        } catch (PDOException $e) {
            $mensaje = "Error en la base de datos: " . $e->getMessage();
            $tipo_mensaje = "error";
        }
    } else {
        $mensaje = "Todos los campos sin excepción son completamente obligatorios.";
        $tipo_mensaje = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Alta de Propietario</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/validacion_alta_propietario.js?v=<?php echo time(); ?>" defer></script>
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
        <h2>Alta de Propietario</h2>
        <p>Introduce los datos correspondientes del titular jurídico de la propiedad.</p>

        <?php if (!empty($mensaje)): ?>
            <div class="alerta-canva <?php echo $tipo_mensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form id="formPropietario" action="alta_propietario.php" method="POST">
            
            <div class="grupo-formulario-canva">
                <label for="nombre">Nombre(s) *</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej. Juanito" autocomplete="off" value="<?php echo htmlspecialchars($nombre_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="apellido_paterno">Apellido Paterno *</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Ej. Pérez" autocomplete="off" value="<?php echo htmlspecialchars($apellido_paterno_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="apellido_materno">Apellido Materno *</label>
                <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Ej. López" autocomplete="off" value="<?php echo htmlspecialchars($apellido_materno_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="fecha_nacimiento">Fecha de Nacimiento *</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($fecha_nacimiento_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="rfc">RFC *</label>
                <input type="text" id="rfc" name="rfc" placeholder="13 caracteres" maxlength="13" autocomplete="off" value="<?php echo htmlspecialchars($rfc_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="curp">CURP *</label>
                <input type="text" id="curp" name="curp" placeholder="18 caracteres" maxlength="18" autocomplete="off" value="<?php echo htmlspecialchars($curp_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="telefono">Teléfono Celular *</label>
                <input type="text" id="telefono" name="telefono" placeholder="10 dígitos" maxlength="10" autocomplete="off" value="<?php echo htmlspecialchars($telefono_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="correo_electronico">Correo Electrónico *</label>
                <input type="text" id="correo_electronico" name="correo_electronico" placeholder="ejemplo@correo.com" autocomplete="off" value="<?php echo htmlspecialchars($correo_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="domicilio">Domicilio Particular *</label>
                <input type="text" id="domicilio" name="domicilio" placeholder="Calle, Número, Colonia" autocomplete="off" value="<?php echo htmlspecialchars($domicilio_form); ?>">
            </div>

            <button type="submit" id="btnGuardar" class="btn-guardar-canva">Guardar Propietario</button>
        </form>
    </div>

</body>
</html>