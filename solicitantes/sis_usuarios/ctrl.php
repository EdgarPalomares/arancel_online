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
     $this->c_id_grupos($aFormValues['h_id_grupos']);
	 $this->c_accesos();
         return $this->objResponse;
     }
	 	function c_accesos()
   {
       if ($_SESSION['id_usuario']=="")
	   {
	  
	     $this->objResponse->assign("content","innerHTML","<table border='0' width='300' height='260'  ><tr  ><td align='center' ><h3>Debe Iniciar Sesi&oacute;n para Continuar</h3><td/><tr/></table>");
			  $this->objResponse->redirect("../sis_inicio_sesion/inicio.php",3);
		 }	  
			  
		 $result=new Rs($this->modelo->accesos());
        $_SESSION['seleccionar']='';
		$_SESSION['insertar']='';
		$_SESSION['eliminar']='';
		$_SESSION['actualizar']='';
		$_SESSION['ejecutar']='';
         if($result->Registros())
         {
		 $_SESSION['seleccionar']=$result->getCampo('seleccionar');
		  $_SESSION['insertar']=$result->getCampo('insertar');
		   $_SESSION['eliminar']=$result->getCampo('eliminar');
		    $_SESSION['actualizar']=$result->getCampo('actualizar');
			 $_SESSION['ejecutar']=$result->getCampo('ejecutar');
			}
		return $this->objResponse;
	}
	
   function limpiarformulario()
   {
     $this->objResponse->assign("id","value","");
     $this->objResponse->assign("id_grupos","value","");
     $this->objResponse->assign("cedula","value","");
     $this->objResponse->assign("apellidos","value","");
     $this->objResponse->assign("nombres","value","");
     $this->objResponse->assign("login","value","");


   }
   function guardarformulario($aFormValues)
   {
      $msg_insertado='Almacenado con Exito';
      $msg_registro_existente='El registro ya existe';
      $msg_actualizado='Actualizado con Exito';
      if($this->validaciones($aFormValues))
      {
     $this->modelo->setid($aFormValues['id']);
     $this->modelo->setid_grupos($aFormValues['id_grupos']);
     $this->modelo->setcedula($aFormValues['cedula']);
     $this->modelo->setapellidos($aFormValues['apellidos']);
     $this->modelo->setnombres($aFormValues['nombres']);
     $this->modelo->setlogin($aFormValues['login']);
    
         if (trim($aFormValues['id']) == "")//nuevo reg
         {
		 
			 if( $_SESSION['insertar'])
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
				   $this->objResponse->assign("mensaje","innerHTML","Operaci&oacute;n No Permitida");
				   $this->limpiarmensaje();
			}
         }
         else
         {
		   if( $_SESSION['actualizar'])
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
				   $this->objResponse->assign("mensaje","innerHTML","Operaci&oacute;n No Permitida");
				   $this->limpiarmensaje();
			}
         }
      }
      return $this->objResponse;
   }

function restablecer($aFormValues)
   {
      $msg_restablecer='Restablecida con Exito';
	 
    
     
     $this->modelo->setid($aFormValues['id']);
	 
   
       
           if($this->modelo->restablecer_pas())
            {
               $this->objResponse->assign("mensaje","innerHTML",$msg_restablecer);
               $this->limpiarformulario();
               $this->limpiarmensaje();
            }
            
       
    
      return $this->objResponse;
   }
   
   function validaciones($aFormValues)
   {
      $bError =1;
      $n_id_grupos='Seleccione el Grupo';
      $n_cedula='Ingrese Cedula';
      $n_apellidos='Ingrese Apellidos';
      $n_nombres='Ingrese Nombres';
      $n_login='Ingrese login';
      
      if ((trim($aFormValues['id_grupos']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_grupos);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['cedula']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_cedula);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['apellidos']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_apellidos);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['nombres']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_nombres);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['login']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_login);
            $this->limpiarmensaje();
            $bError = 0;
         }

    

         return $bError;
   }
   function c_busqueda($aFormValues)
   {
    if ($_SESSION['seleccionar'])
	 {
              $this->modelo->setid($aFormValues['id']);
     $this->modelo->setid_grupos($aFormValues['id_grupos']);
     $this->modelo->setcedula($aFormValues['cedula']);
     $this->modelo->setapellidos($aFormValues['apellidos']);
     $this->modelo->setnombres($aFormValues['nombres']);
     $this->modelo->setlogin($aFormValues['login']);
   
     $this->modelo->setnombre($aFormValues['nombre']);

         $result=new Rs($this->modelo->busqueda());
         $str=" <thead><tr > <th>Nombres</th><th>Apellidos</th>  <th>Grupo</th></tr></thead>";
         while($result->Registros())
         {
           $str.=" <tbody><tr  ><td width='30%'>".$result->getCampo('nombres')."</td> <td width='30%'>".$result->getCampo('apellidos')."</td>  <td width='30%'>".$result->getCampo('nombre')."</td>";
		 if ($_SESSION['actualizar']) 
			   {
			   $str.="<td width='5%' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').");' ><i class='fa fa-edit'></i></td>";
			   }
			   
			    if ($_SESSION['eliminar'])
			   {
			   $str.=" <td width='5%' onclick='el(".$result->getCampo('id').");'  ><i class='fa fa-trash-o'></i></td>";
			   }
			    
		$str.="</tr></tbody>";
			}	   
         }
		else
		{
			$this->objResponse->alert("Operacion no Permitida...!");
		}
         $this->objResponse->assign("mensaje","innerHTML","<div class='table-responsive'><table class='table table-striped table-bordered table-hover' >$str</table></div>");
      return $this->objResponse;

   }
   function c_actualizar($id)
   {
               $this->c_f_actualizar($id);
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
<input type='hidden' name='id_grupos' value='".$result->getCampo('id_grupos')."'/>
<input type='hidden' name='cedula' value='".$result->getCampo('cedula')."'/>
<input type='hidden' name='apellidos' value='".$result->getCampo('apellidos')."'/>
<input type='hidden' name='nombres' value='".$result->getCampo('nombres')."'/>
<input type='hidden' name='login' value='".$result->getCampo('login')."'/>
");

     return $this->objResponse;
     }

   
	    }

   function c_eliminar($id)
   {
      $this->modelo->setid($id);
  
	 $bo=$this->modelo->eliminar();

     if ($bo=='false')

	{

		$this->objResponse->alert("no es posible eliminar debido a que tiene registros asociados");

	}

	$this->c_busqueda($aFormValues);
     return $this->objResponse;
   }
   function limpiarmensaje()
   {
      $this->objResponse->sleep(30);
      $this->objResponse->assign("mensaje","innerHTML","&nbsp;");
   }
   function c_id_grupos($id)
   {
      $result=new Rs($this->modelo->m_id_grupos());
         $str="<select id='id_grupos' name='id_grupos'  class='form-control'  tabindex='1'><option value=''>Seleccione</option>";
         while($result->Registros())
          {
            		$str.="<option value='".$result->getCampo('id')."'";
          if ($id==$result->getCampo('id')){
     $str.=" selected";
          }
    $str.=">".$result->getCampo('descripcion')."</option>";
  }
          $str.="</select>";
          $this->objResponse->assign("d_id_grupos","innerHTML",$str);
           return $this->objResponse;

 ;      }
}
function c_ver($id)
   {
               $this->c_f_ver($id);
              $this->objResponse->assign("form","action","usuarios_v.php");

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
<input type='hidden' name='usuario' value='".$result->getCampo('usuario')."'/>
");

     return $this->objResponse;
     }

   
}


function buscar_carrera(){


  
}
$xajax->register(XAJAX_CALLABLE_OBJECT,new ctrl());
$xajax->processRequest();
?>