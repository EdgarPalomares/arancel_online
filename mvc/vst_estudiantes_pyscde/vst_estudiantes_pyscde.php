<?
   /**********configuraciones*************/
     $titulo='vst_estudiantes_pyscde';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

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
<div class="form-group" align="right"><a href="vst_estudiantes_pyscde.php" ><i class="fa fa-file-o"></i><? echo $nombre_b_insertar; ?></a> | <a href="vst_estudiantes_pyscde_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a></div>  <div class="form-group">
   <label><? echo $campo['primer_apellido']; ?></label><input class="form-control" id="primer_apellido" name="primer_apellido" type="text" size="45" maxlength="45" value="<? echo $_POST['primer_apellido']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['segundo_apellido']; ?></label><input class="form-control" id="segundo_apellido" name="segundo_apellido" type="text" size="45" maxlength="45" value="<? echo $_POST['segundo_apellido']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['primer_nombre']; ?></label><input class="form-control" id="primer_nombre" name="primer_nombre" type="text" size="45" maxlength="45" value="<? echo $_POST['primer_nombre']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['segundo_nombre']; ?></label><input class="form-control" id="segundo_nombre" name="segundo_nombre" type="text" size="45" maxlength="45" value="<? echo $_POST['segundo_nombre']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['cod_carrera']; ?></label><input class="form-control" id="cod_carrera" name="cod_carrera" type="text" size="45" maxlength="45" value="<? echo $_POST['cod_carrera']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['carrera']; ?></label><input class="form-control" id="carrera" name="carrera" type="text" size="45" maxlength="45" value="<? echo $_POST['carrera']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['cod_sede']; ?></label><input class="form-control" id="cod_sede" name="cod_sede" type="text" size="45" maxlength="45" value="<? echo $_POST['cod_sede']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['sede']; ?></label><input class="form-control" id="sede" name="sede" type="text" size="45" maxlength="45" value="<? echo $_POST['sede']?>" />
  </div>
  <div class="form-group">
   <label><? echo $campo['estatus']; ?></label><input class="form-control" id="estatus" name="estatus" type="text" size="" maxlength="" value="<? echo $_POST['estatus']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>