<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['usuario_editado'])) {
    header("Location: modificar_usuario.php"); 
    exit();
}
$datos = $_SESSION['usuario_editado'];
unset($_SESSION['usuario_editado']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización Exitosa</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
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

    <div class="tabla-container-canva" style="width: 90%; max-width: 700px; margin: 50px auto; background: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center;">
        <div style="font-size: 50px; color: #38a169; margin-bottom: 15px;">✔</div>
        <h2 style="color: #0e1217; margin-bottom: 10px;">¡Credenciales Actualizadas!</h2>
        <p style="color: #4a5568; margin-bottom: 30px;">Los cambios han sido guardados de manera exitosa en el servidor.</p>
        
        <div style="background-color: #f8f9fa; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; max-width: 500px; margin: 0 auto; text-align: left; line-height: 1.8;">
            <p><strong>ID de Cuenta:</strong> #<?php echo htmlspecialchars($datos['id_usuario'] ?? 'N/A'); ?></p>
            <p><strong>Nombre de Usuario (Login):</strong> <?php echo htmlspecialchars($datos['usuario'] ?? 'No definido'); ?></p>
            <p><strong>Clave / Password:</strong> <span style="font-family: monospace;"><?php echo htmlspecialchars($datos['clave'] ?? '••••••••'); ?></span></p>
            <p><strong>Nivel de Privilegio:</strong> <?php 
                $tipo = $datos['tipousuario'] ?? $datos['tipo_usuario'] ?? '';
                if ($tipo == '1') {
                    echo 'Administrador (Tipo 1)';
                } elseif ($tipo == '2') {
                    echo 'Operador/Becario (Tipo 2)';
                } else {
                    echo 'No especificado / Restringido';
                }
            ?></p>
        </div>
        <br><br>
        <a href="modificar_usuario.php" class="btn-guardar-canva" style="text-decoration: none; display: inline-block; width: auto; padding: 12px 30px; background: #00c4cc; color: white; border-radius: 6px; font-weight: 600;">Finalizar y Volver</a>
    </div>

</body>
</html>