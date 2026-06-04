<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}

// Verificar si existen datos del predio eliminado en la sesión
if (!isset($_SESSION['predio_eliminado'])) {
    header("Location: baja_predio.php");
    exit();
}

$p = $_SESSION['predio_eliminado'];

// Limpiar la variable de sesión para que no se quede guardada indefinidamente
unset($_SESSION['predio_eliminado']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catastro - Eliminación Exitosa</title>
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

    <div class="form-container-canva" style="max-width: 700px; margin-top: 30px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <span style="font-size: 50px;">🗑️</span>
            <h2 style="color: #e74c3c; margin-top: 10px;">Registro Eliminado Exitosamente</h2>
            <p>La Ficha Catastral detallada a continuación ha sido completamente purgada del sistema.</p>
        </div>

        <div style="background-color: #fdf2f2; border: 1px solid #f5c6cb; padding: 20px; border-radius: 6px;">
            <h3 style="color: #721c24; border-bottom: 2px solid #f5c6cb; padding-bottom: 8px; margin-top: 0;">
                Resumen del Predio Purgado
            </h3>
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 14px;">
                <tr>
                    <td style="padding: 8px; font-weight: bold; width: 35%; border-bottom: 1px solid #eaeded;">Clave Catastral:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded; color: #c0392b; font-weight: bold;">#<?php echo htmlspecialchars($p['clave_castral']); ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #eaeded;">ID Propietario asignado:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded;">#<?php echo htmlspecialchars($p['id_propietario']); ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #eaeded;">Tipo de Propiedad:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded;"><?php echo htmlspecialchars($p['tipo_propiedad']); ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #eaeded;">Superficie Terreno:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded;"><?php echo htmlspecialchars($p['superficie_terreno']); ?> m²</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #eaeded;">Superficie Construcción:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded;"><?php echo htmlspecialchars($p['superficie_construccion']); ?> m²</td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #eaeded;">Valor Catastral Histórico:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded; font-weight: bold;">$<?php echo number_format($p['valor_castral'], 2); ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #eaeded;">Colindancias registradas:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded; font-style: italic;"><?php echo htmlspecialchars($p['colindancias']); ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #eaeded;">Ubicación / Domicilio:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded;"><?php echo htmlspecialchars($p['ubicacion_domicilio']); ?></td>
                </tr>
                <tr>
                    <td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #eaeded;">Estatus al dar de baja:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eaeded;"><span style="background: #e74c3c; color: #fff; padding: 2px 6px; border-radius: 4px; font-size: 12px;"><?php echo htmlspecialchars($p['estatus']); ?></span></td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="baja_predio.php" class="btn-guardar-canva" style="background-color: #34495e; text-decoration: none; padding: 10px 20px; display: inline-block;">
                Volver al Panel de Bajas
            </a>
        </div>
    </div>

</body>
</html>