<?
   /**********configuraciones*************/
     $titulo='Permisos';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

     $campo['id']='id';
     $campo['id_grupos']='Grupo';
     $campo['id_modulos']='id_modulos';
     $campo['seleccionar']='seleccionar';
     $campo['insertar']='insertar';
     $campo['actualizar']='actualizar';
     $campo['eliminar']='eliminar';
     $campo['ejecutar']='ejecutar';
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_sistema.php";
require("../sis_design/encabezado.php");
?>
 <div class="col-md-10">
    <div class="box box-primary">
      <div class="box-header">
         <center> <h4><i class="fa fa-users"></i> <? echo $titulo; ?></h4></center>
      </div>
      <div class="panel-body">
      <div class="row">
  <div class="col-lg-12">
<form id="form" name="form" method="post" role="form" >

<!--Autogenerado-->
<? if ($_SESSION["id_grupos"]<=2){?>
<form id="form" name="form" method="post" >
 <input type="hidden" id="id" name="id" value="<? echo $_POST["id"]?>" />

 <div class="form-group">
<label><? echo $campo['id_grupos']; ?></label>
<div id='d_id_grupos'></div>
</div>


  <input id="h_id_grupos" name="h_id_grupos" type="hidden"  value="<? echo $_POST['id_grupos']?>" />
 
 <div class="form-group"> 
   <div id='d_permisos' ></div>

 </div>
  
 <div class="form-group">
  <div id="mensaje" ></div>

  </div>
 
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
<? } ?> 
<? require("../sis_design/form_pie.php"); ?>