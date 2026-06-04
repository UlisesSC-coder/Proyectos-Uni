<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['propietario_editado'])) {
    header("Location: modificar_propietario.php"); 
    exit();
}
$datos = $_SESSION['propietario_editado'];
unset($_SESSION['propietario_editado']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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

    <div class="form-container-canva" style="margin-top: 40px; text-align: center;">
        <div style="font-size: 50px;">✨</div>
        <h2>¡Propietario Actualizado!</h2>
        <p>Los nuevos cambios se han guardado con éxito en la base de datos.</p>
        <br>
        <div class="recibo-container" style="text-align: left; background: #f8f9fa; padding: 20px; border-radius: 8px; max-width: 600px; margin: 0 auto; box-shadow: inset 0 0 8px rgba(0,0,0,0.02); line-height: 1.8;">
            <p><strong>ID Propietario:</strong> #<?php echo htmlspecialchars($datos['id_propietario'] ?? 'N/A'); ?></p>
            <p><strong>Nombre Completo:</strong> <?php 
                $nombreCompleto = trim(($datos['nombre'] ?? '') . ' ' . ($datos['apellido_paterno'] ?? '') . ' ' . ($datos['apellido_materno'] ?? ''));
                echo htmlspecialchars(!empty($nombreCompleto) ? $nombreCompleto : 'No registrado'); 
            ?></p>
            <p><strong>RFC:</strong> <?php echo htmlspecialchars($datos['rfc'] ?? 'No registrado'); ?></p>
            <p><strong>CURP:</strong> <?php echo htmlspecialchars($datos['curp'] ?? 'No registrado'); ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?php echo !empty($datos['fecha_nacimiento']) ? htmlspecialchars($datos['fecha_nacimiento']) : 'No registrado'; ?></p>
            <p><strong>Domicilio:</strong> <?php echo htmlspecialchars($datos['domicilio'] ?? 'No registrado'); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($datos['telefono'] ?? 'No registrado'); ?></p>
            <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($datos['correo_electronico'] ?? 'No registrado'); ?></p>
        </div>
        <br>
        <a href="modificar_propietario.php" class="btn-guardar-canva" style="text-decoration:none; display:inline-block; background:#00c4cc; width: auto; padding: 12px 30px;">Regresar al Panel</a>
    </div>
</body>
</html>