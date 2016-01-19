<?php
require('conectar.php');

//============================================================+
// File name   : example_039.php
// Begin       : 2008-10-16
// Last Update : 2014-01-13
//
// Description : Example 039 for TCPDF class
//               HTML justification
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML justification
 * @author Nicola Asuni
 * @since 2008-10-18
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
class MYPDF extends TCPDF {

	//Page header
	

	// Page footer
	function Footer()
	{
	    //Posición: a 2 cm del final
	    $this->SetY(-30);
		 //Arial italic 8
	    $this->SetFont('Arial','',8);
		
		 //Arial italic 8
	    $this->SetFont('Arial','BI',8);
		$this->Cell(250,2,'UPEL','',1,'L');
		$this->Cell(250,5,'SAN JUAN DE LOS MORROS','',1,'L');
	    //Arial italic 8
	    $this->SetFont('Arial','BI',8);
	    //Número de página
		$this->Cell(195,4,'Reporte Persona','T',0,'L');
	    $this->Cell(0,4,'Pagina '.$this->PageNo().'/TPAG','T',1,'R');
		
		

	}
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
/*$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 039');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');*/

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 039', PDF_HEADER_STRING);
$pdf->Cell(0,20,"Fecha de Impresion: ".date('d - m - Y')."  ",'',1,'R');
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

// set font
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Image('images/logo.jpg', 15, 20, 30, 20, 'JPG', 'http://www.tcpdf.org', '', false, 0, '', false, false, 0, false, false, false);
$pdf->Write(0, 'República Bolivariana de Venezuela', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, 'Universidad Nacional Experimental Rómulo Gallegos', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, 'Oficina de Secretaría', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(8);
$pdf->SetFont('helvetica', 'B', 8);

$pdf->Write(0, "Fecha de Impresión: ".date('d - m - Y'), '', 0, 'R', true, 0, false, false, 0);
$pdf->Ln(8);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Write(0, 'Comprobante de Pago', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(20);

if($abierto=mysql_connect("localhost","root","1234"))
{ $db1= mysql_select_db("arancel_online_bd",$abierto);
$id=$_REQUEST['id'];
$leer="select * from (select `pagos`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id`,`bancos`.`banco` AS `banco`,`pagos`.`monto` AS `monto`,`pagos`.`nro_deposito` AS `nro_deposito` from ((`pagos` join `solicitud_arancel` on((`solicitud_arancel`.`id` = `pagos`.`id_solicitud_arancel`))) join `bancos` on((`bancos`.`id` = `pagos`.`id_bancos`)))) as bg where  bg.id=$id";
$db=mysql_query($leer);
$db2=mysql_query($leer);

$h="Constancia de Notas";
$c=1;
// create some HTML content
if($fila=mysql_fetch_array($db))
	{	
		$usuario=$fila['user_id'];

		$datos="select * from sis_usuarios where id='$usuario'";
		$dat=mysql_query($datos);
        $datos=mysql_fetch_array($dat);
$html = '


<div style="border: 1px solid; border-radius: 50px;">
<table border="0">
<tr>
<td width="160" height="20"><b>Nro de Solicitud:</b></td>
<td height="20">'.$fila['nro_solicitud'].'</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td  width="110" height="50"><b>Solicitante:</b></td>
<td width="300" height="50">'.$datos['nombres'].''.$datos['apellidos'].'</td>

</tr>
<tr>
<td  width="110" height="20"><b>Aranceles:</b></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td  width="110" height="20"></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td  width="110" height="20"></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td  width="110" height="20"></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td  width="110" height="20"></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td width="110" align="left" height="20"><b>Banco:</b></td>
<td align="center">'.$fila['banco'].'</td>
</tr>
<tr>
<td width="110" align="left" height="20"><b>Nro. Baucher:</b></td>
<td align="center">'.$fila['nro_deposito'].'</td>
</tr>
<tr>
<td width="110" align="left" height="20"><b>Monto:</b></td>
<td align="center">'.$fila['monto'].'</td>
</tr>


 </table>
</div><br>
------------------------------------------------------------------------------------------------------------------------------------------------------<i class="fa fa-money"></i>

<br>
<div style="border: 1px solid; border-radius: 50px;">
<table border="0">
<tr>
<td width="160" height="20"><b>Nro de Solicitud:</b></td>
<td height="20">'.$fila['nro_solicitud'].'</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td  width="110" height="50"><b>Solicitante:</b></td>
<td width="300" height="50">'.$datos['nombres'].''.$datos['apellidos'].'</td>

</tr>
<tr>
<td  width="110" height="20"><b>Aranceles:</b></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td  width="110" height="20"></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td  width="110" height="20"></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td  width="110" height="20"></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td  width="110" height="20"></td>
<td  width="300" height="20">'.$h.'('.$c.')</td>
</tr>
<tr>
<td width="110" align="left" height="20"><b>Banco:</b></td>
<td align="center">Banco Venezuela</td>
</tr>
<tr>
<td width="110" align="left" height="20"><b>Nro. Baucher:</b></td>
<td align="center">537657465786785</td>
</tr>
<tr>
<td width="110" align="left" height="20"><b>Monto:</b></td>
<td align="center">200 BsF</td>
</tr>


 </table>
</div>


<p><font size="7">Este documento sin el sello y la firma de la oficina sectorial de control de estudios, no tiene validez</p>
















';}}

// set core font
$pdf->SetFont('helvetica', '', 10);

// output the HTML content
$pdf->writeHTML($html, true, 0, true, true);

$pdf->Ln();

// set UTF-8 Unicode font
$pdf->SetFont('helvetica', '', 15);

// output the HTML content


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_039.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
