<?
   /**********configuraciones*************/
     $titulo='solicitud_arancel_estatus';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['id_solicitud_arancel']='id_solicitud_arancel';
     $campo['fecha']='fecha';
     $campo['id_estatus_solicitud']='id_estatus_solicitud';
     $titulo_estilo="";
     $titulo_class="";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
$menu_seleccionado='menu_solicitudes.php';
 require("../sis_design/encabezado.php");
 ?>
 <!--Autogenerado-->

<form id="form" role="form" name="form" method="post" >
 
 <div class="col-lg-8"><div class="panel panel-primary"><div class="panel-heading"><h4><? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="solicitud_arancel_estatus.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="solicitud_arancel_estatus_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>  <div class="form-group">
   <label><? echo $campo['id_solicitud_arancel']; ?></label><div id='d_id_solicitud_arancel'>
  </div>
  <input class="form-control" id="h_id_solicitud_arancel" name="h_id_solicitud_arancel" type="hidden"  value="<? echo $_POST['id_solicitud_arancel']?>" />
<div class="form-group">
   <label><? echo $campo['fecha']; ?></label><input class="form-control" id="fecha" name="fecha" type="date" size="10"  value="<? echo $_POST['fecha']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['id_estatus_solicitud']; ?></label><div id='d_id_estatus_solicitud'>
  </div>
  <input class="form-control" id="h_id_estatus_solicitud" name="h_id_estatus_solicitud" type="hidden"  value="<? echo $_POST['id_estatus_solicitud']?>" />
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>