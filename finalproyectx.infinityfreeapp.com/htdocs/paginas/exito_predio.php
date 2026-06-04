<?php
session_start();

// Candado de seguridad
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['ultimo_predio'])) {
    header("Location: alta_predio.php");
    exit();
}

$datos = $_SESSION['ultimo_predio'];

// Limpieza de la variable temporal para evitar duplicaciones al recargar la página
unset($_SESSION['ultimo_predio']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Predio Registrado</title>
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

            <li class="menu-item-canva">
                <a href="../index.php" class="btn-salir-canva">Salir</a>
            </li>
        </ul>
    </nav>

    <div class="form-container-canva">
        <div class="exito-icono-contenedor">
            <span class="exito-icono">🏢</span>
        </div>
        
        <h2 class="exito-titulo">¡Predio Registrado con Éxito!</h2>
        <p class="exito-subtitulo">El inmueble ha sido incorporado correctamente a la cartografía del sistema catastral.</p>

        <div class="recibo-container">
            <div class="recibo-encabezado">
                <h3 class="recibo-titulo-seccion">Resumen de la Ficha Catastral</h3>
                <div class="recibo-badge-contenedor">
                    <span class="recibo-id-texto">CLAVE:</span>
                    <span class="badge-id">#<?php echo htmlspecialchars($datos['clave_catastral'] ?? $datos['clave_castral'] ?? 'N/A'); ?></span>
                </div>
            </div>

            <table class="tabla-resumen">
                <tr>
                    <td><strong>ID Propietario Asignado:</strong></td>
                    <td>#<?php echo htmlspecialchars($datos['id_propietario'] ?? 'N/A'); ?></td>
                </tr>
                <tr>
                    <td><strong>Tipo de Propiedad:</strong></td>
                    <td><?php echo htmlspecialchars($datos['tipo_propiedad'] ?? 'N/A'); ?></td>
                </tr>
                <tr>
                    <td><strong>Estatus del Inmueble:</strong></td>
                    <td><?php echo htmlspecialchars($datos['estatus'] ?? 'N/A'); ?></td>
                </tr>
                <tr>
                    <td><strong>Superficie del Terreno:</strong></td>
                    <td><?php echo htmlspecialchars($datos['superficie_terreno'] ?? '0'); ?> m²</td>
                </tr>
                <tr>
                    <td><strong>Superficie Construida:</strong></td>
                    <td><?php echo htmlspecialchars($datos['superficie_construction'] ?? $datos['superficie_construccion'] ?? '0'); ?> m²</td>
                </tr>
                <tr>
                    <td><strong>Valor Catastral Evaluado:</strong></td>
                    <td>$<?php echo number_format($datos['valor_catastral'] ?? $datos['valor_castral'] ?? 0, 2); ?></td>
                </tr>
                <tr>
                    <td><strong>Colindancias del Predio:</strong></td>
                    <td><?php echo htmlspecialchars($datos['colindancias'] ?? 'Ninguna'); ?></td>
                </tr>
                <tr>
                    <td><strong>Ubicación / Domicilio:</strong></td>
                    <td><?php echo htmlspecialchars($datos['ubicacion_domicilio'] ?? 'No especificado'); ?></td>
                </tr>
            </table>
        </div>

        <div class="recibo-botonera">
            <a href="alta_predio.php" class="btn-accion-recibo">Registrar Nuevo Predio</a>
        </div>
    </div>

</body>
</html>