<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['predio_editado'])) {
    header("Location: modificar_predio.php"); 
    exit();
}
$datos = $_SESSION['predio_editado'];
unset($_SESSION['predio_editado']);
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
        <div style="font-size: 50px;">🏢</div>
        <h2>¡Ficha Catastral Actualizada!</h2>
        <p>Los datos cartográficos del predio se guardaron correctamente en la base de datos.</p>
        <br>
        <div class="recibo-container" style="text-align: left; background: #f8f9fa; padding: 20px; border-radius: 8px; max-width: 600px; margin: 0 auto; box-shadow: inset 0 0 8px rgba(0,0,0,0.02); line-height: 1.8;">
            <p><strong>Clave Catastral:</strong> #<?php echo htmlspecialchars($datos['clave_castral'] ?? $datos['clave_catastral'] ?? 'N/A'); ?></p>
            <p><strong>Propietario Asignado:</strong> ID #<?php echo htmlspecialchars($datos['id_propietario'] ?? 'N/A'); ?> - <?php echo htmlspecialchars($datos['nombre_propietario'] ?? 'Sin nombre asignado'); ?></p>
            <p><strong>Tipo de Propiedad:</strong> <?php echo htmlspecialchars($datos['tipo_propiedad'] ?? 'N/A'); ?></p>
            <p><strong>Estatus del Inmueble:</strong> <?php echo htmlspecialchars($datos['estatus'] ?? 'N/A'); ?></p>
            <p><strong>Superficie Terreno:</strong> <?php echo htmlspecialchars($datos['superficie_terreno'] ?? '0'); ?> m²</p>
            <p><strong>Superficie Construcción:</strong> <?php echo htmlspecialchars($datos['superficie_construccion'] ?? '0'); ?> m²</p>
            <p><strong>Valor Catastral Evaluado:</strong> $<?php echo number_format(floatval($datos['valor_castral'] ?? $datos['valor_catastral'] ?? 0), 2); ?></p>
            <p><strong>Colindancias Registradas:</strong> <?php echo htmlspecialchars($datos['colindancias'] ?? 'Ninguna'); ?></p>
            <p><strong>Ubicación / Domicilio del Predio:</strong> <?php echo htmlspecialchars($datos['ubicacion_domicilio'] ?? 'No especificado'); ?></p>
        </div>
        <br>
        <a href="modificar_predio.php" class="btn-guardar-canva" style="text-decoration:none; display:inline-block; background:#00c4cc; width: auto; padding: 12px 30px;">Regresar al Panel</a>
    </div>
</body>
</html>