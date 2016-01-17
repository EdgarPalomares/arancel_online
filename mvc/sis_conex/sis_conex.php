<?
   /**********configuraciones*************/
     $titulo='1: Crear Conexion';
     $nombre_boton_guardar='Siguiente->';
     $nombre_boton_buscar='Buscar';

     $campo['id']='id';
     $campo['host']='host';
     $campo['usr']='usr';
     $campo['pass']='pass';
     $campo['bd']='bd';
     $titulo_estilo="";
     $titulo_class="";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_inicio.php";
require("../sis_design/encabezado_vacio.php");
?>
<!--Autogenerado-->
<br/><br/>
 <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       <h3 ><? echo $titulo; ?></h3>
                    </div>
                    <div class="panel-body">
                  
                            <fieldset>
                                <div class="form-group">

<form id="form" name="form" method="post" >
<input type="hidden" id="id" name="id" value="<? echo $_POST["id"]?>" />

<div class="form-group">
  <label>
    <? echo $campo['host']; ?></label><input id="host" name="host" type="text" size="45" class="form-control"   maxlength="45" value="<? echo $_POST['host']?>" />
  </div>
  <div class="form-group">
  <label><? echo $campo['usr']; ?></label><input id="usr" name="usr" type="text" size="45" class="form-control"  maxlength="45" value="<? echo $_POST['usr']?>" />
  <div class="form-group">
  <label><? echo $campo['pass']; ?></label><input id="pass" name="pass" type="password"  size="45" class="form-control"  maxlength="45" value="<? echo $_POST['pass']?>" />
  </tr>
  <div class="form-group">
  <label><? echo $campo['bd']; ?></label><input id="bd" name="bd" type="text" size="45" maxlength="45" class="form-control"  value="<? echo $_POST['bd']?>" />
  </div>
  <div class="form-group">
  <div id="mensaje">&nbsp;</div>
  </div>
  
 
 <div class="panel-footer" align="center"> 
  <input id="ccrear" type="button" name="ccrear" value="Generar"  class="btn btn-primary" Generar onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../sis_cargar_sql/sis_cargar_sql.php">Siguiente-></a></td>
  </div>
 
</form>
<!--Autogenerado-->
 </div>
                </div>
            </div>
        </div>  
<? require("../sis_design/form_pie.php"); ?>