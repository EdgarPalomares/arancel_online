<?
   /**********configuraciones*************/
     $titulo='Seleccione Fecha de su Cita';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['fecha_ini']='fecha_ini';
     $campo['fecha_fin']='fecha_fin';
     $campo['user_id']='user_id';
     $campo['id_tipo_solicitud']='id_tipo_solicitud';
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
 
 <div class="col-md-8"><div class="box box-primary"><div class="box-header"><h4><i class="fa fa-calendar"></i> <? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="citas.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="citas_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div><div class="form-group">
   <label><? echo $campo['fecha_ini']='Fecha de Inicio'; ?></label><input class="form-control" id="fecha_ini" name="fecha_ini" type="date" size="10"  value="<? echo $_POST['fecha_ini']?>" />
  </div>
<div class="form-group">
   <label><? echo $campo['fecha_fin']='Fecha Fin'; ?></label><input class="form-control" id="fecha_fin" name="fecha_fin" type="date" size="10"  value="<? echo $_POST['fecha_fin']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['user_id']='Usuario'; ?></label><input class="form-control" id="user_id" name="user_id" type="text" size="" maxlength="" value="<? echo $_POST['user_id']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
  <div class="form-group">
   <label><? echo $campo['id_tipo_solicitud']='Tipo de Solicitud'; ?></label><div id='d_id_tipo_solicitud'>
  </div>
  <input class="form-control" id="h_id_tipo_solicitud" name="h_id_tipo_solicitud" type="hidden"  value="<? echo $_POST['id_tipo_solicitud']?>" />
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>