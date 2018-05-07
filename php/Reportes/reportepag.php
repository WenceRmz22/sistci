<?php 

require('fpdf/fpdf.php');
include '../db.php';
$titulo ="";
if($_GET['rep'] == 0){
    $titulo = "INVOICES PAID";
}else {
    $titulo = "INVOICES NOT PAID";
}
$sql = "SELECT trId
            ,trNumberInvoice
            ,trDate 
            ,usunombre
            ,(SELECT SUM(trDetAmount) FROM trinvoicedetails 
        where trinvoicedetails.trId=trinvoice.trId ) AS TOTAL
        FROM trinvoice JOIN
        usuarios ON trinvoice.usuid = usuarios.usuid
        WHERE trActivo =".$_GET['rep'] ;

$querySql = [];
$sum= 0;
$InvId = "";
$InvDate = "";
$query = $db->prepare($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_OBJ))
	{
		$arr = array($row->trId,$row->trNumberInvoice,$row->trDate,$row->usunombre,$row->TOTAL);
        $sum = $sum + $row->TOTAL;
        array_push($querySql, $arr);
        
    }
class PDF extends FPDF
{
   
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
        $w = array(30,40,40,40,40);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],5,$header[$i],1,0,'C',true);
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(254,254,254);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Datos
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
            $this->Cell($w[2],6,substr($row[2],0,-9),'LR',0,'C',$fill);
            $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
            $this->Cell($w[4],6,"$".$row[4],'LR',0,'C',$fill);
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
$pdf->SetFont('Arial','B',18);
$pdf->Image('fotos/encabezado.png',10,10,180,35,'png','http://www.tramitaciones.com');
$pdf->Ln(40);
$pdf->Cell(65);
$pdf->Cell(80,10,$titulo,0,0);
$pdf->Ln(20);
$header = array('ID', ' # INVOICE', 'DATE', 'CREATED BY','TOTAL');
// Carga de datos
$data = $pdf->LoadData($querySql);
$pdf->SetFont('Arial','',12);
$pdf->FancyTable($header,$data);
$pdf->versuma($sum);
$pdf->Output();

 ?>