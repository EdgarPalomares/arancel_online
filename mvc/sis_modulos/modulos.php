<?
   /**********configuraciones*************/
     $titulo='M&oacute;dulos';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

     $campo['id']='id';
     $campo['modulo']='M&oacute;dulo';
     $campo['descripcion']='Descripci&oacute;n';
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_sistema.php";
require("../sis_design/encabezado.php");
?>
<!--Autogenerado-->

<form id="form" name="form" method="post" >
 <table width="570" cellpadding="0" cellspacing="0" border="0">
  <tr>
   <td colspan="2" align="center" background="../tema/images/menu2.jpg" ><h3  style="color:#CC3333" class="title"><? echo $titulo; ?></h3></td>
  </tr>
  <tr>
   <td colspan="2" align="right"><input type="hidden" id="id" name="id" value="<? echo $_POST["id"]?>" /><a href="modulos_buscar.php" ><? echo $nombre_boton_buscar; ?></a></td>
  </tr>
  <tr>
   <td><? echo $campo['modulo']; ?></td><td width="80%"><input id="modulo" name="modulo" type="text" size="60" maxlength="100" value="<? echo $_POST['modulo']?>" /></td>
  </tr>
  <tr>
   <td><? echo $campo['descripcion']; ?></td><td width="80%"><input id="descripcion" name="descripcion" type="text" size="60" maxlength="200" value="<? echo $_POST['descripcion']?>" /></td>
  </tr>
  <tr>
   <td>&nbsp;</td>
  </tr>
  <tr>
   <td colspan="2" align="center"><div id="mensaje">&nbsp;</div></td>
  </tr>
  <tr>
   <td colspan="2" align="center"><input id="guardar" type="button" name="guardar" value="<? echo $nombre_boton_guardar; ?>" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" /></td>
  </tr>
 </table>
</form>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>
