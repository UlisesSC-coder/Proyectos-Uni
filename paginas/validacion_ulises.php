<?php
// Paso 3: Script de validación con conexión real a Base de Datos
session_start();

// 1. Mandar llamar la conexión exacta de tu hosting
require_once("conexion_hosting_ulises.php"); 

// 2. Recuperar datos mediante $_POST
$usuario = $_POST['user'] ?? '';
$password = $_POST['pass'] ?? '';

try {
    // 3. Realizar consulta SQL buscando que coincida usuario y clave numérico (int)
    // Usamos marcadores de posición para evitar inyecciones SQL
    $sql = "SELECT * FROM usuarios WHERE usuario = :user AND clave = :pass";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':user' => $usuario,
        ':pass' => $password
    ]);
    
    // Obtener el registro si es que existe
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    // 4. Detectar si existe un registro con la información
    if ($registro) {
        // SI EXISTE: Generar sesión 'validado' en true
        $_SESSION["validado"] = "true";
        $_SESSION["id_usuario"] = $registro['id_usuario']; // Opcional, guarda el ID
        $_SESSION["tipousuario"] = $registro['tipousuario']; // Opcional, guarda el rol (1 o 2)

        // Cerrar la conexión (en PDO asignar null la cierra)
        $conn = null;

        // Redireccionar a menu_principal.php que está dentro de la subcarpeta /paginas
        header("Location: paginas/menu_principal.php");
        exit;
        
    } else {
        // NO EXISTE: Cerrar la conexión y mandar de vuelta al login donde se destruyen sesiones
        $conn = null;
        header("Location: login_ulises.php?error=datos_incorrectos");
        exit;
    }

} catch(PDOException $e) {
    // Si hay un error de conexión o sintaxis en el Query
    $conn = null;
    header("Location: login_ulises.php?error=db_fail");
    exit;
}
?>