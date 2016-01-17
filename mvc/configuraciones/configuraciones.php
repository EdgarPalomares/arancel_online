<?
   /**********configuraciones*************/
     $titulo='Configuraciones Generales';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['vigencia_solicitud']='vigencia_solicitud';
     $campo['dias_elaboracion']='dias_elaboracion';
     $campo['dias_firma']='dias_firma';
     $campo['dias_entrega']='dias_entrega';
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
 
 <div class="col-md-8"><div class="box box-primary"><div class="box-header"><h4><i class="fa fa-cog"></i><? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="configuraciones.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="configuraciones_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>  <div class="form-group">
   <label><? echo $campo['vigencia_solicitud']; ?></label><input class="form-control" id="vigencia_solicitud" name="vigencia_solicitud" type="text" size="" maxlength="" value="<? echo $_POST['vigencia_solicitud']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
  <div class="form-group">
   <label><? echo $campo['dias_elaboracion']; ?></label><input class="form-control" id="dias_elaboracion" name="dias_elaboracion" type="text" size="" maxlength="" value="<? echo $_POST['dias_elaboracion']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
  <div class="form-group">
   <label><? echo $campo['dias_firma']; ?></label><input class="form-control" id="dias_firma" name="dias_firma" type="text" size="" maxlength="" value="<? echo $_POST['dias_firma']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
  <div class="form-group">
   <label><? echo $campo['dias_entrega']; ?></label><input class="form-control" id="dias_entrega" name="dias_entrega" type="text" size="" maxlength="" value="<? echo $_POST['dias_entrega']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>