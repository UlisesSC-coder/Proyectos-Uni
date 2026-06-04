<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['usuario_eliminado_datos'])) {
    header("Location: baja_usuario.php"); 
    exit();
}
$datosEliminados = $_SESSION['usuario_eliminado_datos'];
unset($_SESSION['usuario_eliminado_datos']); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baja Exitosa - Usuario</title>
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

    <div class="form-container-canva form-exito-baja">
        <div class="icono-exito-baja">🗑️</div>
        <h2 class="titulo-exito-baja">¡Cuenta de Usuario Eliminada Exitosamente!</h2>
        <p>A continuación se muestra el expediente histórico de las credenciales borradas del sistema:</p>
        <br>
        
        <div class="recibo-container recibo-baja">
            <p><strong>ID Usuario Eliminado:</strong> <span class="id-baja-destacado">#<?php echo htmlspecialchars($datosEliminados['id_usuario']); ?></span></p>
            <p><strong>Nombre de Usuario (Login):</strong> <?php echo htmlspecialchars($datosEliminados['usuario']); ?></p>
            <p><strong>Contraseña / Password Removido:</strong> <span class="texto-mono"><?php echo htmlspecialchars($datosEliminados['clave']); ?></span></p>
            <p><strong>Nivel de Privilegio que Tenía:</strong> <?php echo ($datosEliminados['tipousuario'] == '1') ? 'Administrador (Tipo 1)' : 'Operador/Becario (Tipo 2)'; ?></p>
        </div>
        <br>
        
        <a href="baja_usuario.php" class="btn-guardar-canva btn-regresar-baja">Regresar al Panel de Bajas</a>
    </div>

</body>
</html>