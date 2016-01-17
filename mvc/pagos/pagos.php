<?
   /**********configuraciones*************/
     $titulo='Registrar Pago';
     $nombre_boton_guardar='Guardar';
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
 
 <div class="col-md-8"><div class="box box-primary"><div class="box-header"><h4 class="box-title"><i class="fa fa-credit-card"></i><? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="pagos.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="pagos_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>  <div class="form-group">
   <label><? echo $campo['id_solicitud_arancel']='Solicitud'; ?></label><div id='d_id_solicitud_arancel'>
  </div>
  <input class="form-control" id="h_id_solicitud_arancel" name="h_id_solicitud_arancel" type="hidden"  value="<? echo $_POST['id_solicitud_arancel']?>" />
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
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>