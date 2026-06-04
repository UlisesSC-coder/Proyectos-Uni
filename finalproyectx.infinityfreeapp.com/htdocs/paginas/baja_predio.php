<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); 
    exit();
}
include("../conexion_hosting_ulises.php");

try {
    $stmt = $conn->query("SELECT * FROM Predios ORDER BY clave_castral ASC");
    $predios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catastro - Eliminar Predio</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/confirmar_baja_predio.js?v=<?php echo time(); ?>" defer></script>
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

    <div class="tabla-container-canva container-bajas">
        <h2>Baja de Registro de Predios</h2>
        <p class="texto-advertencia">⚠️ Advertencia: Al presionar "Eliminar" e confirmar la acción, la Ficha Catastral será purgada definitivamente del sistema.</p>
        <br>
        <div class="table-responsive">
            <table class="tabla-resumen tabla-bajas">
                <thead>
                    <tr>
                        <th>Clave Catastral</th>
                        <th>ID Prop.</th>
                        <th>Tipo Propiedad</th>
                        <th>Sup. Terreno</th>
                        <th>Sup. Const.</th>
                        <th>Valor Catastral</th>
                        <th>Colindancias</th>
                        <th>Ubicación / Domicilio</th>
                        <th>Estatus</th>
                        <th class="th-accion">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($predios as $p): ?>
                        <tr>
                            <td class="td-clave-baja">#<?php echo $p['clave_castral']; ?></td>
                            <td class="td-id-prop-baja">#<?php echo $p['id_propietario']; ?></td>
                            <td><?php echo htmlspecialchars($p['tipo_propiedad']); ?></td>
                            <td class="td-nowrap"><?php echo htmlspecialchars($p['superficie_terreno']); ?> m²</td>
                            <td class="td-nowrap"><?php echo htmlspecialchars($p['superficie_construccion']); ?> m²</td>
                            <td class="td-valor-baja">$<?php echo number_format($p['valor_castral'], 2); ?></td>
                            <td class="td-ellipsis colindancias-width" title="<?php echo htmlspecialchars($p['colindancias']); ?>">
                                <?php echo htmlspecialchars($p['colindancias']); ?>
                            </td>
                            <td class="td-ellipsis ubicacion-width" title="<?php echo htmlspecialchars($p['ubicacion_domicilio']); ?>">
                                <?php echo htmlspecialchars($p['ubicacion_domicilio']); ?>
                            </td>
                            <td>
                                <span class="badge-estatus-baja">
                                    <?php echo htmlspecialchars($p['estatus']); ?>
                                </span>
                            </td>
                            <td class="td-accion">
                                <button type="button" class="btn-eliminar-baja" data-clave="<?php echo $p['clave_castral']; ?>">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>