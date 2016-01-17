<?
   /**********configuraciones*************/
     $titulo='configuraciones';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

$nombre_b_actualizar='Actualizar';

$nombre_b_eliminar='Eliminar';

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
 
 <div class="col-lg-8"><div class="panel panel-primary"><div class="panel-heading"><h4><? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="#"  onClick="xajax_ctrl.c_actualizar(<? echo $_POST['id']; ?>)" ><i class="fa fa-edit"></i><? echo $nombre_b_actualizar; ?></a> | <a href="configuraciones.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="configuraciones_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>
<table>     <div class="form-group"><label><? echo $campo['vigencia_solicitud'];?></label><p class="form-control-static"><? echo $_POST['vigencia_solicitud'];?></p></div>
     <div class="form-group"><label><? echo $campo['dias_elaboracion'];?></label><p class="form-control-static"><? echo $_POST['dias_elaboracion'];?></p></div>
     <div class="form-group"><label><? echo $campo['dias_firma'];?></label><p class="form-control-static"><? echo $_POST['dias_firma'];?></p></div>
     <div class="form-group"><label><? echo $campo['dias_entrega'];?></label><p class="form-control-static"><? echo $_POST['dias_entrega'];?></p></div>
</table><div class="form-group"><div id="mensaje">&nbsp;</div></div></form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>