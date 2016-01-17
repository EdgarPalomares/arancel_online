<?
   /**********configuraciones*************/
     $titulo='Solicitud de Arancel';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['nro_solicitud']='nro_solicitud';
     $campo['fecha']='fecha';
     $campo['user_id']='user_id';
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
 
 <div class="col-md-8"><div class="box box-primary"><div class="box-headerbox-header"><h4 class="box-title"><i class="glyphicon glyphicon-list-alt"></i><? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="solicitud_arancel.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="solicitud_arancel_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>  <div class="form-group">
   <label><? echo $campo['nro_solicitud']='Nro de Solicitud'; ?></label><input class="form-control" id="nro_solicitud" name="nro_solicitud" type="text" size="45" maxlength="45" value="<? echo $_POST['nro_solicitud']?>" />
  </div>
<div class="form-group">
   <label><? echo $campo['fecha']='Fecha'; ?></label><input class="form-control" id="fecha" name="fecha" type="date" size="10"  value="<? echo $_POST['fecha']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['user_id']='Usuario'; ?></label><input class="form-control" id="user_id" name="user_id" type="text" size="" maxlength="" value="<? echo $_SESSION['id']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>