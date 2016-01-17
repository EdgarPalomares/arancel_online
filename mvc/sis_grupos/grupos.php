<?
   /**********configuraciones*************/
     $titulo='Grupos';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

     $campo['id']='id';
     $campo['nombre']='Grupo';
     $campo['descripcion']='Descripcion';
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
   <td colspan="2" align="center"  ><h3  style="color:#CC3333" class="title"><? echo $titulo; ?></h3></td>
  </tr>
  <tr>
   <td colspan="2" align="right"><input type="hidden" id="id"  name="id" value="<? echo $_POST["id"]?>" /><a href="grupos_buscar.php" ><? echo $nombre_boton_buscar; ?></a></td>
  </tr>
  <tr>
   <td><? echo $campo['nombre']; ?></td><td width="80%"><input id="nombre" name="nombre" type="text" size="67" maxlength="100" value="<? echo $_POST['nombre']?>" /></td>
  </tr>
  <tr>
   <td><? echo $campo['descripcion']; ?></td><td width="80%"><TEXTAREA id="descripcion" name="descripcion" rows="4" cols="50" ><? echo $_POST['descripcion']?></TEXTAREA></td>
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
