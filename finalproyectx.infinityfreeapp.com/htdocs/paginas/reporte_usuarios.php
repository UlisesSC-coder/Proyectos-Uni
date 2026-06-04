<?php
ob_start();
session_start();

// 1. Control de seguridad idéntico al de propietarios
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); 
    exit();
}

include("../conexion_hosting_ulises.php");

// 2. Carga segura de FPDF
if (file_exists('fpdf.php')) {
    require('fpdf.php');
} else {
    require('../fpdf/fpdf.php');
}

// 3. Estructura y maquetación de la clase PDF
class PDF_Usuarios extends FPDF {
    function Header() {
        // Línea azul superior decorativa
        $this->SetDrawColor(27, 54, 93);
        $this->SetLineWidth(0.8);
        $this->Line(10, 28, 269, 28);
        
        // Título del Sistema
        $this->SetFont('Arial', 'B', 15);
        $this->SetTextColor(27, 54, 93);
        $this->Cell(180, 8, utf8_decode('SISTEMA DE CATASTRO MUNICIPAL'), 0, 0, 'L');
        
        // Fecha de Emisión dinámica
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(79, 8, utf8_decode('Fecha de Emisión: ') . date('d/m/Y'), 0, 1, 'R');
        
        // Subtítulo del Reporte
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(70, 80, 95);
        $this->Cell(0, 6, utf8_decode('PADRÓN GENERAL DE USUARIOS Y CREDENCIALES DEL SISTEMA'), 0, 1, 'L');
        $this->Ln(6);
        
        // Estilos para los encabezados de la tabla (Azul institucional)
        $this->SetFillColor(27, 54, 93); 
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(27, 54, 93);
        $this->SetLineWidth(0.2);
        $this->SetFont('Arial', 'B', 10);
        
        // Celdas del encabezado (Ajustadas a los 259mm disponibles en Horizontal)
        $this->Cell(25, 8, 'ID Usuario', 1, 0, 'C', true);
        $this->Cell(94, 8, 'Nombre de Usuario (Login)', 1, 0, 'L', true);
        $this->Cell(80, 8, 'Contrasena / Password', 1, 0, 'L', true);
        $this->Cell(60, 8, 'Rol / Nivel de Acceso', 1, 1, 'C', true);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetDrawColor(200, 200, 200);
        $this->SetLineWidth(0.2);
        $this->Line(10, $this->GetY(), 269, $this->GetY());
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(120, 120, 120);
        $this->Cell(130, 10, utf8_decode('Padrón confidencial protegido por leyes de seguridad informática interna.'), 0, 0, 'L');
        $this->Cell(129, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
    }
}

// 4. Consulta a la Base de Datos
try {
    $stmt = $conn->query("SELECT id_usuario, usuario, clave, tipousuario FROM usuarios ORDER BY id_usuario ASC");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) { 
    ob_end_clean();
    die("Error en base de datos: " . $e->getMessage()); 
}

// 5. Configuración del documento en formato Horizontal ('L')
$pdf = new PDF_Usuarios('L', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

$fill = false; // Control de celdas intercaladas

// 6. Volcado de datos de usuarios
foreach ($usuarios as $u) {
    $pdf->SetFillColor(245, 247, 250);
    $pdf->SetTextColor(30, 30, 30);
    $pdf->SetDrawColor(220, 224, 230);
    
    // Sanitización e iconv para no romper el PDF si hay acentos o caracteres extraños
    $usuario_limpio = iconv('UTF-8', 'windows-1252//IGNORE', $u['usuario']);
    $clave_limpia = iconv('UTF-8', 'windows-1252//IGNORE', $u['clave']);
    
    // Evaluamos el rol del usuario para pintarlo de manera clara
    if ($u['tipousuario'] == '1') {
        $rol = 'Administrador (Tipo 1)';
    } elseif ($u['tipousuario'] == '2') {
        $rol = 'Operador/Becario (Tipo 2)';
    } else {
        $rol = 'No Asignado (' . $u['tipousuario'] . ')';
    }
    $rol_limpio = iconv('UTF-8', 'windows-1252//IGNORE', $rol);
    
    // Renderizado de las filas
    $pdf->Cell(25, 7.5, '#' . $u['id_usuario'], 'B', 0, 'C', $fill);
    $pdf->Cell(94, 7.5, $usuario_limpio, 'B', 0, 'L', $fill);
    $pdf->Cell(80, 7.5, $clave_limpia, 'B', 0, 'L', $fill);
    $pdf->Cell(60, 7.5, $rol_limpio, 'B', 1, 'C', $fill);
    
    $fill = !$fill; // Intercala el color de la fila
}

// 7. Salida limpia del PDF al navegador
ob_end_clean();
$pdf->Output('I', 'Reporte_Usuarios.pdf');
?>