<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
class ctrl{
   private $modelo;
   private $objResponse;

   function __construct(){
      $this->modelo=new mod();
      $this->objResponse = new xajaxResponse();
   }

   function iload($aFormValues)
   {
         return $this->objResponse;
     }
   function limpiarformulario()
   {
     $this->objResponse->assign("id","value","");
     $this->objResponse->assign("anterior","value","");
     $this->objResponse->assign("actual","value","");
     $this->objResponse->assign("confirmar","value","");

   }
   function guardarformulario($aFormValues)
   {
      $msg_actualizado='Actualizado con Exito';
      
      $msg_no_actualizado='No ha sido actualizado';
	  
	   $msg_invalido='El password no corresponde';
      if($this->validaciones($aFormValues))
      {
     $this->modelo->setid($aFormValues['id']);
     $this->modelo->setanterior($aFormValues['anterior']);
     $this->modelo->setactual($aFormValues['actual']);
     $this->modelo->setconfirmar($aFormValues['confirmar']);
         
		 $result=new Rs($this->modelo->busqueda());
         if($result->Registros())
         {
		    if($this->modelo->insertar())
            {
               $this->objResponse->assign("mensaje","innerHTML",$msg_actualizado);
               $this->limpiarformulario();
               $this->limpiarmensaje();
            }
			 else
			 {
			  $this->objResponse->assign("mensaje","innerHTML",$msg_no_actualizado);
			   $this->limpiarmensaje();
			 }
         }
		 else
		 {
		  $this->objResponse->assign("mensaje","innerHTML",$msg_invalido);
		   $this->limpiarmensaje();
		 }
		 
          
        
      }
      return $this->objResponse;
   }

   function validaciones($aFormValues)
   {
      $bError =1;
      $n_anterior='Ingrese Contrase&ntilde;a Anterior';
      $n_actual='Ingrese Nueva Contrase&ntilde;a ';
      $n_confirmar='Confirme Contrase&ntilde;a ';

      if ((trim($aFormValues['anterior']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_anterior);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['actual']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_actual);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['confirmar']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_confirmar);
            $this->limpiarmensaje();
            $bError = 0;
         }
		 
		 if (($aFormValues['actual']) <> ($aFormValues['confirmar']))
         {
            $this->objResponse->assign("mensaje","innerHTML","Las Contrasenas no son iguales");
            $this->limpiarmensaje();
            $bError = 0;
         }
		 
		 

         return $bError;
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
