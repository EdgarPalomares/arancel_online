<?
   /**********configuraciones*************/
     $titulo='Busqueda de Usuarios';
     $nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['apellidos']='Apellidos';
     $campo['nombres']='Nombres';
     $campo['nombre']='Grupo';
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_sistema.php";
require("../sis_design/encabezado.php");
?>
<!--Autogenerado-->
 <div class="col-lg-8">
    <div class="panel panel-primary">
      <div class="panel-heading">
          <h4> <? echo $titulo; ?></h4>
      </div>
      <div class="panel-body">
      <div class="row">
  <div class="col-lg-12">
<form id="form" name="form" method="post" action="usuarios.php"  role="form">
 <div class="form-group" align="right">
  <a href="usuarios.php" ><i class="fa fa-file-o"></i>Nuevo</a>
</div>
 <table border="0"> 
  <tr>  
   <td><? echo $campo['nombres']; ?></td>
   <td><? echo $campo['apellidos']; ?></td>
  
   <td><? echo $campo['nombre']; ?></td>
  </tr>
  <tr>
   <td ><input id="nombres" class="form-control" name="nombres" type="text"  maxlength="60" value="<? echo $_POST['nombres']?>" /></td>
   <td  ><input id="apellidos"  class="form-control"name="apellidos" type="text"  maxlength="60" value="<? echo $_POST['apellidos']?>" /></td>
   
   <td ><input id="nombre"  class="form-control"name="nombre" type="text" maxlength="100" value="<? echo $_POST['nombre']?>" /></td>
  
<td ><input id="buscar" type="button" class="btn btn-primary"  name="buscar" value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'));"></td>  </tr>
  <tr>
   <td colspan="5" align="center"><hr/></td>
  </tr>

  <tr>
   <td colspan="5" align="center"><div id="mensaje">&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="5" align="center"><div id="grid">&nbsp;</div></td>
  </tr>
   </table>

</form>

 </div>
 </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>
