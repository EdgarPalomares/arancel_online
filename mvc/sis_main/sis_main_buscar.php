<?
   /**********configuraciones*************/
     $titulo='B&uacute;squeda del Men&uacute; del Sistema';
     $nombre_b_insertar='Nuevo';

$nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['main_titulo']='T&iacute;tulo del Men&uacute;';
     $campo['main']='Men&uacute;';
     $titulo_estilo="";
     $titulo_class="";
     $width="760px";
     $height="290px";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
$menu_seleccionado='menu_sistema.php';
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

<form id="form" name="form" method="post" action="sis_main.php" role="form" >
 
 <div class="form-group" align="right">

  <a href="sis_main.php" ><i class="fa fa-file-o"></i>Nuevo</a>

</div><table border="0"> 
  <tr>
  
   <td><? echo $campo['main_titulo']; ?></td>
  
   <td><? echo $campo['main']; ?></td>
  </tr>
  <tr>
  
   <td ><input id="main_titulo" class="form-control" name="main_titulo" type="text" size="20" maxlength="100" value="<? echo $_POST['main_titulo']?>" /></td>
  
  
   <td ><input id="main" class="form-control" name="main" type="text" size="20" maxlength="100" value="<? echo $_POST['main']?>" /></td>
  
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