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
    $sql = "SELECT id_propietario, nombre, apellido_paterno, apellido_materno, rfc, fecha_registro, curp, domicilio, telefono, correo_electronico, fecha_nacimiento FROM Propietarios ORDER BY id_propietario ASC";
    $stmt = $conn->query($sql);
    $propietarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Catastro - Ver Propietarios</title>
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
        <h2>Padrón de Propietarios</h2>
        <p>Lista oficial de todos los titulares de cuentas catastrales registrados en el sistema.</p>

        <div class="table-responsive">
            <table class="tabla-resumen tabla-padron">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>RFC</th>
                        <th>CURP</th>
                        <th>Domicilio Particular</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>F. Nacimiento</th>
                        <th>F. Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($propietarios) > 0): ?>
                        <?php foreach ($propietarios as $p): ?>
                            <tr>
                                <td class="td-id">#<?php echo $p['id_propietario']; ?></td>
                                <td class="td-nombre"><?php echo htmlspecialchars($p['nombre'] . ' ' . $p['apellido_paterno'] . ' ' . $p['apellido_materno']); ?></td>
                                <td class="td-mono"><?php echo htmlspecialchars($p['rfc']); ?></td>
                                <td class="td-mono"><?php echo htmlspecialchars($p['curp']); ?></td>
                                <td><?php echo htmlspecialchars($p['domicilio']); ?></td>
                                <td><?php echo htmlspecialchars($p['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($p['correo_electronico']); ?></td>
                                <td class="td-nowrap"><?php echo htmlspecialchars($p['fecha_nacimiento']); ?></td>
                                <td class="td-nowrap"><?php echo htmlspecialchars($p['fecha_registro']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="td-empty">No hay propietarios registrados en el sistema.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>