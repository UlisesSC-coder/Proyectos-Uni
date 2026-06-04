<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Candado de seguridad
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}

// Conexión oficial
include("../conexion_hosting_ulises.php");

$mensaje = "";
$tipo_mensaje = "";

// Variables para mantener los datos en el formulario en caso de error
$usuario_form = '';
$tipousuario_form = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_form     = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $clave_form       = isset($_POST['clave']) ? trim($_POST['clave']) : '';
    $tipousuario_form = isset($_POST['tipousuario']) ? trim($_POST['tipousuario']) : '';

    if (!empty($usuario_form) && !empty($clave_form) && !empty($tipousuario_form)) {
        try {
            // SEGURIDAD: Encriptación de contraseña usando BCRYPT antes de guardarla en la Base de Datos
            $clave_encriptada = password_hash($clave_form, PASSWORD_BCRYPT);

            $sql = "INSERT INTO usuarios (usuario, clave, tipousuario) VALUES (:usuario, :clave, :tipousuario)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario_form);
            $stmt->bindParam(':clave', $clave_encriptada); // Guardamos la versión segura cifrada
            $stmt->bindParam(':tipousuario', $tipousuario_form);
            
            if ($stmt->execute()) {
                $id_generado = $conn->lastInsertId();
                
                // Guardamos en la sesión para la pantalla de confirmación/éxito
                $_SESSION['ultimo_registro'] = [
                    'id'          => $id_generado,
                    'usuario'     => $usuario_form,
                    'clave'       => $clave_form, // Se pasa la clave legible solo para visualización final si es requerido
                    'tipousuario' => ($tipousuario_form == '1') ? 'Administrador (Tipo 1)' : 'Operador/Becario (Tipo 2)'
                ];
                
                header("Location: exito_usuario.php");
                exit();
            } else {
                $mensaje = "No se pudo registrar el usuario.";
                $tipo_mensaje = "error";
            }
        } catch (PDOException $e) {
            $mensaje = "Error en la base de datos: " . $e->getMessage();
            $tipo_mensaje = "error";
        }
    } else {
        $mensaje = "Todos los campos marcados con (*) son obligatorios.";
        $tipo_mensaje = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Alta de Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/validacion_alta_usuario.js?v=<?php echo time(); ?>" defer></script>
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
        <h2>Alta de Usuario</h2>
        <p>Registra las credenciales de acceso para el personal del sistema.</p>

        <?php if (!empty($mensaje)): ?>
            <div class="alerta-canva <?php echo $tipo_mensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form id="formUsuario" action="alta_usuario.php" method="POST">
            <div class="grupo-formulario-canva">
                <label for="usuario">Nombre de Usuario (Login) *</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ej. goku" autocomplete="off" value="<?php echo htmlspecialchars($usuario_form); ?>">
            </div>

            <div class="grupo-formulario-canva">
                <label for="clave">Contraseña / Clave de Acceso *</label>
                <input type="password" id="clave" name="clave" placeholder="Ingresa la clave de acceso" autocomplete="off">
            </div>

            <div class="grupo-formulario-canva">
                <label for="tipousuario">Tipo de Rol / Permisos *</label>
                <select id="tipousuario" name="tipousuario" class="select-canva">
                    <option value="">-- Selecciona una opción --</option>
                    <option value="1" <?php echo ($tipousuario_form === '1') ? 'selected' : ''; ?>>Administrador (Tipo 1)</option>
                    <option value="2" <?php echo ($tipousuario_form === '2') ? 'selected' : ''; ?>>Operador/Becario (Tipo 2)</option>
                </select>
            </div>

            <button type="submit" id="btnGuardar" class="btn-guardar-canva">Guardar Usuario</button>
        </form>
    </div>

</body>
</html>