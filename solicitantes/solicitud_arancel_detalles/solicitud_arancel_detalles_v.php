<?
   /**********configuraciones*************/
     $titulo='Mis Solicitudes';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

$nombre_b_actualizar='Actualizar';

$nombre_b_eliminar='Eliminar';

     $campo['id']='id';
     $campo['id_solicitud_arancel']='id_solicitud_arancel';
     $campo['nro_solicitud']='nro_solicitud';
     $campo['fecha']='fecha';
     $campo['user_id']='user_id';
     $campo['id_arancel']='id_arancel';
     $campo['nombre']='nombre';
     $campo['monto']='monto';
     $campo['max']='max';
     $campo['cantidad']='cantidad';
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
 
 <div class="col-md-8"><div class="box box-primary"><div class="panel-heading"><h4><? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="#"  onClick="xajax_ctrl.c_actualizar(<? echo $_POST['id']; ?>)" ><i class="fa fa-edit"></i><? echo $nombre_b_actualizar; ?></a> | <a href="solicitud_arancel_detalles.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="solicitud_arancel_detalles_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>
<table class="table table-condensed">  
<tr>
     <th><div class="form-group"><label><? echo $campo['nro_solicitud'];?></label></th>
     <th><div class="form-group"><label><? echo $campo['fecha'];?></label></th>
     <th><div class="form-group"><label><? echo $campo['user_id'];?></label></th>
     <th><div class="form-group"><label><? echo $campo['nombre'];?></label></th>
     <th><div class="form-group"><label><? echo $campo['monto'];?></label></th>
     <th><div class="form-group"><label><? echo $campo['max'];?></label></th>
     <th><div class="form-group"><label><? echo $campo['cantidad'];?></label></th>


</tr>
<tr>
     <th><p class="form-control-static"><? echo $_POST['nro_solicitud'];?></p></div></th>
     <th><p class="form-control-static"><? echo $_POST['fecha'];?></p></div></th>
     <th><p class="form-control-static"><? echo $_POST['user_id'];?></p></div></th>
     <th><p class="form-control-static"><? echo $_POST['nombre'];?></p></div></th>
     <th><p class="form-control-static"><? echo $_POST['monto'];?></p></div></th>
     <th><p class="form-control-static"><? echo $_POST['max'];?></p></div></th>
     <th><p class="form-control-static"><? echo $_POST['cantidad'];?></p></div></th>

</tr>




   
     
     
     
     
     
     
</table><div class="form-group"><div id="mensaje">&nbsp;</div></div></form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>