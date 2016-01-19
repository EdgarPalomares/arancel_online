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
$pdf->SetFont('helvetica', 'B', 8);

if($abierto=mysql_connect("localhost","root","1234"))
{ $db1= mysql_select_db("arancel_online_bd",$abierto);
$id=$_REQUEST['id'];
$leer="select * from (select `solicitud_arancel_detalles`.`id` AS `id`,`solicitud_arancel`.id as id_solicitud_arancel, `solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id`,`arancel`.`nombre` AS `nombre`,`arancel`.`monto` AS `monto`,`arancel`.`max` AS `max`,`solicitud_arancel_detalles`.`cantidad` AS `cantidad` from ((`solicitud_arancel_detalles` join `solicitud_arancel` on((`solicitud_arancel`.`id` = `solicitud_arancel_detalles`.`id_solicitud_arancel`))) join `arancel` on((`arancel`.`id` = `solicitud_arancel_detalles`.`id_arancel`)))) as bg where bg.id_solicitud_arancel=$id";
$db=mysql_query($leer);
$db2=mysql_query($leer);

$pdf->Write(0, "Fecha de Impresión: ".date('d - m - Y'), '', 0, 'R', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'B', 20);

$pdf->Write(0, 'Detalles de Solicitud', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(30);
$h="Constancia de Notas";
$c=1;
if($fila=mysql_fetch_array($db))
	{	
		$usuario=$fila['user_id'];

		$datos="select * from sis_usuarios where id='$usuario'";
		$dat=mysql_query($datos);
        $datos=mysql_fetch_array($dat);
 //$fila['nro_solicitud'];

// create some HTML content
$html = '
<div style="border: 2px solid; border-radius: 50px;">
<table border="0">
<tr>
<td width="160" height="20">Nro de Solicitud:</td>
<td height="20">'.$fila['nro_solicitud'].'</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td  width="110" height="90">Solicitante:</td>
<td width="300" height="90">'.$datos['nombres'].''.$datos['apellidos'].'</td>

</tr>
<tr>
<td  width="110" height="20">Aranceles:</td></tr>';

$total=0;

while($aranceles=mysql_fetch_array($db2))
	{
	$total+=$aranceles['cantidad']*$aranceles['monto'];

$html.= '<tr>
<td  width="110" height="20"></td>
<td  width="500" height="20">'.$aranceles['nombre'].'('.$aranceles['cantidad'].')</td>
</tr>';
}




$html.= '<tr>
<td width="400" align="right">Total:</td>
<td align="center" width="200">'.$total.' BsF</td>
</tr>



 </table>
</div>


<p><font size="10"> Nota: Para realizar el pago de su solicitud dirigase a uno de nuestros bancos afiliados</p>












';}}

// set core font
$pdf->SetFont('dejavusans', '', 15);

// output the HTML content
$pdf->writeHTML($html, true, 0, true, true);

$pdf->Ln();

// set UTF-8 Unicode font
$pdf->SetFont('dejavusans', '', 30);

// output the HTML content
//$pdf->writeHTML($html, true, 0, true, true);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output("Detalles de Solcitud'.$c.'pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+
