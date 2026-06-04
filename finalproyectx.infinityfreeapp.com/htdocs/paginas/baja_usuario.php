<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); 
    exit();
}
include("../conexion_hosting_ulises.php");

// --- PROCESADOR DE LA BAJA INTERCEPTADA ---
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $id_a_eliminar = $_GET['id'];

    try {
        // 1. Primero respaldamos los datos en la sesión para mostrarlos en la pantalla de éxito
        $stmt_backup = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
        $stmt_backup->execute(['id' => $id_a_eliminar]);
        $usuario_datos = $stmt_backup->fetch(PDO::FETCH_ASSOC);

        if ($usuario_datos) {
            $_SESSION['usuario_eliminado_datos'] = $usuario_datos;

            // 2. Procedemos a borrar definitivamente de la base de datos
            $stmt_del = $conn->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
            $stmt_del->execute(['id' => $id_a_eliminar]);

            // 3. Redirección automática al éxito
            header("Location: exito_baja_usuario.php");
            exit();
        } else {
            echo "Error: El usuario ya no existe.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error en la baja: " . $e->getMessage();
        exit();
    }
}

// --- CONSULTA GENERAL PARA LA TABLA ---
try {
    $stmt = $conn->query("SELECT id_usuario, usuario, clave, tipousuario FROM usuarios ORDER BY id_usuario ASC");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Catastro - Eliminar Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/confirmar_baja_usuario.js?v=<?php echo time(); ?>" defer></script>
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

    <div class="tabla-container-canva container-bajas-usuario">
        <h2>Baja de Registro de Usuarios</h2>
        <p class="texto-advertencia">⚠️ Advertencia: Al presionar "Eliminar" e interceptar la confirmación, la cuenta de acceso será revocada y purgada definitivamente del sistema.</p>
        <br>
        <div class="table-responsive">
            <table class="tabla-resumen tabla-bajas">
                <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Nombre de Usuario (Login)</th>
                        <th>Contraseña / Password</th>
                        <th>Tipo de Rol / Privilegio</th>
                        <th class="th-accion">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td class="td-id-baja">#<?php echo $u['id_usuario']; ?></td>
                            <td class="td-nombre-baja"><?php echo htmlspecialchars($u['usuario']); ?></td>
                            <td class="td-clave-usuario"><?php echo htmlspecialchars($u['clave']); ?></td>
                            <td>
                                <?php if ($u['tipousuario'] == '1'): ?>
                                    <span class="badge-admin">Administrador (Tipo 1)</span>
                                <?php else: ?>
                                    <span class="badge-operador">Operador/Becario (Tipo 2)</span>
                                <?php endif; ?>
                            </td>
                            <td class="td-accion">
                                <button type="button" class="btn-eliminar-baja" data-id="<?php echo $u['id_usuario']; ?>">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>