<?
   /**********configuraciones*************/
     $titulo='Unidad Tributaria';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['unidad']='unidad';
     $campo['fecha']='fecha';
     $campo['is_inactiva']='is_inactiva';
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
<div class="form-group" align="right"><a href="unidad_tributaria.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="unidad_tributaria_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>  <div class="form-group">
   <label><? echo $campo['unidad']; ?></label><input class="form-control" id="unidad" name="unidad" type="text" size="" maxlength="" value="<? echo $_POST['unidad']?>" onblur="extractNumber(this,2,true);" onkeyup="extractNumber(this,2,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
<div class="form-group">
   <label><? echo $campo['fecha']; ?></label><input class="form-control" id="fecha" name="fecha" type="date" size="10"  value="<? echo $_POST['fecha']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['is_inactiva']; ?></label><input class="form-control" id="is_inactiva" name="is_inactiva" type="checkbox" <? if($_POST['is_inactiva']==1){ echo "checked";}?> onclick="if(this.value=='1'){ this.value=0; this.checked='';}else{ this.value=1; this.checked='checked';}"   value="<? echo $_POST['is_inactiva']?>" />
  </div>
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>