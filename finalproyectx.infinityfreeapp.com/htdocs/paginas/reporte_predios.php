<?php
ob_start();
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); 
    exit();
}

include("../conexion_hosting_ulises.php");

// Localización de FPDF idéntica al formato que te funciona
if (file_exists('fpdf.php')) {
    require('fpdf.php');
} else {
    require('../fpdf/fpdf.php');
}

class PDF_Predios extends FPDF {
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
        $this->Cell(0, 6, utf8_decode('INVENTARIO GENERAL DE PREDIOS Y FICHAS CATASTRALES'), 0, 1, 'L');
        $this->Ln(6);
        
        $this->SetFillColor(27, 54, 93); 
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(27, 54, 93);
        $this->SetLineWidth(0.2);
        $this->SetFont('Arial', 'B', 9);
        
        $this->Cell(20, 8, 'Clave Cast.', 1, 0, 'C', true);
        $this->Cell(18, 8, 'ID Prop.', 1, 0, 'C', true);
        $this->Cell(35, 8, 'Tipo Propiedad', 1, 0, 'L', true);
        $this->Cell(25, 8, 'Sup. Terreno', 1, 0, 'C', true);
        $this->Cell(25, 8, 'Sup. Const.', 1, 0, 'C', true);
        $this->Cell(32, 8, 'Valor Catastral', 1, 0, 'C', true);
        $this->Cell(45, 8, 'Colindancias', 1, 0, 'L', true);
        $this->Cell(42, 8, utf8_decode('Ubicación / Domicilio'), 1, 0, 'L', true);
        $this->Cell(17, 8, 'Estatus', 1, 1, 'C', true);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetDrawColor(200, 200, 200);
        $this->SetLineWidth(0.2);
        $this->Line(10, $this->GetY(), 269, $this->GetY());
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(120, 120, 120);
        $this->Cell(130, 10, utf8_decode('Documento oficial generado de forma automatizada.'), 0, 0, 'L');
        $this->Cell(129, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
    }
}

try {
    $stmt = $conn->query("SELECT * FROM Predios ORDER BY clave_castral ASC");
    $predios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) { 
    ob_end_clean();
    die("Error en base de datos: " . $e->getMessage()); 
}

$pdf = new PDF_Predios('L', 'mm', 'Letter');
$pdf->AliasNbPages(); 
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);

$fill = false;
foreach ($predios as $p) {
    $pdf->SetFillColor(245, 247, 250);
    $pdf->SetTextColor(30, 30, 30);
    $pdf->SetDrawColor(220, 224, 230);
    
    // Filtro estricto para evitar la ruptura por caracteres especiales corruptos en la BD
    $tipo_limpio = iconv('UTF-8', 'windows-1252//IGNORE', $p['tipo_propiedad']);
    $colindancias_limpio = iconv('UTF-8', 'windows-1252//IGNORE', $p['colindancias']);
    $ubicacion_limpio = iconv('UTF-8', 'windows-1252//IGNORE', $p['ubicacion_domicilio']);
    
    $pdf->Cell(20, 7, '#' . $p['clave_castral'], 'B', 0, 'C', $fill);
    $pdf->Cell(18, 7, '#' . $p['id_propietario'], 'B', 0, 'C', $fill);
    $pdf->Cell(35, 7, $tipo_limpio, 'B', 0, 'L', $fill);
    $pdf->Cell(25, 7, $p['superficie_terreno'] . ' m2', 'B', 0, 'C', $fill);
    $pdf->Cell(25, 7, $p['superficie_construccion'] . ' m2', 'B', 0, 'C', $fill);
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(32, 7, '$' . number_format($p['valor_castral'], 2), 'B', 0, 'R', $fill);
    $pdf->SetFont('Arial', '', 9);
    
    $pdf->Cell(45, 7, $colindancias_limpio, 'B', 0, 'L', $fill);
    $pdf->Cell(42, 7, $ubicacion_limpio, 'B', 0, 'L', $fill);
    
    // Renderizado controlado del estatus
    $estatus_actual = trim(strtolower($p['estatus']));
    if($estatus_actual == 'activo') {
        $pdf->SetTextColor(46, 117, 89);
    } else {
        $pdf->SetTextColor(166, 25, 46);
    }
    
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(17, 7, strtoupper(utf8_decode($p['estatus'])), 'B', 1, 'C', $fill);
    
    $fill = !$fill;
}

ob_end_clean();
$pdf->Output('I', 'Reporte_Predios_Generales.pdf');
?>