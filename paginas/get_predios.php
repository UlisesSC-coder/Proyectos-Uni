<?php
require_once "conexion_hosting_ulises.php";

$id = $_GET['id'];

$sql = "SELECT numero, nombre, categoria, salario 
        FROM empleados
        WHERE departamento = '$id'";

$result = $conn->query($sql);
$empleados = $result->fetchAll();

if(count($empleados) > 0){

    echo "<option>-- Seleccione Empleado --</option>";

    foreach($empleados as $emp){

        echo "<option value='".$emp['numero']."'>";
        echo $emp['nombre']." | ".$emp['categoria']." | $".$emp['salario'];
        echo "</option>";

    }