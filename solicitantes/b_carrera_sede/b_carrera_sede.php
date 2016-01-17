<?
   /**********configuraciones*************/
     $titulo='Seleccione Carrera';
     $nombre_b_insertar='Nuevo';

$nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['nro_solicitud']='nro_solicitud';
     $campo['fecha']='fecha';
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


 <div class="col-lg-12">

    <div class="box box-primary">

      <div class="box-header">

          <h4 class="box-title"><i class="fa fa-search"></i> <? echo $titulo; ?></h4>
          

      </div>

      <div class="panel-body">

      <div class="row">

  <div class="col-lg-12">

<form id="form" name="form" method="post" action="solicitud_arancel.php" role="form" >
 
 <div class="form-group" align="right">


</div><table border="0"> 

   <tr>
   <td colspan="4" align="center"><div id="mensaje" >&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="4" align="center"><div id="grid" >&nbsp;</div></td>
  </tr>
   <tr>
   <td colspan="4" align="center"><div id="registros" >&nbsp;</div></td>
  </tr>
   </table>
</form></div></div></div></div>


 

<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>