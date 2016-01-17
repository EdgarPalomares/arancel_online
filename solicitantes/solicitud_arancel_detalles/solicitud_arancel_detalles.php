<?
   /**********configuraciones*************/
     $titulo='Realice su Solicitud';
     $nombre_boton_guardar='+ Agregar';
     $nombre_boton_buscar='Buscar';

$nombre_b_insertar='Nuevo';

     $campo['id']='id';
     $campo['id_solicitud_arancel']='Solicitud Arancel';
     $campo['id_arancel']='Arancel';
     $campo['cantidad']='Cantidad';
     $titulo_estilo="";
     $titulo_class="";
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
$menu_seleccionado='menu_solicitudes.php';
 require("../sis_design/encabezado.php");
 ?>
 
 <!--Autogenerado-->

<form id="form" role="form" name="form" method="post" >
 
 <div class="col-md-12"><div class="box box-primary"><center><div class="box-header"><h4 class="box-title"> <? echo $titulo; ?></h4></div></center><div class="panel-body"><div class="row"><div class="col-lg-12"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]; ?>" />

   <div id="ronald" name="ronald"></div>
  </div>
  
  <div class="form-group">
   <label><? echo $campo['id_arancel']; ?></label><div id='d_id_arancel'>
  </div>
  <input class="form-control" id="h_id_arancel" name="h_id_arancel" type="hidden"  value="<? echo $_POST['id_arancel']?>" />
  <div class="form-group">
   <label><? echo $campo['cantidad']; ?></label><input class="form-control" id="cantidad" name="cantidad" type="text" size="" maxlength="" value="<? echo $_POST['cantidad']?>" onblur="extractNumber(this,0,true);" onkeyup="extractNumber(this,0,true);" onkeypress="return blockNonNumbers(this, event, true, true);"/>
  </div>
   <div class="form-group">
   <input id="guardar" class="btn btn-primary" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" />
  </div>
  <div class="form-group">
  <hr>
  </div>
  
   
  
  
   <div class="form-group"><div id="mensaje">&nbsp;</div></div> <div class="panel-footer" align="center"><input id="finalizar" class="btn btn-primary" type="button" name="finalizar" value="Guardar e Imprimir Arancel" onClick="xajax_ctrl.finalizar_arancel();" /></div>
</form></div></div></div></div></div>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>