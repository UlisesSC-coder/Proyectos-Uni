<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}

include("../conexion_hosting_ulises.php");

if (isset($_GET['clave']) && !empty(trim($_GET['clave']))) {
    $clave_eliminar = trim($_GET['clave']);

    try {
        // 1. RESPALDAR: Buscar los datos del predio antes de borrarlo
        $sql_select = "SELECT * FROM Predios WHERE clave_castral = :clave";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bindParam(':clave', $clave_eliminar, PDO::PARAM_STR);
        $stmt_select->execute();
        $predio_respaldo = $stmt_select->fetch(PDO::FETCH_ASSOC);

        if ($predio_respaldo) {
            // Guardar en la sesión para mostrarlo en la página de éxito
            $_SESSION['predio_eliminado'] = $predio_respaldo;

            // 2. ELIMINAR: Purgar el registro definitivamente
            $sql_delete = "DELETE FROM Predios WHERE clave_castral = :clave";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bindParam(':clave', $clave_eliminar, PDO::PARAM_STR);

            if ($stmt_delete->execute()) {
                // Redirigir a la nueva página de confirmación de baja
                header("Location: exito_baja_predio.php");
                exit();
            } else {
                echo "Error interno: No se pudo completar la eliminación en el servidor.";
            }
        } else {
            echo "Error: El predio ya no existe o la clave es incorrecta.";
        }
    } catch (PDOException $e) {
        echo "Error crítico en la base de datos: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: baja_predio.php");
    exit();
}
?>