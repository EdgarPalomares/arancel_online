<?
   /**********configuraciones*************/
     $titulo='Relaciones entre  Tablas';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

     $campo['id']='id';
     $campo['id_sis_tablas']='Tabla';
     $campo['id_sis_tablas_relacion']='Tabla B&aacute;sica de:';
     $titulo_estilo="";
     $titulo_class="";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_sistema.php";
require("../sis_design/encabezado.php");
?>
<!--Autogenerado-->
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
   <a href="sis_relaciones.php" ><i class="fa fa-file-o"></i>Nuevo</a> | <a href="sis_relaciones_buscar.php" ><i class="fa fa-search"></i><? echo $nombre_boton_buscar; ?></a>
</div>

<input type="hidden" id="id" name="id" value="<? echo $_POST["id"]?>" />
 
 <div class="form-group">
    <label><? echo $campo['id_sis_tablas']; ?></label><div id='d_id_sis_tablas'></div>
  </div>



  <input id="h_id_sis_tablas" name="h_id_sis_tablas" type="hidden"  value="<? echo $_POST['id_sis_tablas']?>" />
 
 <div class="form-group">
    <label><? echo $campo['id_sis_tablas_relacion']; ?></label><div id='d_id_sis_tablas_relacion'></div>
   </div>  
  <input id="h_id_sis_tablas_relacion" name="h_id_sis_tablas_relacion" type="hidden"  value="<? echo $_POST['id_sis_tablas_relacion']?>" />
 
<div class="form-group">
 <div id="mensaje">&nbsp;</div>

 </div>  

<div class="form-group">  
 <input id="guardar"  class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" />
</div>  

</form>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>