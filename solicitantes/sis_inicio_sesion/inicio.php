<?
session_start();
   /**********configuraciones*************/
     $titulo='Inicio de Sesi&oacute;n';
     $nombre_boton_guardar='Guardar';
     $nombre_boton_buscar='Buscar';

     $campo['id']='id';
     $campo['dependencia']='Login';
     $campo['descripcion']='Password';
/**********configuraciones*************/
?>
<?php
 require("ctrl.php");
 $menu_seleccionado="menu_inicio.php";
require("../sis_design/encabezado_vacio.php");
?>
<!--Autogenerado-->

 
 <div class="form-box" id="login-box" class="bg-gray">
            <div class="header bg-blue">Iniciar Sesion</div>
            <form id="form" name="form" method="post" role="form" >

                <div class="body bg-gray">
                    <div class="form-group">
                         <label><? echo $campo['dependencia']='Ingrese su usuario'; ?></label><input id="dependencia" class="form-control" name="dependencia" type="text" size="40" maxlength="200" value="<? echo $_POST['dependencia']?>" />
                    </div>
                    <div class="form-group">
                        <label><? echo $campo['descripcion']='Ingrese su contraseña'; ?></td><td ><input id="descripcion" class="form-control" name="descripcion" type="password" size="40" maxlength="200" value="<? echo $_POST['dependencia']?>"  />
                    </div>          
                <div class="form-group"><div id="mensaje">&nbsp;</div></div>     
                </div>

                <div class="footer"> 

                    <input id="guardar" type="button" name="guardar" class="btn bg-blue btn-block" value="Entrar" onClick="xajax_ctrl.guardarformulario(xajax.getFormValues('form'));" />  
                    
                    <p><a href="../sis_registro/usuarios.php">Registrarse</a></p>
                    
                    
                </div>
            </form>

            <div class="margin text-center">
                <span>Universidad Nacional Experimental Romulo Gallegos</span>
                <span>Oficina de Secretaria</span><br>
                <img src="../sis_tema/img/unerg.png">
                <br/>
                

            </div>
        </div>


               

<? require("../sis_design/form_pie.php"); ?>
