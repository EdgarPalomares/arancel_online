<?php
require('fpdf.php');
require('../str_conexion.php');
header('Content-Type: text/html; charset=UTF-8; charset=ISO-8859-1');
class PDF extends FPDF
{
    //Cabecera de página
    function Header()
    {
       // $this->Image('../Vendor/fpdf/images/unerg2.ico',11,5,'C');
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(70);
    // Título
    $this->Cell(20,8,'Republica Bolivariana de Venezuela',0,0,'C');
     $this->Ln(4);
      $this->Cell(70);
     $this->Cell(20,8,'Universidad Nacional Experimental "Romulo Gallegos"',0,0,'C');
      $this->Ln(4);  $this->Cell(70);
         $this->Cell(20,8,'Oficina de Secretaria',0,0,'C');
         $this->Ln(4);
         $this->Cell(70);
     $this->Cell(20,8,'San Juan de los Morros',0,0,'C');

    // Salto de línea
    $this->Ln(20);
        //$this->Image('',50,10,170);
        $this->SetFont('Arial','B',6);
        $this->Cell(0,20,"Fecha de Impresion: ".date('d - m - Y')."  ",'',1,'R');
            $this->Ln(2);
    }
    //Pie de página
    function Footer()
    {
        //Posición: a 2 cm del final
        $this->SetY(-30);
         //Arial italic 8
        $this->SetFont('Arial','',8);
        
         //Arial italic 8
        $this->SetFont('Arial','BI',8);
        $this->Cell(250,2,'SECRETARIA','',1,'L');
        $this->Cell(250,5,'UNERG','',1,'L');
        //Arial italic 8
        $this->SetFont('Arial','BI',8);
        //Número de página
        $this->Cell(195,5,'Solicitudes Diarias','T',0,'L');
        $this->Cell(0,4,'Pagina '.$this->PageNo  ().'/TPAG','T',1,'R');
        
        

    }
}//Fin de la clase


//Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','LETTER');
$pdf->AliasNbPages('TPAG');
$pdf->SetTopMargin(20);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
$pdf->AddPage();


if($abierto=mysql_connect("localhost","root","1234"))
{ $db1= mysql_select_db("arancel_online_bd",$abierto);
//$id="null";
$leer="SELECT t1.*, t2.* from consultas t1 
inner join personas t2 on t1.id_persona = t2.cedula 
where t1.fecha between '$fecha' and '$fecha1' order by t1.fecha ASC ";
//leer= "select * from consulta where tipo LIKE $tipo";
	$db=mysql_query($leer);}





$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Solicitudes Diarias',1,1,'C');
 $pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,10,'Solicitud Nro:',1,0);
$pdf->Cell(50,10,'7894',1,1);
 $pdf->Ln(10);
$pdf->Cell(50,10,'Solicitante:',1,0);
$pdf->Cell(50,10,'gina maria da silva',1,1);
$pdf->Cell(50,10,'Aranceles:',1,0);
$pdf->Cell(60,10,'gina maria da silva',1,1);
$pdf->Cell(60,10,'gina maria da silva',1,0);
$pdf->Cell(60,10,'gina maria da silva',1,1);
$pdf->Cell(60,10,'gina maria da silva',1,0);
$pdf->Cell(60,10,'gina maria da silva',1,1);
$pdf->Cell(60,10,'gina maria da silva',1,0);











    
/**foreach($data as $fila){
$pdf->Ln();
$pdf->Cell(30,5,$fila['SolicitudArancel']['nro_solicitud'],'TRLB',0,'C');
$pdf->SetFont('Arial','',10);   
$pdf->Cell(45,5,$fila['Arancel']['nombre'],'TRLB',0,'C');
$pdf->SetFont('Arial','',10);   
$pdf->Cell(45,5,$fila['SolicitudArancel']['fecha'],'TRLB',0,'C');
$pdf->SetFont('Arial','',10);   
$pdf->Cell(40,5,$fila['SolicitudArancelDetalle']['cantidad'],'TRLB',0,'C');

}*/



$pdf->Ln(0);
$pdf->OutPut("Slicitudes_diarias.pdf",'I');

?>