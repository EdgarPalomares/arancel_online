<?
   /**********configuraciones*************/
     $titulo='Registrar Pago';
     $nombre_boton_guardar='Registrar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['id_solicitud_arancel']='id_solicitud_arancel';
     $campo['id_bancos']='id_bancos';
     $campo['monto']='monto';
     $campo['nro_deposito']='nro_deposito';
     $titulo_estilo="";
     $titulo_class="";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
$menu_seleccionado='menu_configuraciones.php';
 require("../sis_design/encabezado.php");
 ?>
 <!--Autogenerado-->

<form id="form" role="form" name="form" method="post" >
 
 <div class="col-md-6"><div class="box box-primary"><div class="box-header"></div></center><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div id="ronald" name="ronald"></div>
   
  </div>
  <div class="form-group">
   <label><? echo $campo['id_bancos']='Banco'; ?></label><div id='d_id_bancos'>
  </div>
  <input class="form-control" id="h_id_bancos" name="h_id_bancos" type="hidden"  value="<? echo $_POST['id_bancos']?>" />
  <div class="form-group">
   <label><? echo $campo['monto']='Monto Depositado'; ?></label><input class="form-control" id="monto" name="monto" type="text" size="" maxlength="" value="<? echo $_POST['monto']?>" onblur="extractNumber(this,2,true);" onkeyup="extractNumber(this,2,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
  <div class="form-group">
   <label><? echo $campo['nro_deposito']='Nro de Deposito'; ?></label><input class="form-control" id="nro_deposito" name="nro_deposito" type="text" size="45" maxlength="45" value="<? echo $_POST['nro_deposito']?>" />
  </div>
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<div class="col-md-3"><div class="box box-primary"><center><h4 class="box-title"><i class="fa fa-money"></i><? echo $titulo; ?></h4></center><div class="box-header">
  <i class="fa fa-check">Seleccione el banco donde realizo deposito</i>
  <i class="fa fa-check">Indique monto del pago realizado</i>
  <i class="fa fa-check">Ingrese numero de deposito</i>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>