<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
///////////////configuraciones mensajes validaciones////////////////
/////////////encabezado resultado busqueda grid/////////////////
      $ng_primer_apellido='primer_apellido';
      $ng_segundo_apellido='segundo_apellido';
      $ng_primer_nombre='primer_nombre';
      $ng_segundo_nombre='segundo_nombre';
      $ng_cod_carrera='cod_carrera';
      $ng_carrera='carrera';
      $ng_cod_sede='cod_sede';
      $ng_sede='sede';
      $ng_estatus='estatus';
/////////////encabezado resultado busqueda grid/////////////////

class ctrl{
   private $modelo;
   private $objResponse;

   function __construct(){
      $this->modelo=new mod();
      $this->objResponse = new xajaxResponse();
   }

   function iload($aFormValues)
   {
         $this->permisos();
         return $this->objResponse;
     }
     function permisos()
     {
          if ($_SESSION['id_usuario']=="")
          {
               $this->objResponse->assign("content","innerHTML","<table border='0' width='300' height='260'  ><tr  ><td align='center' ><h3>Debe Iniciar Sesi&oacute;n para Continuar</h3><td/><tr/></table>");
               $this->objResponse->redirect("../sis_inicio_sesion/inicio.php",3);
          }
          $_SESSION["modulo_permisos"]='vst_estudiantes_pyscde';
          $_SESSION["order"]='';
    $result=new Rs($this->modelo->busqueda_permisos());
          if($result->Registros())
          {
               $_SESSION["insertar"]=$result->getCampo('insertar');
               $_SESSION["actualizar"]=$result->getCampo('actualizar');
               $_SESSION["eliminar"]=$result->getCampo('eliminar');
               $_SESSION["seleccionar"]=$result->getCampo('seleccionar');
               $_SESSION["ejecutar"]=$result->getCampo('ejecutar');
          }
          else
          {
               $_SESSION["insertar"]=0;
               $_SESSION["actualizar"]=0;
               $_SESSION["eliminar"]=0;
               $_SESSION["seleccionar"]=0;
               $_SESSION["ejecutar"]=0;
          }
               return $this->objResponse;
     }
   function limpiarformulario()
   {
     $this->objResponse->assign("cedula","value","");
     $this->objResponse->assign("primer_apellido","value","");
     $this->objResponse->assign("segundo_apellido","value","");
     $this->objResponse->assign("primer_nombre","value","");
     $this->objResponse->assign("segundo_nombre","value","");
     $this->objResponse->assign("cod_carrera","value","");
     $this->objResponse->assign("carrera","value","");
     $this->objResponse->assign("cod_sede","value","");
     $this->objResponse->assign("sede","value","");
     $this->objResponse->assign("estatus","value","");

   }
   function validaciones($aFormValues)
   {
           $bError =1;
                        return $bError;
   }
   function guardarformulario($aFormValues)
   {
      $msg_insertado='Almacenado con Exito';
      $msg_registro_existente='El registro ya existe';
      $msg_actualizado='Actualizado con Exito';
      if($this->validaciones($aFormValues))
      {
          $this->modelo->setcedula($aFormValues['cedula']);
          $this->modelo->setprimer_apellido($aFormValues['primer_apellido']);
          $this->modelo->setsegundo_apellido($aFormValues['segundo_apellido']);
          $this->modelo->setprimer_nombre($aFormValues['primer_nombre']);
          $this->modelo->setsegundo_nombre($aFormValues['segundo_nombre']);
          $this->modelo->setcod_carrera($aFormValues['cod_carrera']);
          $this->modelo->setcarrera($aFormValues['carrera']);
          $this->modelo->setcod_sede($aFormValues['cod_sede']);
          $this->modelo->setsede($aFormValues['sede']);
          $this->modelo->setestatus($aFormValues['estatus']);
         if (trim($aFormValues['cedula']) == "")//nuevo reg
         {
            if($_SESSION["insertar"])
          {
               if($this->modelo->insertar())
                 {
                    $this->objResponse->assign("mensaje","innerHTML",$msg_insertado);
                    $this->limpiarformulario();
                    $this->limpiarmensaje();
                 }
                 else
                 {
                    $this->objResponse->assign("mensaje","innerHTML",$msg_registro_existente);
                    $this->limpiarmensaje();
               	  }
          }
          else
          {
               $this->objResponse->assign("mensaje","innerHTML","Operaci&oacute;n No permitida...");
               $this->limpiarmensaje();
           }
         }
         else
         {
            if($_SESSION["actualizar"])
            {
               if($this->modelo->actualizar())
                 {
                    $this->objResponse->assign("mensaje","innerHTML",$msg_actualizado);
                    $this->limpiarformulario();
                    $this->limpiarmensaje();
               }
               else
               {
                    $this->objResponse->assign("mensaje","innerHTML",$msg_registro_existente);
                         $this->limpiarmensaje();
                }
             }
             else
             {
               $this->objResponse->assign("mensaje","innerHTML","Operaci&oacute;n No permitida...");
               $this->limpiarmensaje();
             }
          }
       }
      return $this->objResponse;
   }

   
function c_busqueda($aFormValues,$order)
   {
      global $ng_primer_apellido;
      global $ng_segundo_apellido;
      global $ng_primer_nombre;
      global $ng_segundo_nombre;
      global $ng_cod_carrera;
      global $ng_carrera;
      global $ng_cod_sede;
      global $ng_sede;
      global $ng_estatus;

if($_SESSION["seleccionar"])
     {
                    $this->modelo->setcedula($aFormValues['cedula']);
          $this->modelo->setprimer_apellido($aFormValues['primer_apellido']);
          $this->modelo->setsegundo_apellido($aFormValues['segundo_apellido']);
          $this->modelo->setprimer_nombre($aFormValues['primer_nombre']);
          $this->modelo->setsegundo_nombre($aFormValues['segundo_nombre']);
          $this->modelo->setcod_carrera($aFormValues['cod_carrera']);
          $this->modelo->setcarrera($aFormValues['carrera']);
          $this->modelo->setcod_sede($aFormValues['cod_sede']);
          $this->modelo->setsede($aFormValues['sede']);
          $this->modelo->setestatus($aFormValues['estatus']);

         $this->modelo->setorder($order);

 $result=new Rs($this->modelo->busqueda());
         $str="
<thead><tr bgcolor='white' ><th width='5%'>#</th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'primer_apellido')\"    >$ng_primer_apellido<img id='imprimer_apellido'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'segundo_apellido')\"    >$ng_segundo_apellido<img id='imsegundo_apellido'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'primer_nombre')\"    >$ng_primer_nombre<img id='imprimer_nombre'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'segundo_nombre')\"    >$ng_segundo_nombre<img id='imsegundo_nombre'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'cod_carrera')\"    >$ng_cod_carrera<img id='imcod_carrera'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'carrera')\"    >$ng_carrera<img id='imcarrera'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'cod_sede')\"    >$ng_cod_sede<img id='imcod_sede'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'sede')\"    >$ng_sede<img id='imsede'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'estatus')\"    >$ng_estatus<img id='imestatus'></th></tr></thead>";
         $i=0;
      $str.="<tbody>";   
     while($result->Registros())
         {
           $i++;
     $str.="<tr ><td>".$i."</td> <td  >".$result->getCampo('primer_apellido')."</td> <td  >".$result->getCampo('segundo_apellido')."</td> <td  >".$result->getCampo('primer_nombre')."</td> <td  >".$result->getCampo('segundo_nombre')."</td> <td  >".$result->getCampo('cod_carrera')."</td> <td  >".$result->getCampo('carrera')."</td> <td  >".$result->getCampo('cod_sede')."</td> <td  >".$result->getCampo('sede')."</td> <td  >".$result->getCampo('estatus')."</td><td width='5%' onclick='xajax_ctrl.c_ver(".$result->getCampo('cedula').");' ><i class='fa fa-search'></i></td><td width='5%' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('cedula').");' ><i class='fa fa-edit'></i></td><td width='5%' onclick='el(".$result->getCampo('cedula').");'  ><i class='fa fa-trash-o'></i></td></tr>";
         }
     $str.="</tbody>";    $this->objResponse->assign("mensaje","innerHTML","<div class='table-responsive'><table class='table table-striped table-bordered table-hover' border='0' width='100%' >$str</table></div>");
       if ((substr($_SESSION['order'], -3, 3))=='asc')
     {
     $this->objResponse->assign("im".(substr($_SESSION['order'], 0, (strpos($_SESSION['order']," ")))),"src","../sis_design/img/up.jpg");
     }
     else
     {
     $this->objResponse->assign("im".(substr($_SESSION['order'], 0, (strpos($_SESSION['order']," ")))),"src","../sis_design/img/down.jpg");
     }  $this->objResponse->assign("registros","innerHTML","Registros: ".$i);
 }
     else
     {
          $this->objResponse->assign("mensaje","innerHTML","Operaci&oacute;n No 

permitida...");
          $this->limpiarmensaje();
     }
      return $this->objResponse;

   }
    function c_actualizar($id)
   {
               $this->c_f_actualizar($id);
              $this->objResponse->assign("form","action","vst_estudiantes_pyscde.php");

   $this->objResponse->script("document.form.submit();");
               return $this->objResponse;
   }

   function c_f_actualizar($id)
   {
      $this->modelo->setcedula($id);

      $result=new Rs($this->modelo->buscarid());
      if($result->Registros())
      {

  
      $this->objResponse->assign("mensaje","innerHTML","<input type='hidden' name='cedula' value='".$result->getCampo('cedula')."'/>
<input type='hidden' name='primer_apellido' value='".$result->getCampo('primer_apellido')."'/>
<input type='hidden' name='segundo_apellido' value='".$result->getCampo('segundo_apellido')."'/>
<input type='hidden' name='primer_nombre' value='".$result->getCampo('primer_nombre')."'/>
<input type='hidden' name='segundo_nombre' value='".$result->getCampo('segundo_nombre')."'/>
<input type='hidden' name='cod_carrera' value='".$result->getCampo('cod_carrera')."'/>
<input type='hidden' name='carrera' value='".$result->getCampo('carrera')."'/>
<input type='hidden' name='cod_sede' value='".$result->getCampo('cod_sede')."'/>
<input type='hidden' name='sede' value='".$result->getCampo('sede')."'/>
<input type='hidden' name='estatus' value='".$result->getCampo('estatus')."'/>
");

     return $this->objResponse;
     }

   
}

    function c_ver($id)
   {
               $this->c_f_ver($id);
              $this->objResponse->assign("form","action","vst_estudiantes_pyscde_v.php");

          $this->objResponse->script("document.form.submit();");
               return $this->objResponse;
   }

   function c_f_ver($id)
   {
      $this->modelo->setcedula($id);

      $result=new Rs($this->modelo->buscar_vst());
      if($result->Registros())
      {

  
      $this->objResponse->assign("mensaje","innerHTML","<input type='hidden' name='cedula' value='".$result->getCampo('cedula')."'/>
<input type='hidden' name='primer_apellido' value='".$result->getCampo('primer_apellido')."'/>
<input type='hidden' name='segundo_apellido' value='".$result->getCampo('segundo_apellido')."'/>
<input type='hidden' name='primer_nombre' value='".$result->getCampo('primer_nombre')."'/>
<input type='hidden' name='segundo_nombre' value='".$result->getCampo('segundo_nombre')."'/>
<input type='hidden' name='cod_carrera' value='".$result->getCampo('cod_carrera')."'/>
<input type='hidden' name='carrera' value='".$result->getCampo('carrera')."'/>
<input type='hidden' name='cod_sede' value='".$result->getCampo('cod_sede')."'/>
<input type='hidden' name='sede' value='".$result->getCampo('sede')."'/>
<input type='hidden' name='estatus' value='".$result->getCampo('estatus')."'/>
");

     return $this->objResponse;
     }

   
}

   function c_eliminar($id)
   {
       $bo='false';
       if($_SESSION["eliminar"])
     {
          $this->modelo->setcedula($id);
             $bo=$this->modelo->eliminar();

     if ($bo=='false')

	     {

		     $this->objResponse->alert("no es posible eliminar debido a que tiene registros asociados");

	     }

	$this->c_busqueda($aFormValues,'');
     }
     else
     {
          $this->objResponse->assign("mensaje","innerHTML","Operaci&oacute;n No permitida...");
          $this->limpiarmensaje();
     }
     return $this->objResponse;
   }
   function c_eliminar_ver($id)
   {
       $bo='false';
       if($_SESSION["eliminar"])
     {
          $this->modelo->setcedula($id);
             $bo=$this->modelo->eliminar();

     if ($bo=='false')

	     {

		     $this->objResponse->alert("no es posible eliminar debido a que tiene registros asociados");

	     }

		  $this->objResponse->assign("mensaje","innerHTML","Registro Eliminado");
  
	 $this->objResponse->redirect('vst_estudiantes_pyscde',2);
     }
     else
     {
          $this->objResponse->assign("mensaje","innerHTML","Operaci&oacute;n No permitida...");
          $this->limpiarmensaje();
     }
     return $this->objResponse;
   }
    function c_order($aFormValues,$order)
   {
           $asc_desc=' asc';
     if($_SESSION['order']==$order.$asc_desc){
          $asc_desc=' desc';
     $_SESSION['order']=$order.$asc_desc;
         }
     else
     {
          $asc_desc=' asc';
     $_SESSION['order']=$order.$asc_desc;
  }
        $order=' order by '.$_SESSION['order'];
   $this->c_busqueda($aFormValues,$order);
      return $this->objResponse;
     }

   


   function limpiarmensaje()
   {
      $this->objResponse->sleep(30);
      $this->objResponse->assign("mensaje","innerHTML","&nbsp;");
   }

}
$xajax->register(XAJAX_CALLABLE_OBJECT,new ctrl());
$xajax->processRequest();
?>
