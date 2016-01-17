<!DOCTYPE html>
<?php session_start();?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php $xajax->printJavascript('../../lib/');?>
        <link rel="icon" type="image/ico" href="../sis_tema/img/favicon.ico" />

        <title>Secretaría</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../sis_tema/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../sis_tema/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../sis_tema/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style  -->
        <link href="../sis_tema/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        
    <link rel="stylesheet" type="text/css" media="all" href="../../lib/jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="../../lib/jscalendar/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="../../lib/jscalendar/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../../lib/jscalendar/calendar-setup.js"></script>


<script type="text/javascript">
 function isnum(evt,el)  
 {  
     //Validar la existencia del objeto event  
     evt = (evt) ? evt : event;  
       
     //Extraer el codigo del caracter de uno de los diferentes grupos de codigos  
     var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));  
       
     //Predefinir como valido  
     var respuesta = true;  
       
     //Validar si el codigo corresponde a los NO aceptables  
     if  (charCode ==13)   
     {   //alert
        
      }
     if (charCode > 31 && (charCode < 48 || charCode > 57))   
     {  
         //Asignar FALSE a la respuesta si es de los NO aceptables  
         respuesta = false;  
     }  
       
     //Regresar la respuesta  
     return respuesta;  
}  



///////////////////////////////validaciones de numeros y cantidades
// version: beta
// created: 2005-08-30
// updated: 2005-08-31
// mredkj.com
function extractNumber(obj, decimalPlaces, allowNegative)
{
    var temp = obj.value;
    
    // avoid changing things if already formatted correctly
    var reg0Str = '[0-9]*';
    if (decimalPlaces > 0) {
        reg0Str += '\\.?[0-9]{0,' + decimalPlaces + '}';
    } else if (decimalPlaces < 0) {
        reg0Str += '\\.?[0-9]*';
    }
    reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
    reg0Str = reg0Str + '$';
    var reg0 = new RegExp(reg0Str);
    if (reg0.test(temp)) return true;

    // first replace all non numbers
    var reg1Str = '[^0-9' + (decimalPlaces != 0 ? '.' : '') + (allowNegative ? '-' : '') + ']';
    var reg1 = new RegExp(reg1Str, 'g');
    temp = temp.replace(reg1, '');

    if (allowNegative) {
        // replace extra negative
        var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
        var reg2 = /-/g;
        temp = temp.replace(reg2, '');
        if (hasNegative) temp = '-' + temp;
    }
    
    if (decimalPlaces != 0) {
        var reg3 = /\./g;
        var reg3Array = reg3.exec(temp);
        if (reg3Array != null) {
            // keep only first occurrence of .
            //  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
            var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
            reg3Right = reg3Right.replace(reg3, '');
            reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
            temp = temp.substring(0,reg3Array.index) + '.' + reg3Right;
        }
    }
    
    obj.value = temp;
}
function blockNonNumbers(obj, e, allowDecimal, allowNegative)
{
    var key;
    var isCtrl = false;
    var keychar;
    var reg;
        
    if(window.event) {
        key = e.keyCode;
        isCtrl = window.event.ctrlKey
    }
    else if(e.which) {
        key = e.which;
        isCtrl = e.ctrlKey;
    }
    
    if (isNaN(key)) return true;
    
    keychar = String.fromCharCode(key);
    
    // check for backspace or delete, or if Ctrl was pressed
    if (key == 8 || isCtrl)
    {
        return true;
    }

    reg = /\d/;
    var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
    var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;
    
    return isFirstN || isFirstD || reg.test(keychar);
}
///////////////////////////////



function el(id)
{
var resp=confirm("¿Desea Eliminar?");
    if (resp)
    {
        xajax_ctrl.c_eliminar(id);
    }
}

function el_order(campo)
{
        alert(campo);
        //xajax_ctrl.c_order(campo);
    
}

function el_ver(id)
{
var resp=confirm("¿Desea Eliminar?");
    if (resp)
    {
        xajax_ctrl.c_eliminar_ver(id);
    }
}
 

</script>
 <?php 
session_start();

if (isset($_SESSION['login']))  
{ 
$_SESSION['username']=$_REQUEST['dependencia']; 

    
    } 


 ?>

    </head>
    <body onload="xajax_ctrl.iload(xajax.getFormValues('form'));" class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a  class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <i class="fa fa-folder-open"></i>Secretaría
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                          <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                
                            </a>
                            </li>
                        <div class="navbar-right">
                    <ul class="nav navbar-nav">
                    <?php //Iniciar Sesión
    //Configuracion de la conexion a base de datos
  $bd_host = "localhost"; 
  $bd_usuario = "root"; 
  $bd_password = "1234"; 
  $bd_base = "arancel_online_bd"; 
 
//$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
//mysql_select_db($bd_base, $conn); 
//consulta titular
    //Proceso de conexión con la base de datos
    //Validar si se está ingresando con sesión correctamente
    
  
    if($_SESSION['nombres']<>"") {
    ?> 
               
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION["nombres"]; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../sis_tema/img/usuario.png" class="img-circle" alt="User Image" />
                                    <p>

                                         <?php echo $_SESSION["nombres"]; ?></small></li> <?php }  ?>
                                        
                                    </p>
                                </li>
                                <!-- Menu Body -->
                               
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    
                                    <div class="pull-right">
                                        <a href="../sis_inicio_sesion/inicio.php" class="btn btn-default btn-flat" ><i class="fa fa-sign-out"></i>Cerrar Sesi&oacute;n</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                        <!-- Messages: style can be found in dropdown.less-->
                
                        <!-- Notifications: style can be found in dropdown.less -->
                       <!--
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Falta Verificar 10 Centros de Votacion</li>
                                <li>
                                   
                                    <ul class="menu">                                     
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i>Tiene Militantes sin Centro de Votaci&oacute;n 
                                        </li>
                                        
                                    </ul>
                                </li>
                                
                            </ul>
                        </li>
                         -->
                
                        <!-- User Account: style can be found in dropdown.less -->
                        
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
             
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                     <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../sis_tema/img/usuario.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $_SESSION['nombres'];?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    
                       
                  
                    <!-- search form -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                    <li class="active">
                            <a href="../solicitud_arancel/solicitud_arancel_buscar.php">
                                <i class="fa fa-home"></i> <span>Inicio</span>
                            </a>
                        </li>					
					<? require("menu/menu_principal.php"); ?>
					</ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                  <section class="content-header">
                   <!-- <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>-->
                </section>
                <section class="content">
