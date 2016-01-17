<?
   /**********configuraciones*************/
     $titulo='B&uacute;squeda de configuraciones';
     $nombre_b_insertar='Nuevo';

$nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['vigencia_solicitud']='vigencia_solicitud';
     $campo['dias_elaboracion']='dias_elaboracion';
     $campo['dias_firma']='dias_firma';
     $campo['dias_entrega']='dias_entrega';
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

<form id="form" name="form" method="post" action="configuraciones.php" role="form" >
 
 <div class="form-group" align="right">

  <a href="configuraciones.php" ><i class="fa fa-file-o"></i>Nuevo</a>

</div><table border="0"> 
  <tr>
  
   <td><? echo $campo['vigencia_solicitud']; ?></td>
  
   <td><? echo $campo['dias_elaboracion']; ?></td>
  
   <td><? echo $campo['dias_firma']; ?></td>
  
   <td><? echo $campo['dias_entrega']; ?></td>
  </tr>
  <tr>
  
   <td ><input id="vigencia_solicitud" class="form-control" name="vigencia_solicitud" type="text" size="20" maxlength="11" value="<? echo $_POST['vigencia_solicitud']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/></td>
  
  
   <td ><input id="dias_elaboracion" class="form-control" name="dias_elaboracion" type="text" size="20" maxlength="11" value="<? echo $_POST['dias_elaboracion']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/></td>
  
  
   <td ><input id="dias_firma" class="form-control" name="dias_firma" type="text" size="20" maxlength="11" value="<? echo $_POST['dias_firma']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/></td>
  
  
   <td ><input id="dias_entrega" class="form-control" name="dias_entrega" type="text" size="20" maxlength="11" value="<? echo $_POST['dias_entrega']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/></td>
  
<td ><input id="buscar" type="button" name="buscar" class="btn btn-primary"  value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'),'');"></td>  </tr>
  <tr>
  <td colspan="6" align="center"><hr/></td> 
  </tr>
  <tr>
   <td colspan="6" align="center"><div id="mensaje" >&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="6" align="center"><div id="grid" >&nbsp;</div></td>
  </tr>
   <tr>
   <td colspan="6" align="center"><div id="registros" >&nbsp;</div></td>
  </tr>
   </table>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>