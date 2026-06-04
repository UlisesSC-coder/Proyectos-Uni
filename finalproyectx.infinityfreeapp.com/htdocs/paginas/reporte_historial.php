<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); exit();
}
include("../conexion_hosting_ulises.php");

if (!file_exists('fpdf.php') && !file_exists('../fpdf/fpdf.php')) {
    $fpdf_code = file_get_contents("https://raw.githubusercontent.com/Setas67/FPDF-Pure-PHP/master/fpdf.php");
    if($fpdf_code) { file_put_contents("fpdf.php", $fpdf_code); require('fpdf.php'); } 
    else { die("Error: No se pudo cargar FPDF."); }
} else {
    file_exists('fpdf.php') ? require('fpdf.php') : require('../fpdf/fpdf.php');
}

class PDF_Enchanced extends FPDF {
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='') {
        $str_width=$this->GetStringWidth($txt);
        if($w==0) $w=$this->w-$this->lMargin-$this->rMargin;
        $wmax=($w-2*$this->cMargin);
        if($str_width>$wmax) {
            $f_sz=$this->FontSizePt*( $wmax/$str_width );
            $this->SetFontSize($f_sz);
            $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
            $this->SetFontSize($this->FontSizePt);
        } else {
            $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
        }
    }

    function Header() {
        $this->SetDrawColor(31, 41, 55);
        $this->SetLineWidth(0.8);
        $this->Line(10, 28, 269, 28);
        
        $this->SetFont('Arial', 'B', 15);
        $this->SetTextColor(31, 41, 55);
        $this->Cell(180, 8, utf8_decode('SISTEMA DE CATASTRO MUNICIPAL'), 0, 0, 'L');
        
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(79, 8, utf8_decode('Generado: ') . date('d/m/Y H:i') . ' hrs', 0, 1, 'R');
        
        $this->SetFont('Arial', 'B', 11);
        $this->SetTextColor(75, 85, 99);
        $this->Cell(0, 6, utf8_decode('REPORTE GENERAL - RELACIÓN DE CUENTAS CATASTRALES'), 0, 1, 'L');
        $this->Ln(6);
        
        $this->SetFillColor(31, 41, 55); 
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(31, 41, 55);
        $this->SetLineWidth(0.2);
        $this->SetFont('Arial', 'B', 9);
        
        $this->Cell(22, 8, 'Clave Cast.', 1, 0, 'C', true);
        $this->Cell(62, 8, 'Propietario Asignado', 1, 0, 'L', true);
        $this->Cell(30, 8, 'RFC', 1, 0, 'C', true);
        $this->Cell(35, 8, 'Tipo Propiedad', 1, 0, 'L', true);
        $this->Cell(65, 8, utf8_decode('Dirección de la Propiedad'), 1, 0, 'L', true);
        $this->Cell(28, 8, 'Valor Catastral', 1, 0, 'C', true);
        $this->Cell(17, 8, 'Estatus', 1, 1, 'C', true);
    }

    function Footer() {
        $this->SetY(-25);
        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 4, utf8_decode('_______________________________________'), 0, 1, 'C');
        $this->Cell(0, 4, utf8_decode('Sello y Firma de la Dirección de Catastro'), 0, 1, 'C');
        
        $this->SetY(-12);
        $this->SetFont('Arial', 'I', 7);
        $this->Cell(0, 5, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
    }
}

try {
    $query = "SELECT p.clave_castral, p.tipo_propiedad, p.valor_castral, p.ubicacion_domicilio, p.estatus,
                     u.nombre, u.apellido_paterno, u.apellido_materno, u.rfc 
              FROM Predios p 
              INNER JOIN Propietarios u ON p.id_propietario = u.id_propietario 
              ORDER BY p.clave_castral ASC";
    $stmt = $conn->query($query);
    $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) { die("Error: " . $e->getMessage()); }

$pdf = new PDF_Enchanced('L', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);

$fill = false;
foreach ($historial as $h) {
    $pdf->SetFillColor(248, 250, 252);
    $pdf->SetTextColor(30, 30, 30);
    $pdf->SetDrawColor(226, 232, 240);
    
    $contribuyente = $h['nombre'] . ' ' . $h['apellido_paterno'] . ' ' . $h['apellido_materno'];
    
    $pdf->Cell(22, 7, '#' . $h['clave_castral'], 'B', 0, 'C', $fill);
    $pdf->CellFit(62, 7, utf8_decode($contribuyente), 'B', 0, 'L', $fill);
    $pdf->Cell(30, 7, utf8_decode($h['rfc']), 'B', 0, 'C', $fill);
    $pdf->CellFit(35, 7, utf8_decode($h['tipo_propiedad']), 'B', 0, 'L', $fill);
    $pdf->CellFit(65, 7, utf8_decode($h['ubicacion_domicilio']), 'B', 0, 'L', $fill);
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(28, 7, '$' . number_format($h['valor_castral'], 2), 'B', 0, 'R', $fill);
    $pdf->SetFont('Arial', '', 9);
    
    if(trim(strtolower($h['estatus'])) == 'activo') {
        $pdf->SetTextColor(46, 117, 89);
    } else {
        $pdf->SetTextColor(166, 25, 46);
    }
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(17, 7, strtoupper(utf8_decode($h['estatus'])), 'B', 1, 'C', $fill);
    
    $fill = !$fill;
}

$pdf->Output('I', 'Reporte_Historial_Catastral.pdf');
?>