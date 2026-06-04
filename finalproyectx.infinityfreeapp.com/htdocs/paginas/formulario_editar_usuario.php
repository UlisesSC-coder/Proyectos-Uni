<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php"); 
    exit();
}
include("../conexion_hosting_ulises.php");

$id_usuario = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user_post = $_POST['id_usuario_hidden'];
    $txt_usuario  = trim($_POST['usuario']);
    $txt_clave    = trim($_POST['clave']);
    $txt_tipo     = trim($_POST['tipousuario']);

    try {
        $sql_update = "UPDATE usuarios SET usuario = :usuario, clave = :clave, tipousuario = :tipousuario WHERE id_usuario = :id_usuario";
        $stmt_up = $conn->prepare($sql_update);
        $stmt_up->execute([
            'usuario'     => $txt_usuario,
            'clave'       => $txt_clave,
            'tipousuario' => $txt_tipo,
            'id_usuario'  => $id_user_post
        ]);

        $_SESSION['usuario_editado'] = [
            'id_usuario'  => $id_user_post,
            'usuario'     => $txt_usuario,
            'clave'       => $txt_clave,
            'tipousuario' => $txt_tipo
        ];

        header("Location: exito_editar_usuario.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al guardar los cambios: " . $e->getMessage(); 
        exit();
    }
}

try {
    $stmt_u = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
    $stmt_u->execute(['id' => $id_usuario]);
    $usuario_actual = $stmt_u->fetch(PDO::FETCH_ASSOC);

    if (!$usuario_actual) {
        echo "Error: El usuario no existe en la base de datos."; 
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Editar Cuenta de Usuario</title>
    <link class="cdn" rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/validacion_editar_usuario.js?v=<?php echo time(); ?>" defer></script>
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

    <div class="formulario-container-canva" style="width: 90%; max-width: 650px; margin: 40px auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h2 class="titulo-formulario-canva" style="color: #0e1217; margin-bottom: 5px;">Actualizar Datos de Usuario</h2>
        <p class="subtitulo-formulario-canva" style="color: #4a5568; margin-bottom: 25px;">Modifica las credenciales de ingreso y privilegios de acceso del personal del sistema catastral.</p>
        
        <form id="formEditarUsuario" method="POST" action="formulario_editar_usuario.php?id=<?php echo urlencode($id_usuario); ?>">
            
            <input type="hidden" name="id_usuario_hidden" id="id_usuario_hidden" value="<?php echo htmlspecialchars($usuario_actual['id_usuario']); ?>">

            <div class="form-row-canva" style="display: flex; gap: 20px; margin-bottom: 20px;">
                <div class="grupo-formulario-canva" style="flex: 1; display: flex; flex-direction: column;">
                    <label for="usuario" style="font-weight: 600; margin-bottom: 8px; color: #4a5568;">Nombre de Usuario (Login) *</label>
                    <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($usuario_actual['usuario']); ?>" style="width: 100%; padding: 10px; border: 1px solid #dcdfe4; border-radius: 6px; box-sizing: border-box;">
                </div>
                <div class="grupo-formulario-canva" style="flex: 1; display: flex; flex-direction: column;">
                    <label for="tipousuario" style="font-weight: 600; margin-bottom: 8px; color: #4a5568;">Rol de Privilegios *</label>
                    <select id="tipousuario" name="tipousuario" style="width: 100%; padding: 10px; border: 1px solid #dcdfe4; border-radius: 6px; box-sizing: border-box; background-color: #ffffff; height: 38px;">
                        <option value="1" <?php if($usuario_actual['tipousuario'] == '1') echo 'selected'; ?>>Administrador (Tipo 1)</option>
                        <option value="2" <?php if($usuario_actual['tipousuario'] == '2') echo 'selected'; ?>>Operador/Becario (Tipo 2)</option>
                    </select>
                </div>
            </div>

            <div class="grupo-formulario-canva" style="display: flex; flex-direction: column; margin-bottom: 25px;">
                <label for="clave" style="font-weight: 600; margin-bottom: 8px; color: #4a5568;">Contraseña / Password de Acceso *</label>
                <input type="text" id="clave" name="clave" value="<?php echo htmlspecialchars($usuario_actual['clave']); ?>" style="width: 100%; padding: 10px; border: 1px solid #dcdfe4; border-radius: 6px; box-sizing: border-box; font-family: monospace;">
            </div>
            
            <div style="display: flex; gap: 15px; margin-top: 10px;">
                <button type="submit" class="btn-guardar-canva" style="flex: 1; background: #00c4cc; color: white; padding: 12px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Guardar Cambios</button>
                <a href="modificar_usuario.php" style="flex: 1; display: block; text-align: center; background: #edf2f7; color: #4a5568; padding: 12px; border-radius: 6px; text-decoration: none; font-weight: 600; border: 1px solid #dcdfe4; box-sizing: border-box;">Cancelar y Volver</a>
            </div>
        </form>
    </div>
</body>
</html>