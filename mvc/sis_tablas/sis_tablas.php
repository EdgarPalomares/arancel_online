<?
   /**********configuraciones*************/
     $titulo='Tablas del Sistema';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['tabla']='Tabla';
     $campo['id_sis_main']='Men&uacute;';
     $campo['descripcion']='Descripci&oacute;n';
     $titulo_estilo="";
     $titulo_class="";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
$menu_seleccionado='menu_sistema.php';
 require("../sis_design/encabezado.php");
 ?>
 <!--Autogenerado-->

<form id="form" role="form" name="form" method="post" >
 
 <div class="col-lg-8"><div class="panel panel-primary"><div class="panel-heading"><h4><? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="sis_tablas.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="sis_tablas_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>  <div class="form-group">
   <label><? echo $campo['tabla']; ?></label><input class="form-control" id="tabla" name="tabla" type="text" size="100" maxlength="100" value="<? echo $_POST['tabla']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['descripcion']; ?></label><input class="form-control" id="descripcion" name="descripcion" type="text" size="100" maxlength="100" value="<? echo $_POST['descripcion']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['id_sis_main']; ?></label><div id='d_id_sis_main'>
  </div>
  <input class="form-control" id="h_id_sis_main" name="h_id_sis_main" type="hidden"  value="<? echo $_POST['id_sis_main']?>" />
  
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>