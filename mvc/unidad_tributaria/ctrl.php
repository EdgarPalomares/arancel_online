<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
///////////////configuraciones mensajes validaciones////////////////
      $n_unidad='Ingrese unidad';
      $n_fecha='Ingrese fecha';
/////////////encabezado resultado busqueda grid/////////////////
      $ng_unidad='unidad';
      $ng_fecha='fecha';
      $ng_is_inactiva='is_inactiva';
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
          $_SESSION["modulo_permisos"]='unidad_tributaria';
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
     $this->objResponse->assign("id","value","");
     $this->objResponse->assign("unidad","value","");
     $this->objResponse->assign("fecha","value","");
     $this->objResponse->assign("is_inactiva","value","");

   }
   function validaciones($aFormValues)
   {
           $bError =1;
           global $n_unidad;
      global $n_fecha;
           if ((trim($aFormValues['unidad']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_unidad);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['fecha']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_fecha);
            $this->limpiarmensaje();
            $bError = 0;
         }

              return $bError;
   }
   function guardarformulario($aFormValues)
   {
      $msg_insertado='Almacenado con Exito';
      $msg_registro_existente='El registro ya existe';
      $msg_actualizado='Actualizado con Exito';
      if($this->validaciones($aFormValues))
      {
          $this->modelo->setid($aFormValues['id']);
          $this->modelo->setunidad($aFormValues['unidad']);
          $this->modelo->setfecha($aFormValues['fecha']);
          $this->modelo->setis_inactiva($aFormValues['is_inactiva']);
         if (trim($aFormValues['id']) == "")//nuevo reg
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
      global $ng_unidad;
      global $ng_fecha;
      global $ng_is_inactiva;

if($_SESSION["seleccionar"])
     {
                    $this->modelo->setid($aFormValues['id']);
          $this->modelo->setunidad($aFormValues['unidad']);
          $this->modelo->setfecha($aFormValues['fecha']);
          $this->modelo->setis_inactiva($aFormValues['is_inactiva']);

         $this->modelo->setorder($order);

 $result=new Rs($this->modelo->busqueda());
         $str="
<thead><tr bgcolor='white' ><th width='5%'>#</th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'unidad')\"    >$ng_unidad<img id='imunidad'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'fecha')\"    >$ng_fecha<img id='imfecha'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'is_inactiva')\"    >$ng_is_inactiva<img id='imis_inactiva'></th></tr></thead>";
         $i=0;
      $str.="<tbody>";   
     while($result->Registros())
         {
           $i++;
     $str.="<tr ><td>".$i."</td> <td  >".$result->getCampo('unidad')."</td> <td  >".$result->getCampo('fecha')."</td> <td  >".$result->getCampo('is_inactiva')."</td><td width='5%' onclick='xajax_ctrl.c_ver(".$result->getCampo('id').");' ><i class='fa fa-search'></i></td><td width='5%' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').");' ><i class='fa fa-edit'></i></td><td width='5%' onclick='el(".$result->getCampo('id').");'  ><i class='fa fa-trash-o'></i></td></tr>";
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
              $this->objResponse->assign("form","action","unidad_tributaria.php");

   $this->objResponse->script("document.form.submit();");
               return $this->objResponse;
   }

   function c_f_actualizar($id)
   {
      $this->modelo->setid($id);

      $result=new Rs($this->modelo->buscarid());
      if($result->Registros())
      {

  
      $this->objResponse->assign("mensaje","innerHTML","<input type='hidden' name='id' value='".$result->getCampo('id')."'/>
<input type='hidden' name='unidad' value='".$result->getCampo('unidad')."'/>
<input type='hidden' name='fecha' value='".$result->getCampo('fecha')."'/>
<input type='hidden' name='is_inactiva' value='".$result->getCampo('is_inactiva')."'/>
");

     return $this->objResponse;
     }

   
}

    function c_ver($id)
   {
               $this->c_f_ver($id);
              $this->objResponse->assign("form","action","unidad_tributaria_v.php");

          $this->objResponse->script("document.form.submit();");
               return $this->objResponse;
   }

   function c_f_ver($id)
   {
      $this->modelo->setid($id);

      $result=new Rs($this->modelo->buscar_vst());
      if($result->Registros())
      {

  
      $this->objResponse->assign("mensaje","innerHTML","<input type='hidden' name='id' value='".$result->getCampo('id')."'/>
<input type='hidden' name='unidad' value='".$result->getCampo('unidad')."'/>
<input type='hidden' name='fecha' value='".$result->getCampo('fecha')."'/>
<input type='hidden' name='is_inactiva' value='".$result->getCampo('is_inactiva')."'/>
");

     return $this->objResponse;
     }

   
}

   function c_eliminar($id)
   {
       $bo='false';
       if($_SESSION["eliminar"])
     {
          $this->modelo->setid($id);
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
          $this->modelo->setid($id);
             $bo=$this->modelo->eliminar();

     if ($bo=='false')

	     {

		     $this->objResponse->alert("no es posible eliminar debido a que tiene registros asociados");

	     }

		  $this->objResponse->assign("mensaje","innerHTML","Registro Eliminado");
  
	 $this->objResponse->redirect('unidad_tributaria',2);
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
