<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); exit();
}
include("../conexion_hosting_ulises.php");

try {
    $stmt = $conn->query("SELECT * FROM Propietarios ORDER BY id_propietario ASC");
    $propietarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catastro - Modificar Propietario</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/validacion_editar_propietario.js?v=<?php echo time(); ?>" defer></script>
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
            <li class="menu-item-canva"><a href="../index.php" class="btn-salir-canva">Salir</a></li>
        </ul>
    </nav>

    <div class="tabla-container-canva container-modificar-prop">
        <h2>Actualización de Propietarios</h2>
        <p>A continuación se muestran todos los datos registrados de los contribuyentes. Selecciona el registro que deseas modificar haciendo clic en el botón de la última columna.</p>
        <br>
        <div class="table-responsive">
            <table class="tabla-resumen tabla-edicion">
                <thead>
                    <tr>
                        <th>ID Padrón</th>
                        <th>Nombre Completo</th>
                        <th>RFC</th>
                        <th>CURP</th>
                        <th>Domicilio Particular</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th class="th-accion">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($propietarios as $p): ?>
                        <tr>
                            <td class="td-id-prop">#<?php echo $p['id_propietario']; ?></td>
                            <td class="td-nombre-prop">
                                <?php echo htmlspecialchars($p['nombre'] . ' ' . $p['apellido_paterno'] . ' ' . $p['apellido_materno']); ?>
                            </td>
                            <td class="td-codigo-prop">
                                <span class="badge-codigo-prop"><?php echo htmlspecialchars($p['rfc']); ?></span>
                            </td>
                            <td class="td-codigo-prop">
                                <span class="badge-codigo-prop"><?php echo htmlspecialchars($p['curp']); ?></span>
                            </td>
                            <td class="celda-recortada-prop" title="<?php echo htmlspecialchars($p['domicilio']); ?>">
                                <?php echo htmlspecialchars($p['domicilio']); ?>
                            </td>
                            <td class="texto-no-wrap"><?php echo htmlspecialchars($p['telefono']); ?></td>
                            <td class="celda-recortada-email" title="<?php echo htmlspecialchars($p['correo_electronico']); ?>">
                                <?php echo htmlspecialchars($p['correo_electronico']); ?>
                            </td>
                            <td class="td-accion">
                                <button type="button" class="btn-editar-prop" data-id="<?php echo $p['id_propietario']; ?>">Editar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>