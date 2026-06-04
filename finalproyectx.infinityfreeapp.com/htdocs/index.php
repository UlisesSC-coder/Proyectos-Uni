<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include("conexion_hosting_ulises.php");
$error = "";

$meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
$fecha_actual = date('d') . " de " . $meses[date('n') - 1] . " de " . date('Y');

if (isset($_GET['rastreo']) && $_GET['rastreo'] === 'bloqueado') {
    $error = "La sesion ha expirado";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $txt_usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $txt_clave   = isset($_POST['clave']) ? trim($_POST['clave']) : '';

    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND clave = :clave");
        $stmt->execute([
            ':usuario' => $txt_usuario,
            ':clave'   => $txt_clave
        ]);
        
        $datos_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($datos_usuario) {
            $_SESSION['id_usuario']     = $datos_usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $datos_usuario['usuario'];
            $_SESSION['tipo_usuario']   = $datos_usuario['tipousuario'];
            $_SESSION['autenticado']    = "SI";

            header("Location: paginas/menu.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        $error = "Error de base de datos: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Login</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body class="login-page">

    <div class="login-card">
        <h2>Sistema de Catastro</h2>
        <p>Inicia sesión para acceder</p>
        
        <img src="Imagenes/residencia.jpg" alt="Residencia" class="login-img">

        <?php if(!empty($error)): ?>
            <div class="alerta-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
            </div>

            <div class="form-group">
                <label for="clave">Contraseña:</label>
                <input type="password" id="clave" name="clave" placeholder="Ingresa tu contraseña" required>
            </div>

            <button type="submit" class="btn-primary">Ingresar al Sistema</button>
        </form>
    </div>

    <footer class="login-footer">
        Sistema de Catastro - Estatal<br>
        Guadalajara, Jalisco — <?php echo $fecha_actual; ?>
    </footer>

</body>
</html>
</html>