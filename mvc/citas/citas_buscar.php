<?
   /**********configuraciones*************/
     $titulo='Buscar Citas Programadas';
     $nombre_b_insertar='Nuevo';

$nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['fecha_ini']='fecha_ini';
     $campo['fecha_fin']='fecha_fin';
     $campo['solicitud']='solicitud';
     $titulo_estilo="";
     $titulo_class="";
     $width="760px";
     $height="290px";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
$menu_seleccionado='menu_solicitudes.php';
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


 <div class="col-md-12">

    <div class="box box-primary">

      <div class="box-header">

          <h4><i class="fa fa-calendar-o"></i> <? echo $titulo; ?></h4>

      </div>

      <div class="panel-body">

      <div class="row">

  <div class="col-lg-12">

<form id="form" name="form" method="post" action="citas.php" role="form" >
 
 <div class="form-group" align="right">

  <a href="citas.php" ><i class="fa fa-file-o"></i>Nuevo</a>

</div><table border="0"> 
  <tr>
  
   <td><? echo $campo['fecha_ini']='Fecha Inicio'; ?></td>
  
   <td><? echo $campo['fecha_fin']='Fecha Fin'; ?></td>
  
   <td><? echo $campo['solicitud']='Tipo de Solicitud'; ?></td>
  </tr>
  <tr>
  
   <td ><input id="fecha_ini" class="form-control" name="fecha_ini" type="text" size="20" maxlength="10" value="<? echo $_POST['fecha_ini']?>" /></td>
  
  
   <td ><input id="fecha_fin" class="form-control" name="fecha_fin" type="text" size="20" maxlength="10" value="<? echo $_POST['fecha_fin']?>" /></td>
  
  
   <td ><input id="solicitud" class="form-control" name="solicitud" type="text" size="20" maxlength="45" value="<? echo $_POST['solicitud']?>" /></td>
  
<td ><input id="buscar" type="button" name="buscar" class="btn btn-primary"  value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'),'');"></td>  </tr>
  <tr>
  <td colspan="5" align="center"><hr/></td> 
  </tr>
  <tr>
   <td colspan="5" align="center"><div id="mensaje" >&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="5" align="center"><div id="grid" >&nbsp;</div></td>
  </tr>
   <tr>
   <td colspan="5" align="center"><div id="registros" >&nbsp;</div></td>
  </tr>
   </table>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>