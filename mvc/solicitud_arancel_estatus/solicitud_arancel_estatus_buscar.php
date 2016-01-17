<?
   /**********configuraciones*************/
     $titulo='Verificar Estatus de Solicitudes';
     $nombre_b_insertar='Nuevo';

$nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['nro_solicitud']='nro_solicitud';
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


 <div class="col-md-8">

    <div class="box box-primary">

      <div class="box-header">

          <h4 class="box-title"><i class="fa fa-check"></i>  <? echo $titulo; ?></h4>

      </div>

      <div class="panel-body">

      <div class="row">

  <div class="col-lg-12">

<form id="form" name="form" method="post" action="solicitud_arancel_estatus.php" role="form" >
 
 <div class="form-group" align="right">

  <!--<a href="solicitud_arancel_estatus.php" ><i class="fa fa-file-o"></i>Nuevo</a>-->

</div><table border="0"> 
  <tr>
  
   <td>Nro de Solicitud</td>
  </tr>
  <tr>
  
   <td ><input id="nro_solicitud" class="form-control" name="nro_solicitud" type="text" size="20" maxlength="45" value="<? echo $_POST['nro_solicitud']?>" /></td>
  
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