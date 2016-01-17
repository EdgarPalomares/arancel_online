<?
   /**********configuraciones*************/
     $titulo='Men&uacute; del Sistema';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['main_titulo']='T&iacute;tulo del Men&uacute;';
     $campo['main']=' Men&uacute;';
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
<div class="form-group" align="right"><a href="sis_main.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="sis_main_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>  <div class="form-group">
   <label><? echo $campo['main_titulo']; ?></label><input class="form-control" id="main_titulo" name="main_titulo" type="text" size="100" maxlength="100" value="<? echo $_POST['main_titulo']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['main']; ?></label><input class="form-control" id="main" name="main" type="text" size="100" maxlength="100" value="<? echo $_POST['main']?>" />
  </div>
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>