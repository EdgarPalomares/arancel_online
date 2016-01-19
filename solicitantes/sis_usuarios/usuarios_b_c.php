<?
   /**********configuraciones*************/
     $titulo='Usuarios';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

     $campo['id']='id';
     $campo['id_grupos']='Grupo';
     $campo['cedula']='Cedula';
     $campo['apellidos']='Apellidos';
     $campo['nombres']='Nombres';
     $campo['login']='login';
     
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_sistema.php";
require("../sis_design/encabezado.php");
?>
<? if ($_SESSION["id_grupos"]<=2){?>
<!--Autogenerado-->
 <div class="col-lg-8">
    <div class="panel panel-primary">
      <div class="panel-heading">
          <h4> <? echo $titulo; ?></h4>
      </div>
      <div class="panel-body">
      <div class="row">
  <div class="col-lg-12">
<form id="form" name="form" method="post" role="form" >
 <div class="form-group" align="right">
   <a href="usuarios.php" ><i class="fa fa-file-o"></i>Nuevo</a> | <a href="usuarios_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a>
</div>
   <div class="form-group">
    <label><? echo $campo['id_grupos']; ?></label>
    <div id='d_id_grupos'></div>
      <input id="h_id_grupos" name="h_id_grupos" type="hidden"  value="<? echo $_POST['id_grupos']?>" />
  </div>
    <div class="form-group">
    <label><? echo $campo['cedula']; ?></label>
  <input  class="form-control" id="cedula" name="cedula" type="text"  value="<? echo $_POST['cedula']?>" tabindex="2"  />
   </div>
<input type="hidden" id="id" name="id" value="<? echo $_POST["id"]?>" />
  <div class="form-group"><label><? echo $campo['apellidos']; ?></label><input  class="form-control" id="apellidos" name="apellidos" type="text" size="60" maxlength="60" value="<? echo $_POST['apellidos']?>" tabindex="3"/></div>
    <div class="form-group"><label><? echo $campo['nombres']; ?></label><input  class="form-control" id="nombres" name="nombres" type="text" size="60" maxlength="60" value="<? echo $_POST['nombres']?>" tabindex="4" /></label>
    <div class="form-group"><label><? echo $campo['login']; ?></label><input  class="form-control" id="login" name="login" type="text" size="60" maxlength="60" value="<? echo $_POST['login']?>" tabindex="5"/></div>


  
  
  <? if($_POST["id"]){?>
   <div class="form-group">
 <input id="restableceer" class="btn btn-primary"  type="button" name="restablecer" value="Restabecer Contrase&ntilde;a"  onClick="xajax_ctrl.restablecer(xajax.getFormValues('form'));" />
</div>  
   <? }?>
  
  <div id="mensaje" >&nbsp;</div>

   <div class="panel-footer" align="center">
  <input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></td>
 </div>

</form>
 </div>
 </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <? } ?> 
<? require("../sis_design/form_pie.php"); ?>