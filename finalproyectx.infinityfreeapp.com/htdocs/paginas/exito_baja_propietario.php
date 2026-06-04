<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['propietario_eliminado_datos'])) {
    header("Location: baja_propietario.php"); exit();
}
$datos = $_SESSION['propietario_eliminado_datos'];
unset($_SESSION['propietario_eliminado_datos']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Baja Exitosa - Propietario</title>
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
        <div class="icono-exito-baja">👤🗑️</div>
        <h2 class="titulo-exito-baja">¡Contribuyente Dado de Baja del Sistema!</h2>
        <p>Los datos correspondientes al propietario han sido borrados de los registros activos:</p>
        <br>
        
        <div class="recibo-container recibo-baja">
            <p><strong>ID Propietario Removido:</strong> <span class="id-baja-destacado">#<?php echo htmlspecialchars($datos['id_propietario']); ?></span></p>
            <p><strong>Nombre Completo:</strong> <?php echo htmlspecialchars($datos['nombre'] . ' ' . $datos['apellido_paterno'] . ' ' . $datos['apellido_materno']); ?></p>
            <p><strong>RFC Registrado:</strong> <span class="texto-mono"><?php echo htmlspecialchars($datos['rfc']); ?></span></p>
            <p><strong>CURP Registrada:</strong> <span class="texto-mono"><?php echo htmlspecialchars($datos['curp']); ?></span></p>
            <p><strong>Domicilio Particular Histórico:</strong> <?php echo htmlspecialchars($datos['domicilio']); ?></p>
            <p><strong>Teléfono de Contacto:</strong> <?php echo htmlspecialchars($datos['telefono']); ?></p>
            <p><strong>Correo Electrónico Eliminado:</strong> <?php echo htmlspecialchars($datos['correo_electronico']); ?></p>
            <p><strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($datos['fecha_nacimiento']); ?></p>
        </div>
        <br>
        
        <a href="baja_propietario.php" class="btn-guardar-canva btn-regresar-baja">Regresar al Panel de Bajas</a>
    </div>

</body>
</html>