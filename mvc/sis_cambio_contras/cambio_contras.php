<?
   /**********configuraciones*************/
     $titulo='Cambio Contrase&ntilde;a';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

     $campo['id']='id';
     $campo['anterior']='Contrase&ntilde;a Anterior';
     $campo['actual']='Nueva Contrase&ntilde;a';
     $campo['confirmar']='Confirmar Contrase&ntilde;a ';
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_sistema.php";
require("../sis_design/encabezado.php");
?>
<!--Autogenerado-->

<form id="form" name="form" method="post" >
<div class="col-lg-5"><div class="panel panel-primary"><div class="panel-heading"><h4><? echo $titulo; ?></h4></div><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />

  <div class="form-group">
     <label><? echo $campo['anterior']; ?></label><input id="anterior" class="form-control" name="anterior" type="password" size="40" maxlength="40" value="<? echo $_POST['anterior']?>" />
  </div>
  <div class="form-group">
     <label><? echo $campo['actual']; ?></label><input id="actual" name="actual" class="form-control" type="password"  size="40" maxlength="40" value="<? echo $_POST['actual']?>" />
  </tr>
  <div class="form-group">
     <label><? echo $campo['confirmar']; ?></label><input id="confirmar" class="form-control" name="confirmar"  type="password"  size="40" maxlength="40" value="<? echo $_POST['confirmar']?>" />
  </div>
  <div class="form-group">
     <div id="mensaje">&nbsp;</div>
  </div>
 <div  class="panel-footer" align="center">
      <input id="guardar" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>"  class="btn btn-primary" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" />
  </div>

</form>
<!--Autogenerado-->
</div></div></div></div></div>
<? require("../sis_design/form_pie.php"); ?>