<?php
$servidor = "localhost";
$usuario = "root"; 
$password = "AGENTElol008";     
$base_datos = "if0_40967812_empleados";

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>