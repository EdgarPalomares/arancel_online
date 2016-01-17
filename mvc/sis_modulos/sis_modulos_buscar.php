<?
   /**********configuraciones*************/
     $titulo='B&uacute;squeda de M&oacute;dulos del Sistema';
     $nombre_b_insertar='Nuevo';

$nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['modulo']='M&oacute;dulo';
     $campo['descripcion']='Descripci&oacute;n';
     $titulo_estilo="";
     $titulo_class="";
     $width="760px";
     $height="290px";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
$menu_seleccionado='menu_sis.php';
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


 <div class="col-lg-10">

    <div class="panel panel-primary">

      <div class="panel-heading">

          <h4> <? echo $titulo; ?></h4>

      </div>

      <div class="panel-body">

      <div class="row">

  <div class="col-lg-12">

<form id="form" name="form" method="post" action="sis_modulos.php" role="form" >
 
 <div class="form-group" align="right">

  <a href="sis_modulos.php" ><i class="fa fa-file-o"></i>Nuevo</a>

</div><table border="0"> 
  <tr>
  
   <td><? echo $campo['modulo']; ?></td>
  
   <td><? echo $campo['descripcion']; ?></td>
  </tr>
  <tr>
  
   <td ><input id="modulo" class="form-control" name="modulo" type="text" size="20" maxlength="100" value="<? echo $_POST['modulo']?>" /></td>
  
  
   <td ><input id="descripcion" class="form-control" name="descripcion" type="text" size="20" maxlength="200" value="<? echo $_POST['descripcion']?>" /></td>
  
<td ><input id="buscar" type="button" name="buscar" class="btn btn-primary"  value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'),'');"></td>  </tr>
  <tr>
  <td colspan="4" align="center"><hr/></td> 
  </tr>
  <tr>
   <td colspan="4" align="center"><div id="mensaje" style="   padding : 4px; width : <? echo $width?>; height : <? echo $height?>; overflow : auto; ">&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="4" align="center"><div id="grid" style="   padding : 4px; width : $width; height : $height; overflow : auto; ">&nbsp;</div></td>
  </tr>
   <tr>
   <td colspan="4" align="center"><div id="registros" style="   padding : 4px; width :'720px'; height :'50px' <? echo $height?>; overflow : auto; ">&nbsp;</div></td>
  </tr>
   </table>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>