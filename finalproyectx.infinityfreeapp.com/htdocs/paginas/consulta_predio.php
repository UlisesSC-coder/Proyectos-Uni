<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}

include("../conexion_hosting_ulises.php");

try {
    $sql = "SELECT clave_castral, id_propietario, tipo_propiedad, superficie_terreno, superficie_construccion, colindancias, estatus, valor_castral, ubicacion_domicilio FROM Predios ORDER BY clave_castral ASC";
    $stmt = $conn->query($sql);
    $predios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Ver Predios</title>
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

    <div class="tabla-container-canva">
        <h2>Inventario de Predios</h2>
        <p>Registro general de las propiedades inmuebles incorporadas a la cartografía del sistema catastral.</p>

        <div class="table-responsive">
            <table class="tabla-resumen tabla-padron">
                <thead>
                    <tr>
                        <th>Clave Catastral</th>
                        <th>ID Propietario</th>
                        <th>Tipo Propiedad</th>
                        <th>Sup. Terreno</th>
                        <th>Sup. Construcción</th>
                        <th>Colindancias</th>
                        <th>Estatus</th>
                        <th>Valor Catastral</th>
                        <th>Ubicación / Domicilio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($predios) > 0): ?>
                        <?php foreach ($predios as $p): ?>
                            <tr>
                                <td class="td-id">#<?php echo $p['clave_castral']; ?></td>
                                <td class="td-id-prop">#<?php echo $p['id_propietario']; ?></td>
                                <td class="td-nombre"><?php echo htmlspecialchars($p['tipo_propiedad']); ?></td>
                                <td><?php echo htmlspecialchars($p['superficie_terreno']); ?> m²</td>
                                <td><?php echo htmlspecialchars($p['superficie_construccion']); ?> m²</td>
                                <td><?php echo htmlspecialchars($p['colindancias']); ?></td>
                                <td>
                                    <span class="badge-estatus">
                                        <?php echo htmlspecialchars($p['estatus']); ?>
                                    </span>
                                </td>
                                <td class="td-valor">$<?php echo number_format($p['valor_castral'], 2); ?></td>
                                <td><?php echo htmlspecialchars($p['ubicacion_domicilio']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="td-empty">No hay predios registrados en el sistema.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>