<?
   /**********configuraciones*************/
     $titulo='Busqueda de M&oacute;dulos';
     $nombre_b_buscar='Buscar';

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

<form id="form" name="form" method="post" action="modulos.php">
 <table width="570" cellpadding="0" cellspacing="0" border="0">
  <tr>
   <td colspan="4" align="center" background="../tema/images/menu2.jpg" ><h3  style="color:#CC3333" class="title"><? echo $titulo; ?></h3></td>
  </tr>
  <tr>
   <td colspan="4" align="right"><input type="hidden" name="id" value="<? echo $_POST["id"]?>" /><a href="modulos_buscar.php" ><? echo $nombre_boton_buscar; ?></a></td>
  </tr>
  <tr>
  
   <td><? echo $campo['modulo']; ?></td>
  
   <td><? echo $campo['descripcion']; ?></td>
  </tr>
  <tr>
  
   <td width="100%"><input id="modulo" name="modulo" type="text" size="30" maxlength="100" value="<? echo $_POST['modulo']?>" /></td>
  
  
   <td width="100%"><input id="descripcion" name="descripcion" type="text" size="30" maxlength="200" value="<? echo $_POST['descripcion']?>" /></td>
  
<td ><input id="buscar" type="button" name="buscar" value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'));"></td>  </tr>
  <tr>
   
  </tr>
  <tr>
   <td colspan="4" align="center"><div id="mensaje" style=" padding : 4px; width : 100%px; height : 170px; overflow : auto; ">&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="4" align="center"><div id="grid">&nbsp;</div></td>
  </tr>
   </table>
</form>
<table height="50"></table>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>
