<?
   /**********configuraciones*************/
     $titulo='Citas';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

$nombre_b_actualizar='Actualizar';

$nombre_b_eliminar='Eliminar';

     $campo['id']='id';
     $campo['fecha_ini']='fecha_ini';
     $campo['fecha_fin']='fecha_fin';
     $campo['user_id']='user_id';
     $campo['id_tipo_solicitud']='id_tipo_solicitud';
     $campo['solicitud']='solicitud';
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
 
 <div class="col-md-8"><div class="box box-primary"><div class="panel-heading"><h4><i class="fa fa-calendar"></i> <? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />
<div class="form-group" align="right"><a href="#"  onClick="xajax_ctrl.c_actualizar(<? echo $_POST['id']; ?>)" ><i class="fa fa-edit"></i><? echo $nombre_b_actualizar; ?></a> | <a href="citas.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="citas_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>
<table class="table table-condensed">
<tr>
<th><div class="form-group"><label><? echo $campo['fecha_ini']='Fecha';?></label></th>
<th><div class="form-group"><label><? echo $campo['fecha_fin']='Fecha';?></label></th>
<th><div class="form-group"><label><? echo $campo['user_id']='Usuario';?></label></th>
<th><div class="form-group"><label><? echo $campo['solicitud']='Solicitud';?></label></th>
</tr>
<tr> 
<td> <p class="form-control-static"><? echo $_POST['fecha_ini'];?></p></div> </td>
<td><p class="form-control-static"><? echo $_POST['fecha_fin'];?></p></div> </td>
<td> <p class="form-control-static"><? echo $_POST['user_id'];?></p></div> </td>
<td><p class="form-control-static"><? echo $_POST['solicitud'];?></p></div> </td>

</tr>    
     
    
     
</table><div class="form-group"><div id="mensaje">&nbsp;</div></div></form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>