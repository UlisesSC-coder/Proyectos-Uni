<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Candado de seguridad: si no está autenticado, se expulsa al login
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Gestión de Propietarios</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="dashboard-page">

    <nav class="nav-container-canva">
        <ul class="main-menu-canva">
            
            <li class="menu-item-canva">
                <a href="menu.php">Inicio</a>
            </li>

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
        <li><a href="consulta_usuarios.php">Ver Usuarios</a></li> </ul>
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
                    <li><a href="modificar_usuario.php">Modificar Usuario</a></li> </ul>
            </li>

            <li class="menu-item-canva">
                <a href="#">Bajas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="baja_propietario.php">Eliminar Propietario</a></li>
                    <li><a href="baja_predio.php">Eliminar Predio</a></li>
                    <li><a href="baja_usuario.php">Eliminar Usuario</a></li> </ul>
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

    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Módulo de Propietarios</h1>
            <p>Selecciona la acción catastral que deseas realizar sobre los titulares</p>
            <div class="user-badge-canva">
                Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></strong>
            </div>
        </header>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Alta de Propietario</h3>
                <p>Registrar un nuevo propietario con sus datos generales, RFC, CURP y teléfono en el sistema.</p>
                <a href="alta_propietario.php" class="btn-card">Abrir Formulario</a>
            </div>

            <div class="dashboard-card">
                <h3>Ver Padrón Completo</h3>
                <p>Consulta general y visualización detallada de la lista completa de propietarios dados de alta.</p>
                <a href="consulta_propietario.php" class="btn-card">Ver Listado</a>
            </div>

            <div class="dashboard-card">
                <h3>Buscar Propietario</h3>
                <p>Herramienta de búsqueda específica por filtros o ID para ubicar a un contribuyente rápidamente.</p>
                <a href="buscar_propietario.php" class="btn-card">Iniciar Búsqueda</a>
            </div>

            <div class="dashboard-card">
                <h3>Modificar Registro</h3>
                <p>Actualizar domicilios particulares, correcciones de nombres o cambios de datos de contacto.</p>
                <a href="modificar_propietario.php" class="btn-card">Editar Datos</a>
            </div>

            <div class="dashboard-card">
                <h3>Baja / Eliminación</h3>
                <p>Remover o suspender el registro de un propietario del padrón general del sistema.</p>
                <a href="baja_propietario.php" class="btn-card">Proceder a Baja</a>
            </div>
        </div>
    </div>

</body>
</html>