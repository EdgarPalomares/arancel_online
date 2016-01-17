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
     $campo['login']='Email';
    $campo['telefono']='Telefono';
     $campo['correo']='email';
     
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");

require("../sis_design/encabezado_vacio.php");
?>
<? if ($_SESSION["id_grupos"]<=2){?>
<!--Autogenerado-->
 <div class="form-box">
    <div class="panel panel-primary">
      <div class="header bg-blue">
          <h4> <? echo $titulo; ?></h4>
      </div>
      
      
 <div class="body bg-gray">

<form id="form" name="form" method="post" role="form" >
 
   
    <div class="form-group">
    <label><? echo $campo['cedula']; ?></label>
  <input  class="form-control" id="cedula" name="cedula" type="text"  value="<? echo $_POST['cedula']?>" tabindex="2" onblur="xajax_ctrl.buscar_cn(xajax.getFormValues('form'));"  />
   </div>
<input type="hidden" id="id" name="id" value="<? echo $_POST["id"]?>" />
  <div class="form-group"><label><? echo $campo['apellidos']; ?></label><input  class="form-control" id="apellidos" name="apellidos" required type="text" size="60" maxlength="60" value="<? echo $_POST['apellidos']?>" tabindex="3"/></div>
    <div class="form-group"><label><? echo $campo['nombres']; ?></label><input  class="form-control" id="nombres" name="nombres" required type="text" size="60" maxlength="60" value="<? echo $_POST['nombres']?>" tabindex="4" /></label>
    <div class="form-group"><label><? echo $campo['login']; ?></label><input  class="form-control" id="login" name="login" type="email" required size="60" maxlength="60" value="<? echo $_POST['login']?>" tabindex="5"/></div>
    <div class="form-group"><label><? echo $campo['telefono']; ?></label><input  class="form-control" id="telefono" name="telefono" type="number" required size="60" maxlength="60" value="<? echo $_POST['telefono']?>" tabindex="5"/></div>
   
  
  
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