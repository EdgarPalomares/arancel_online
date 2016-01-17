<?
   /**********configuraciones*************/
     $titulo='vst_estudiantes_pyscde';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

$nombre_b_actualizar='Actualizar';

$nombre_b_eliminar='Eliminar';

     $campo['cedula']='cedula';
     $campo['primer_apellido']='primer_apellido';
     $campo['segundo_apellido']='segundo_apellido';
     $campo['primer_nombre']='primer_nombre';
     $campo['segundo_nombre']='segundo_nombre';
     $campo['cod_carrera']='cod_carrera';
     $campo['carrera']='carrera';
     $campo['cod_sede']='cod_sede';
     $campo['sede']='sede';
     $campo['estatus']='estatus';
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
<div class="form-group" align="right"><a href="#"  onClick="xajax_ctrl.c_actualizar(<? echo $_POST['id']; ?>)" ><i class="fa fa-edit"></i><? echo $nombre_b_actualizar; ?></a> | <a href="vst_estudiantes_pyscde.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="vst_estudiantes_pyscde_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>
<table>     <div class="form-group"><label><? echo $campo['cedula'];?></label><p class="form-control-static"><? echo $_POST['cedula'];?></p></div>
     <div class="form-group"><label><? echo $campo['primer_apellido'];?></label><p class="form-control-static"><? echo $_POST['primer_apellido'];?></p></div>
     <div class="form-group"><label><? echo $campo['segundo_apellido'];?></label><p class="form-control-static"><? echo $_POST['segundo_apellido'];?></p></div>
     <div class="form-group"><label><? echo $campo['primer_nombre'];?></label><p class="form-control-static"><? echo $_POST['primer_nombre'];?></p></div>
     <div class="form-group"><label><? echo $campo['segundo_nombre'];?></label><p class="form-control-static"><? echo $_POST['segundo_nombre'];?></p></div>
     <div class="form-group"><label><? echo $campo['cod_carrera'];?></label><p class="form-control-static"><? echo $_POST['cod_carrera'];?></p></div>
     <div class="form-group"><label><? echo $campo['carrera'];?></label><p class="form-control-static"><? echo $_POST['carrera'];?></p></div>
     <div class="form-group"><label><? echo $campo['cod_sede'];?></label><p class="form-control-static"><? echo $_POST['cod_sede'];?></p></div>
     <div class="form-group"><label><? echo $campo['sede'];?></label><p class="form-control-static"><? echo $_POST['sede'];?></p></div>
     <div class="form-group"><label><? echo $campo['estatus'];?></label><p class="form-control-static"><? echo $_POST['estatus'];?></p></div>
</table><div class="form-group"><div id="mensaje">&nbsp;</div></div></form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>