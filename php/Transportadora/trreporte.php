<?php 
ob_start();
require('fpdf/fpdf.php');
include '../db.php';
$id = $_GET["id"];
$sql = "SELECT 	trDetId ,
		trDetDateCrossing,
		trDetTrailerNumber,
		trDetAmount,
		trDescriptionPedimento,
		trDescription,
		trFrom,
		trDestination,
		usunombre,
		trInvoice.trId,
        trInvoice.trNumberInvoice,
        trInvoice.trDate
		FROM trInvoiceDetails 
        JOIN trInvoice ON trInvoiceDetails.trId = trInvoice.trId
		JOIN usuarios ON trInvoice.usuid = usuarios.usuid
		WHERE trInvoiceDetails.trId =".$id;
$querySql = [];
$sum= 0;
$InvId = "";
$InvDate = "";
$query = $db->prepare($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_OBJ))
	{
		$arr = array($row->trDetDateCrossing,$row->trDetTrailerNumber,$row->trDetAmount,$row->trDescriptionPedimento,$row->trDescription,$row->trFrom,$row->trDestination);
        $sum = $sum + $row->trDetAmount;
        $InvId = $row->trNumberInvoice;
        $InvDate = $row->trDate;
        array_push($querySql, $arr);
        
	}
class PDF extends FPDF
{
// Cabecera de página
function Header()
{

}

public $suma = 0;
function versuma($sm){
        $this->suma = $sm;
    }
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',10);
        $this->Cell(60,10);
        $this->Cell(70,10,'TOTAL AMOUNT DUE  $'.$this->suma,1,0,'C');
    }
function LoadData($file)
{
    // Leer las líneas del fichero
    $data = array();
    foreach($file as $lines)
        $data[] = $lines;
    return $data;
}

// Tabla coloreada
function FancyTable($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(16,16,16);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.2);
    $this->SetFont('','B');
    // Cabecera
    $w = array(45, 22, 20,40,30,30);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(254,254,254);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,substr($row[0],0,-9),'LR',0,'C',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
        $this->Cell($w[2],6,'$'.number_format($row[2]),'LR',0,'C',$fill);
        $this->Cell($w[3],6,$row[3]." | ".$row[4],'LR',0,'C',$fill);
         $this->Cell($w[4],6,$row[5],'LR',0,'C',$fill);
         $this->Cell($w[5],6,$row[6],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}

}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Image('fotos/encabezado.png',10,10,180,35,'png','http://www.tramitaciones.com');
$pdf->Ln(40);
$pdf->Cell(50,10,'INVOICE # '.$InvId,1,0,'C');
$pdf->Cell(75);
$pdf->Cell(60,10,'INVOICE DATE  '.substr($InvDate,0,-9),1,0,'C');
$pdf->Ln(20);
$header = array('DATE OF CROSSING', ' # TRAILER', 'AMOUNT', 'DESCRIPTION','FROM','DESTINATION');
// Carga de datos
$data = $pdf->LoadData($querySql);
$pdf->SetFont('Arial','',8);
$pdf->FancyTable($header,$data);
$pdf->versuma($sum);
$pdf->Output();

 ?>