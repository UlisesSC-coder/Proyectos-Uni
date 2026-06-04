<?php
session_start();
$usuario = $_POST['user'];
$password = $_POST['pass'];

// Aquí pones un usuario y contraseña de prueba
if ($usuario == "admin" && $password == "1234") {
    $_SESSION["validado"] = "true"; // ¡Aquí se crea la llave!
    header("Location: index_mantenimiento_ulises.php"); // Te manda al panel
} else {
    header("Location: ../index_login2.php?error=1");
}
?>