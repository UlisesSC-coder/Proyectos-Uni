<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); exit();
}
include("../conexion_hosting_ulises.php");

try {
    $stmt = $conn->query("SELECT * FROM Predios ORDER BY clave_castral ASC");
    $predios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catastro - Modificar Predio</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/validacion_editar_predio.js?v=<?php echo time(); ?>" defer></script>
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

    <div class="tabla-container-canva container-modificar-predio">
        <h2>Actualización de Predios</h2>
        <p>A continuación se muestran todos los datos registrados de los inmuebles. Selecciona el que deseas modificar haciendo clic en el botón de la última columna.</p>
        <br>
        <div class="table-responsive">
            <table class="tabla-resumen tabla-edicion">
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
                            <td class="td-clave-predio">#<?php echo $p['clave_castral']; ?></td>
                            <td class="td-id-prop-predio">#<?php echo $p['id_propietario']; ?></td>
                            <td><?php echo htmlspecialchars($p['tipo_propiedad']); ?></td>
                            <td class="texto-no-wrap"><?php echo htmlspecialchars($p['superficie_terreno']); ?> m²</td>
                            <td class="texto-no-wrap"><?php echo htmlspecialchars($p['superficie_construccion']); ?> m²</td>
                            <td class="td-valor-predio texto-no-wrap">$<?php echo number_format($p['valor_castral'], 2); ?></td>
                            <td class="celda-recortada" title="<?php echo htmlspecialchars($p['colindancias']); ?>">
                                <?php echo htmlspecialchars($p['colindancias']); ?>
                            </td>
                            <td class="celda-recortada-ancha" title="<?php echo htmlspecialchars($p['ubicacion_domicilio']); ?>">
                                <?php echo htmlspecialchars($p['ubicacion_domicilio']); ?>
                            </td>
                            <td>
                                <span class="badge-estatus-predio">
                                    <?php echo htmlspecialchars($p['estatus']); ?>
                                </span>
                            </td>
                            <td class="td-accion">
                                <button type="button" class="btn-editar-predio" data-clave="<?php echo $p['clave_castral']; ?>">Editar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>