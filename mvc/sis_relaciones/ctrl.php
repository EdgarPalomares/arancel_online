<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
///////////////configuraciones mensajes validaciones////////////////
      $n_id_sis_tablas='Ingrese la Tabla';
      $n_id_sis_tablas_relacion='Ingrese la Tabla dependiente';
/////////////encabezado resultado busqueda grid/////////////////
      $ng_tabla='Tabla';
      $ng_tabla_relacion='Dependencia';
	  $n_misma_relacion='No es posible establecer esta relaci&oacute;n';
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
     $this->c_id_sis_tablas($aFormValues['h_id_sis_tablas']);
     $this->c_id_sis_tablas_relacion($aFormValues['h_id_sis_tablas_relacion']);
         return $this->objResponse;
     }
     function permisos()
     {
               if ($_SESSION['id_usuario']=="")
          {
               $this->objResponse->assign("content","innerHTML","<table border='0' width='300' height='260'  ><tr  ><td align='center' ><h3>Debe Iniciar Sesi&oacute;n para Continuar</h3><td/><tr/></table>");
               $this->objResponse->redirect("../sis_inicio_sesion/inicio.php",3);
          }
               $_SESSION["insertar"]=1;
               $_SESSION["actualizar"]=1;
               $_SESSION["eliminar"]=1;
               $_SESSION["seleccionar"]=1;
               $_SESSION["ejecutar"]=1;
          
               return $this->objResponse;
     }
   function limpiarformulario()
   {
     $this->objResponse->assign("id","value","");
     $this->objResponse->assign("id_sis_tablas","value","");
     $this->objResponse->assign("id_sis_tablas_relacion","value","");

   }
   function validaciones($aFormValues)
   {
           $bError =1;
           global $n_id_sis_tablas;
           global $n_id_sis_tablas_relacion;
		   
		   global $n_misma_relacion;
           if ((trim($aFormValues['id_sis_tablas']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_sis_tablas);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['id_sis_tablas_relacion']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_sis_tablas_relacion);
            $this->limpiarmensaje();
            $bError = 0;
         }
		 if (((trim($aFormValues['id_sis_tablas_relacion']) == (trim($aFormValues['id_sis_tablas']))) and ($bError ==1)))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_misma_relacion);
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
          $this->modelo->setid_sis_tablas($aFormValues['id_sis_tablas']);
          $this->modelo->setid_sis_tablas_relacion($aFormValues['id_sis_tablas_relacion']);
         if (trim($aFormValues['id']) == "")//nuevo reg
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
       }
      return $this->objResponse;
   }

   
function c_busqueda($aFormValues)
   {
      global $ng_tabla;
      global $ng_tabla_relacion;
	  global $ng_tabla_relacion;
          $this->modelo->setid($aFormValues['id']);
          $this->modelo->setid_sis_tablas($aFormValues['id_sis_tablas']);
          $this->modelo->setid_sis_tablas_relacion($aFormValues['id_sis_tablas_relacion']);
          $this->modelo->settabla($aFormValues['tabla']);
          $this->modelo->settabla_relacion($aFormValues['tabla_relacion']);

         $result=new Rs($this->modelo->busqueda());
         $str="<thead><tr  > <th>$ng_tabla</th> <th>$ng_tabla_relacion</th></tr></thead>";
         while($result->Registros())
         {
           $str.="<tr > <td >".$result->getCampo('tabla')."</td> <td >".$result->getCampo('tabla_relacion')."</td><td width='5%' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').");' ><i class='fa fa-edit'></i></td><td width='5%' onclick='el(".$result->getCampo('id').");'  ><i class='fa fa-trash-o'></i></td></tr>";
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
<input type='hidden' name='id_sis_tablas' value='".$result->getCampo('id_sis_tablas')."'/>
<input type='hidden' name='id_sis_tablas_relacion' value='".$result->getCampo('id_sis_tablas_relacion')."'/>
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
   function c_id_sis_tablas($id)
   {
      $result=new Rs($this->modelo->m_id_sis_tablas());
         $str="<select id='id_sis_tablas' class='form-control' name='id_sis_tablas'><option value=''>Seleccione</option>";
         while($result->Registros())
          {
            		$str.="<option value='".$result->getCampo('id')."'";
          if ($id==$result->getCampo('id')){
     $str.=" selected";
          }
    $str.=">".$result->getCampo('descripcion')."</option>";
  }
          $str.="</select>";
          $this->objResponse->assign("d_id_sis_tablas","innerHTML",$str);
           return $this->objResponse;

 ;      }   function c_id_sis_tablas_relacion($id)
   {
      $result=new Rs($this->modelo->m_id_sis_tablas_relacion());
         $str="<select id='id_sis_tablas_relacion' class='form-control' name='id_sis_tablas_relacion'><option value=''>Seleccione</option>";
         while($result->Registros())
          {
            		$str.="<option value='".$result->getCampo('id')."'";
          if ($id==$result->getCampo('id')){
     $str.=" selected";
          }
    $str.=">".$result->getCampo('descripcion')."</option>";
  }
          $str.="</select>";
          $this->objResponse->assign("d_id_sis_tablas_relacion","innerHTML",$str);
           return $this->objResponse;

 ;      }
}
$xajax->register(XAJAX_CALLABLE_OBJECT,new ctrl());
$xajax->processRequest();
?>
