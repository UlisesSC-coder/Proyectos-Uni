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
    <title>Catastro - Gestión de Predios</title>
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
            <h1>Módulo de Predios</h1>
            <p>Selecciona la acción catastral que deseas realizar sobre los inmuebles</p>
            <div class="user-badge-canva">
                Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></strong>
            </div>
        </header>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Alta de Predio</h3>
                <p>Vincular una nueva clave catastral asignándole superficies, valores comerciales y un propietario.</p>
                <a href="alta_predio.php" class="btn-card">Abrir Formulario</a>
            </div>

            <div class="dashboard-card">
                <h3>Ver Predios</h3>
                <p>Consulta general del inventario, tipos de propiedad, colindancias y estados financieros de los bienes.</p>
                <a href="consulta_predio.php" class="btn-card">Ver Listado</a>
            </div>

            <div class="dashboard-card">
                <h3>Buscar Predio</h3>
                <p>Localizar cuentas inmobiliarias específicas mediante el número de clave catastral asignada.</p>
                <a href="buscar_predio.php" class="btn-card">Iniciar Búsqueda</a>
            </div>

            <div class="dashboard-card">
                <h3>Modificar Predio</h3>
                <p>Actualizar valores catastrales, rectificación de superficies de construcción o cambios de ubicación.</p>
                <a href="modificar_predio.php" class="btn-card">Editar Datos</a>
            </div>

            <div class="dashboard-card">
                <h3>Eliminar Predio</h3>
                <p>Dar de baja una clave catastral o remover propiedades duplicadas del inventario general.</p>
                <a href="baja_predio.php" class="btn-card">Proceder a Baja</a>
            </div>
        </div>
    </div>

</body>
</html>