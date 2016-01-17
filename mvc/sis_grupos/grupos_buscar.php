<?
   /**********configuraciones*************/
     $titulo='Busqueda de Grupos';
     $nombre_b_buscar='Buscar';

     $campo['id']='id';
     $campo['nombre']='Grupo';
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_sistema.php";
require("../sis_design/encabezado.php");
?>
<!--Autogenerado-->

<form id="form" name="form" method="post" action="grupos.php">
 <table width="570" cellpadding="0" cellspacing="0" border="0">
  <tr>
   <td colspan="3" align="center" background="../tema/images/menu2.jpg" ><h3  style="color:#CC3333"  class="title"><? echo $titulo; ?></h3></td>
  </tr>
  <tr>
   <td colspan="3" align="right"><input type="hidden" name="id" value="<? echo $_POST["id"]?>" /><a href="grupos_buscar.php" ><? echo $nombre_boton_buscar; ?></a></td>
  </tr>
  <tr>
  
   <td><? echo $campo['nombre']; ?></td>
  </tr>
  <tr>
  
   <td width="100%"><input id="nombre" name="nombre" type="text" size="80" maxlength="100" value="<? echo $_POST['nombre']?>" /></td>
  
<td ><input id="buscar" type="button" name="buscar" value="<? echo $nombre_b_buscar; ?>" onClick="xajax_ctrl.c_busqueda(xajax.getFormValues('form'));"></td>  </tr>
  <tr>
   
  </tr>
  <tr>
   <td colspan="3" align="center"><div id="mensaje">&nbsp;</div></td>
  </tr>
   <tr>
   
  </tr>
  <tr>
   <td colspan="3" align="center"><div id="grid">&nbsp;</div></td>
  </tr>
   </table>
    <table height="68"></table>
</form>
<!--Autogenerado-->

<? require("../sis_design/form_pie.php"); ?>
