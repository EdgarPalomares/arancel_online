<?
   /**********configuraciones*************/
     $titulo='B&uacute;squeda de arancel';
     $nombre_b_insertar='Nuevo';

$nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['nombre']='nombre';
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

<form id="form" name="form" method="post" action="arancel.php" role="form" >
 
 <div class="form-group" align="right">

  <a href="arancel.php" ><i class="fa fa-file-o"></i>Nuevo</a>

</div><table border="0"> 
  <tr>
  
   <td><? echo $campo['nombre']; ?></td>
  </tr>
  <tr>
  
   <td ><input id="nombre" class="form-control" name="nombre" type="text" size="20" maxlength="100" value="<? echo $_POST['nombre']?>" /></td>
  
<td ><input id="buscar" type="button" name="buscar" class="btn btn-primary"  value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'),'');"></td>  </tr>
  <tr>
  <td colspan="3" align="center"><hr/></td> 
  </tr>
  <tr>
   <td colspan="3" align="center"><div id="mensaje" >&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="3" align="center"><div id="grid" >&nbsp;</div></td>
  </tr>
   <tr>
   <td colspan="3" align="center"><div id="registros" >&nbsp;</div></td>
  </tr>
   </table>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>