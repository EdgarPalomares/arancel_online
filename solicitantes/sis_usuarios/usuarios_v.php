<?
   /**********configuraciones*************/
     $titulo='solicitud_arancel_estatus';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

$nombre_b_actualizar='Actualizar';

$nombre_b_eliminar='Eliminar';

     $campo['id']='id';
     $campo['cedula']='cedula';
     $campo['apellidos']='apellidos';
     $campo['nombres']='nombres';
     $campo['login']='login';
   
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
<div class="form-group" align="right"><a href="#"  onClick="xajax_ctrl.c_actualizar(<? echo $_POST['id']; ?>)" > <a href="solicitud_arancel_estatus_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>
<table>     <div class="form-group"><label><? echo $campo['cedula'];?></label><p class="form-control-static"><? echo $_POST['cedula'];?></p></div>
     <div class="form-group"><label><? echo $campo['apellidos'];?></label><p class="form-control-static"><? echo $_POST['apellidos'];?></p></div>
     <div class="form-group"><label><? echo $campo['nombres'];?></label><p class="form-control-static"><? echo $_POST['nombres'];?></p></div>
     <div class="form-group"><label><? echo $campo['login'];?></label><p class="form-control-static"><? echo $_POST['login'];?></p></div>
</table><div class="form-group"><div id="mensaje">&nbsp;</div></div></form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>