<?php
require_once "conexion_hosting_ulises.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "SELECT numero, nombre, categoria, salario 
                FROM empleados 
                WHERE departamento = :departamento";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':departamento', $id);
        $stmt->execute();

        $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($empleados) > 0) {
            echo "<option value=''>-- Seleccione un empleado --</option>";
            foreach ($empleados as $emp) {
                echo "<option value='".$emp['numero']."'>";
                echo $emp['nombre']." - ".$emp['categoria']." - $".$emp['salario'];
                echo "</option>";
            }
        } else {
            echo "<option value=''>No hay empleados en este departamento</option>";
        }
    } catch (PDOException $e) {
        echo "<option value=''>Error en la consulta</option>";
    }
} else {
    echo "<option value=''>Seleccione un departamento válido</option>";
}
?>