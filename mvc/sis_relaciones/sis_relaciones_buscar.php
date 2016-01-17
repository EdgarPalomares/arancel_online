<?
   /**********configuraciones*************/
     $titulo='B&uacute;squeda de Relaciones';
     $nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['tabla']='Tabla';
     $campo['tabla_relacion']='Tabla relacion';
     $titulo_estilo="";
     $titulo_class="";
     $width="720px";
     $height="240px";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_sistema.php";
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
 <div class="col-lg-9">
    <div class="panel panel-primary">
      <div class="panel-heading">
          <h4> <? echo $titulo; ?></h4>
      </div>
      <div class="panel-body">
      <div class="row">
  <div class="col-lg-12">
<form id="form" name="form" method="post" action="sis_relaciones.php"  role="form">
 <div class="form-group" align="right">
  <a href="sis_relaciones.php" ><i class="fa fa-file-o"></i>Nuevo</a>
</div>
 <table border="0"> 

   <td><? echo $campo['tabla']; ?></td>
  
   <td><? echo $campo['tabla_relacion']; ?></td>
  </tr>
  <tr>
  
   <td width="100%"><input id="tabla" name="tabla" type="text" class="form-control" maxlength="100" value="<? echo $_POST['tabla']?>" /></td>
  
  
   <td width="100%"><input id="tabla_relacion" name="tabla_relacion" type="text" class="form-control" maxlength="100" value="<? echo $_POST['tabla_relacion']?>" /></td>
  
<td ><input id="buscar" type="button" name="buscar" class="btn btn-primary"  value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'));"></td>  </tr>
   <tr>
   <td colspan="5" align="center"><hr/></td>
  </tr>
  <tr>
   <td colspan="4" align="center"><div id="mensaje" style="   padding : 4px; width : <? echo $width?>; height : <? echo $height?>; overflow : auto; ">&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="4" align="center"><div id="grid" style="   padding : 4px; width : $width; height : $height; overflow : auto; ">&nbsp;</div></td>
  </tr>
   </table>
</form>
<!--Autogenerado-->

 </div>
 </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
<? require("../sis_design/form_pie.php"); ?>