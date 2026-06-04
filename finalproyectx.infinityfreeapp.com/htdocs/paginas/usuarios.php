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

// Conexión a la base de datos
include("../conexion_hosting_ulises.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Gestión de Usuarios</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
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
            <h1>Módulo de Seguridad y Usuarios</h1>
            <p>Selecciona la acción de control que deseas administrar en las cuentas del personal</p>
            <div class="user-badge-canva">
                Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></strong>
            </div>
        </header>

        <div class="mosaico-container-usuarios">
            
            <div class="tarjeta-usuario-item">
                <h2>Alta de Usuario</h2>
                <p>Registrar un nuevo operador en el sistema con sus credenciales de acceso correspondientes y asignación de rol.</p>
                <a href="alta_usuario.php" class="btn-tarjeta-accion">Abrir Formulario</a>
            </div>

            <div class="tarjeta-usuario-item">
                <h2>Ver Usuarios</h2>
                <p>Consulta general, visualización de contraseñas vigentes y desglose total de las cuentas dadas de alta.</p>
                <a href="consulta_usuarios.php" class="btn-tarjeta-accion">Ver Listado</a>
            </div>

            <div class="tarjeta-usuario-item">
                <h2>Buscar Usuario</h2>
                <p>Herramienta de localización específica mediante filtros interactivos para ubicar a un usuario de forma inmediata.</p>
                <a href="buscar_usuario.php" class="btn-tarjeta-accion">Iniciar Búsqueda</a>
            </div>

            <div class="tarjeta-usuario-item">
                <h2>Modificar Usuario</h2>
                <p>Actualizar nombres de cuentas (login), reasignar claves de acceso o modificar privilegios de un empleado.</p>
                <a href="modificar_usuario.php" class="btn-tarjeta-accion">Editar Datos</a> </div>

            <div class="tarjeta-usuario-item">
                <h2>Eliminar Usuario</h2>
                <p>Remover permanentemente los accesos y credenciales de un operador del padrón de control del sistema.</p>
                <a href="baja_usuario.php" class="btn-tarjeta-accion">Proceder a Baja</a> </div>

        </div> 
    </div>

</body>
</html>