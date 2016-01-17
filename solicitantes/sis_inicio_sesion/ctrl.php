<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
//////////////////////////////////
$n_url="../b_solicitud_arancel/solicitud_arancel_buscar.php";
/////////////////////////////////7
class ctrl{
   private $modelo;
   private $objResponse;

   function __construct(){
      $this->modelo=new mod();
      $this->objResponse = new xajaxResponse();
   }

   function iload($aFormValues)
   {
   $_SESSION['id_grupos']="";
   $_SESSION['id_proyecto']="";
   $_SESSION['id_usuario']="";
   $_SESSION['titulo_seleccionado']="";
   
         return $this->objResponse;
     }
   function limpiarformulario()
   {
     $this->objResponse->assign("id","value","");
     $this->objResponse->assign("dependencia","value","");
     $this->objResponse->assign("descripcion","value","");

   }
   function guardarformulario($aFormValues)
   {
   global $n_url;
      $msg_incorrecto='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo Siento!</b> Usuario y/o Contrase&ntilde;a Incorrectas
                                    </div>';
      if($this->validaciones($aFormValues))
      {
     $this->modelo->setid($aFormValues['id']);
     $this->modelo->setdependencia($aFormValues['dependencia']);
     $this->modelo->setdescripcion($aFormValues['descripcion']);
        $result=new Rs($this->modelo->buscar());
           if($result->Registros())
            {
			$_SESSION['id_grupos']=$result->getCampo('id_grupos');
			$_SESSION['id_usuario']=$result->getCampo('id');
      $_SESSION['nombres']=$result->getCampo('nombres').' '.$result->getCampo('apellidos');
               $this->objResponse->assign("content","innerHTML","<div class='left'><table border='0' width='400' height='83'  ><tr  ><td  style='color:#D0D0D0' align='left'  >&nbsp;<h3>Bienvenido</h3><br/><h3>&nbsp;&nbsp;&nbsp;".$result->getCampo('nombres')."<br/>&nbsp;&nbsp;&nbsp;".$result->getCampo('apellidos')."</h3></td></tr></table></div>");
			  $this->objResponse->redirect("$n_url",0);
            }
            else
            {
               $this->objResponse->assign("mensaje","innerHTML",$msg_incorrecto);
			   $this->limpiarformulario();
               $this->limpiarmensaje();
            }
         
         
      }
      return $this->objResponse;
   }

   function validaciones($aFormValues)
   {
      $bError =1;
      $n_dependencia='<div class="alert alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo Siento!</b> Debe ingresar un login!
                                    </div>';
      $n_descripcion='<div class="alert alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo Siento!</b> Debe ingresar una contraseña!
                                    </div>';

      if ((trim($aFormValues['dependencia']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_dependencia);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['descripcion']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_descripcion);
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
