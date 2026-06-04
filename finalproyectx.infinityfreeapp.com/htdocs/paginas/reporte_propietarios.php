<?php
ob_start();
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); 
    exit();
}

include("../conexion_hosting_ulises.php");

// Cargamos FPDF idéntico a tu reporte_historial que sí funciona
if (file_exists('fpdf.php')) {
    require('fpdf.php');
} else {
    require('../fpdf/fpdf.php');
}

class PDF_Propietarios extends FPDF {
    function Header() {
        $this->SetDrawColor(27, 54, 93);
        $this->SetLineWidth(0.8);
        $this->Line(10, 28, 269, 28);
        
        $this->SetFont('Arial', 'B', 15);
        $this->SetTextColor(27, 54, 93);
        $this->Cell(180, 8, utf8_decode('SISTEMA DE CATASTRO MUNICIPAL'), 0, 0, 'L');
        
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(79, 8, utf8_decode('Fecha de Emisión: ') . date('d/m/Y'), 0, 1, 'R');
        
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(70, 80, 95);
        $this->Cell(0, 6, utf8_decode('PADRÓN GENERAL DE PROPIETARIOS REGISTRADOS'), 0, 1, 'L');
        $this->Ln(6);
        
        $this->SetFillColor(27, 54, 93); 
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(27, 54, 93);
        $this->SetLineWidth(0.2);
        $this->SetFont('Arial', 'B', 9);
        
        $this->Cell(15, 8, 'ID', 1, 0, 'C', true);
        $this->Cell(60, 8, 'Nombre Completo', 1, 0, 'L', true);
        $this->Cell(32, 8, 'RFC', 1, 0, 'C', true);
        $this->Cell(42, 8, 'CURP', 1, 0, 'C', true);
        $this->Cell(60, 8, 'Domicilio Particular', 1, 0, 'L', true);
        $this->Cell(25, 8, utf8_decode('Teléfono'), 1, 0, 'C', true);
        $this->Cell(25, 8, 'F. Nacimiento', 1, 1, 'C', true);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetDrawColor(200, 200, 200);
        $this->SetLineWidth(0.2);
        $this->Line(10, $this->GetY(), 269, $this->GetY());
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(120, 120, 120);
        $this->Cell(130, 10, utf8_decode('Padrón confidencial protegido por leyes de privacidad estatal.'), 0, 0, 'L');
        $this->Cell(129, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
    }
}

try {
    $stmt = $conn->query("SELECT * FROM Propietarios ORDER BY id_propietario ASC");
    $propietarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) { 
    ob_end_clean();
    die("Error en base de datos: " . $e->getMessage()); 
}

$pdf = new PDF_Propietarios('L', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);

$fill = false;
foreach ($propietarios as $p) {
    $pdf->SetFillColor(245, 247, 250);
    $pdf->SetTextColor(30, 30, 30);
    $pdf->SetDrawColor(220, 224, 230);
    
    // Concatenación y conversión forzada para sanitizar caracteres rotos de la BD (como sã¡nchez)
    $nombre_completo = $p['nombre'] . ' ' . $p['apellido_paterno'] . ' ' . $p['apellido_materno'];
    $nombre_limpio = iconv('UTF-8', 'windows-1252//IGNORE', $nombre_completo);
    $domicilio_limpio = iconv('UTF-8', 'windows-1252//IGNORE', $p['domicilio']);
    
    $pdf->Cell(15, 7, '#' . $p['id_propietario'], 'B', 0, 'C', $fill);
    $pdf->Cell(60, 7, $nombre_limpio, 'B', 0, 'L', $fill);
    $pdf->Cell(32, 7, utf8_decode($p['rfc']), 'B', 0, 'C', $fill);
    $pdf->Cell(42, 7, utf8_decode($p['curp']), 'B', 0, 'C', $fill);
    $pdf->Cell(60, 7, $domicilio_limpio, 'B', 0, 'L', $fill);
    $pdf->Cell(25, 7, utf8_decode($p['telefono']), 'B', 0, 'C', $fill);
    
    // Tratamiento seguro de fechas vacías o dañadas
    if (!empty($p['fecha_nacimiento']) && $p['fecha_nacimiento'] != '0000-00-00') {
        $fechaFmt = date('d/m/Y', strtotime($p['fecha_nacimiento']));
    } else {
        $fechaFmt = 'N/R';
    }
    
    $pdf->Cell(25, 7, $fechaFmt, 'B', 1, 'C', $fill);
    $fill = !$fill;
}

ob_end_clean();
$pdf->Output('I', 'Reporte_Propietarios.pdf');
?>