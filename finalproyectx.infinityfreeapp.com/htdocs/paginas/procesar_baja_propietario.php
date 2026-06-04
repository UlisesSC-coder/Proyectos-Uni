<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php"); exit();
}
include("../conexion_hosting_ulises.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    try {
        // Verificar primero si el propietario tiene predios asociados para evitar violaciones de clave foránea
        $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM Predios WHERE id_propietario = :id");
        $stmtCheck->execute([':id' => $id]);
        if ($stmtCheck->fetchColumn() > 0) {
            echo "<script>alert('Error Restrictivo: No puedes eliminar este propietario debido a que tiene uno o más Predios enlazados. Elimina o reasigna los predios primero.'); window.location.href='baja_propietario.php';</script>";
            exit();
        }

        // Recuperar datos para la pantalla final
        $stmtSelect = $conn->prepare("SELECT * FROM Propietarios WHERE id_propietario = :id");
        $stmtSelect->execute([':id' => $id]);
        $propietarioBorrando = $stmtSelect->fetch(PDO::FETCH_ASSOC);

        if ($propietarioBorrando) {
            $stmtDelete = $conn->prepare("DELETE FROM Propietarios WHERE id_propietario = :id");
            $stmtDelete->execute([':id' => $id]);

            $_SESSION['propietario_eliminado_datos'] = $propietarioBorrando;
            header("Location: exito_baja_propietario.php"); exit();
        } else {
            echo "El propietario seleccionado no existe."; exit();
        }
    } catch (PDOException $e) {
        echo "Error crítico en base de datos: " . $e->getMessage(); exit();
    }
} else {
    header("Location: baja_propietario.php"); exit();
}
?>