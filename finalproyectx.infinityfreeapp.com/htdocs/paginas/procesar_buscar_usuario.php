<?php
session_start();
// Validación rápida de sesión
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    exit("Acceso denegado");
}

// Verificar que llegó el parámetro de búsqueda
if (isset($_GET['q'])) {
    include("../conexion_hosting_ulises.php");
    
    $buscar = trim($_GET['q']);
    
    try {
        // Se busca concordancia por id_usuario o por la columna usuario
        $sql = "SELECT id_usuario, usuario, clave, tipousuario 
                FROM usuarios 
                WHERE id_usuario LIKE :query OR usuario LIKE :query 
                ORDER BY usuario ASC";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute(['query' => '%' . $buscar . '%']);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($usuarios) > 0) {
            foreach ($usuarios as $u) {
                echo "<tr style='border-bottom: 1px solid #edf2f7; transition: background 0.2s;' onmouseover=\"this.style.backgroundColor='#f7fafc'\" onmouseout=\"this.style.backgroundColor='transparent'\">";
                echo "<td style='padding: 14px; font-weight: bold; color: #00c4cc;'>#" . htmlspecialchars($u['id_usuario']) . "</td>";
                echo "<td style='padding: 14px; color: #0e1217; font-weight: bold;'>" . htmlspecialchars($u['usuario']) . "</td>";
                echo "<td style='padding: 14px; color: #4a5568; font-family: monospace; font-size: 0.95rem;'>" . htmlspecialchars($u['clave']) . "</td>";
                echo "<td style='padding: 14px; color: #4a5568;'>";
                
                if ($u['tipousuario'] == '1') {
                    echo "<span style='padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 600; background-color: #e6fffa; color: #00a3a4;'>Administrador (Tipo 1)</span>";
                } else {
                    echo "<span style='padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 600; background-color: #edf2f7; color: #4a5568;'>Operador/Becario (Tipo 2)</span>";
                }
                
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='padding: 30px; text-align: center; color: #a0aec0;'>No se encontraron usuarios que coincidan con la búsqueda.</td></tr>";
        }
        
    } catch (PDOException $e) {
        echo "<tr><td colspan='4' style='padding: 20px; text-align: center; color: #e53e3e;'>Error al procesar la búsqueda.</td></tr>";
    }
}
?>