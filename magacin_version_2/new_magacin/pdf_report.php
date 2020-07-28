<?php
require("lib/class_document.php");
require('tfpdf/tfpdf.php');
header('Content-type: text/html; charset=utf-8');


$type=$_GET['type'];
$id=$_GET['id'];

$data=takeData($id,$type);
$id=$data[0]['id'];
$list=json_decode($data[0]['in_list'], true);
if($type=='input'){
	$number=$data[0]['order_number_in'];
}else
{
	$number=$data[0]['order_number_out'];
}
$date=$data[0]['date'];
$date=date("m/d/y",strtotime($date));


class PDF extends tFPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('images\header.jpg',15,6,180,28);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function Table($header, $data)
{
	
    // Column widths
    $w = array(20, 70, 70, 25);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
	

	$i=0;
    foreach($data as $value){
		$product=takeProduct($value[0]);
		$qty=$value[1];
		
		$i++;
        $this->Cell($w[0],6,$i,'LRB',0,'C');
        $this->Cell($w[1],6,$product[0]['product_number'],1,0,'C');
        $this->Cell($w[2],6,$product[0]['tip_kompresor'],1,0,'C');
        $this->Cell($w[3],6,number_format($qty),1,0,'C');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage();

$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',15);
if($type=='input'){
	$pdf->Cell(0,40,'Приемница бр. '.$number,0,0,'C');
}else
{
	$pdf->Cell(0,40,'Испратница бр. '.$number,0,0,'C');
}
$pdf->SetY(85);
$pdf->SetFont('DejaVu','',10);	
$header=array('ред.број','Шифра','Компресорски тип','Количина');
$pdf->SetFont('DejaVu','',10);	
$pdf->Table($header,$list);

	
$pdf->Output();
?>



