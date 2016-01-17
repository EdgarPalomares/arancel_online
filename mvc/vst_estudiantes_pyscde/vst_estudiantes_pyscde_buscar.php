<?
   /**********configuraciones*************/
     $titulo='B&uacute;squeda de vst_estudiantes_pyscde';
     $nombre_b_insertar='Nuevo';

$nombre_b_buscar='Buscar';

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
     $width="760px";
     $height="290px";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
$menu_seleccionado='menu_configuraciones.php';
require("../sis_design/encabezado.php");
?>

	<script language='javascript'>

function el(id)

{

var resp;

resp=confirm('Desea Eliminar');

if (resp)

{

	xajax_ctrl.c_eliminar(id);

}

	
}

</script>
 
<!--Autogenerado-->


 <div class="col-lg-12">

    <div class="panel panel-primary">

      <div class="panel-heading">

          <h4> <? echo $titulo; ?></h4>

      </div>

      <div class="panel-body">

      <div class="row">

  <div class="col-lg-12">

<form id="form" name="form" method="post" action="vst_estudiantes_pyscde.php" role="form" >
 
 <div class="form-group" align="right">

  <a href="vst_estudiantes_pyscde.php" ><i class="fa fa-file-o"></i>Nuevo</a>

</div><table border="0"> 
  <tr>
  
   <td><? echo $campo['primer_apellido']; ?></td>
  
   <td><? echo $campo['segundo_apellido']; ?></td>
  
   <td><? echo $campo['primer_nombre']; ?></td>
  
   <td><? echo $campo['segundo_nombre']; ?></td>
  
   <td><? echo $campo['cod_carrera']; ?></td>
  
   <td><? echo $campo['carrera']; ?></td>
  
   <td><? echo $campo['cod_sede']; ?></td>
  
   <td><? echo $campo['sede']; ?></td>
  
   <td><? echo $campo['estatus']; ?></td>
  </tr>
  <tr>
  
   <td ><input id="primer_apellido" class="form-control" name="primer_apellido" type="text" size="20" maxlength="45" value="<? echo $_POST['primer_apellido']?>" /></td>
  
  
   <td ><input id="segundo_apellido" class="form-control" name="segundo_apellido" type="text" size="20" maxlength="45" value="<? echo $_POST['segundo_apellido']?>" /></td>
  
  
   <td ><input id="primer_nombre" class="form-control" name="primer_nombre" type="text" size="20" maxlength="45" value="<? echo $_POST['primer_nombre']?>" /></td>
  
  
   <td ><input id="segundo_nombre" class="form-control" name="segundo_nombre" type="text" size="20" maxlength="45" value="<? echo $_POST['segundo_nombre']?>" /></td>
  
  
   <td ><input id="cod_carrera" class="form-control" name="cod_carrera" type="text" size="20" maxlength="45" value="<? echo $_POST['cod_carrera']?>" /></td>
  
  
   <td ><input id="carrera" class="form-control" name="carrera" type="text" size="20" maxlength="45" value="<? echo $_POST['carrera']?>" /></td>
  
  
   <td ><input id="cod_sede" class="form-control" name="cod_sede" type="text" size="20" maxlength="45" value="<? echo $_POST['cod_sede']?>" /></td>
  
  
   <td ><input id="sede" class="form-control" name="sede" type="text" size="20" maxlength="45" value="<? echo $_POST['sede']?>" /></td>
  
  
   <td ><input id="estatus" class="form-control" name="estatus" type="text" size="20" maxlength="11" value="<? echo $_POST['estatus']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/></td>
  
<td ><input id="buscar" type="button" name="buscar" class="btn btn-primary"  value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'),'');"></td>  </tr>
  <tr>
  <td colspan="11" align="center"><hr/></td> 
  </tr>
  <tr>
   <td colspan="11" align="center"><div id="mensaje" >&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="11" align="center"><div id="grid" >&nbsp;</div></td>
  </tr>
   <tr>
   <td colspan="11" align="center"><div id="registros" >&nbsp;</div></td>
  </tr>
   </table>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>