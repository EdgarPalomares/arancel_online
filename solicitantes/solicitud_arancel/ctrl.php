<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
$n_url="../solicitud_detalles/solicitud_detalles.php";
///////////////configuraciones mensajes validaciones////////////////
      $n_nro_solicitud='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error!</b> Debe indicar numero de solicitud
                                    </div>';
      $n_fecha='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error!</b> Debe indicar fecha
                                    </div>';
      $n_user_id='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Error!</b> Debe indicar usuario
                                    </div>';
/////////////encabezado resultado busqueda grid/////////////////
      $ng_nro_solicitud='nro_solicitud';
      $ng_fecha='fecha';
      $ng_user_id='user_id';
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
         $this->guardarformulario();
         return $this->objResponse;
     }
     function permisos()
     {
          if ($_SESSION['id_usuario']=="")
          {
               $this->objResponse->assign("content","innerHTML","<table border='0' width='300' height='260'  ><tr  ><td align='center' ><h3>Debe Iniciar Sesi&oacute;n para Continuar</h3><td/><tr/></table>");
               $this->objResponse->redirect("../sis_inicio_sesion/inicio.php",3);
          }
          $_SESSION["modulo_permisos"]='solicitud_arancel';
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
     $this->objResponse->assign("nro_solicitud","value","");
     $this->objResponse->assign("fecha","value","");
     $this->objResponse->assign("user_id","value","");

   }
   function validaciones($aFormValues)
   {
           $bError =1;
           global $n_nro_solicitud;
      global $n_fecha;
      global $n_user_id;
     
              return $bError;
   }
   function guardarformulario()
   {
      $msg_insertado=' <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Bien!</b> Solicitud registrada con exito!
                                    </div>';
      $msg_registro_existente=' <div class="alert alert alert-warning alert-dismissable">
                                        <i class="fa fa-warning"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Ooops!</b> No se pudo registrar solicitud!
                                    </div>';
      $msg_actualizado='Actualizado con Exito';
      if($this->validaciones($aFormValues))
      {
          $this->modelo->setid('');
          //proceso autoasignacion nro nuevo

           $result=new Rs($this->modelo->correlativos());

                      if($result->Registros())
                 {
                      $nro=$result->getCampo('nro_solicitud');
                      $nro++;


                      //$nro=left_pad($nro, 5);

                      $prox_nro=$result->getCampo('anho').$nro;

                      $this->objResponse->alert($prox_nro);
                    }


          //
          $this->modelo->setnro_solicitud($prox_nro);
          $this->modelo->setcorrelativo($nro);
          $this->modelo->setuser_id($_SESSION['id_usuario']);
         if (trim($aFormValues['id']) == "")//nuevo reg
         {
            if($_SESSION["insertar"])
          {
               if($this->modelo->insertar())
                 {
                    $this->objResponse->assign("mensaje","innerHTML",$msg_insertado);
                    //$this->limpiarformulario();
                    //$this->limpiarmensaje();

                     $result=new Rs($this->modelo->maxid());

                      if($result->Registros())
                 {

                       $_SESSION['id_solicitud_arancel']=$result->getCampo('id');
                    }


                    

                     $this->objResponse->redirect("../solicitud_arancel_detalles/solicitud_arancel_detalles.php",0);
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
      global $ng_nro_solicitud;
      global $ng_fecha;
      global $ng_user_id;

if($_SESSION["seleccionar"])
     {
                    $this->modelo->setid($aFormValues['id']);
          $this->modelo->setnro_solicitud($aFormValues['nro_solicitud']);
          $this->modelo->setfecha($aFormValues['fecha']);
          $this->modelo->setuser_id($aFormValues['user_id']);

         $this->modelo->setorder($order);

 $result=new Rs($this->modelo->busqueda());
         $str="
<thead><tr bgcolor='white' ><th width='5%'>#</th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'nro_solicitud')\"    >$ng_nro_solicitud<img id='imnro_solicitud'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'fecha')\"    >$ng_fecha<img id='imfecha'></th> </tr></thead>";
         $i=0;
      $str.="<tbody>";   
     while($result->Registros())
         {
           $i++;
     $str.="<tr ><td>".$i."</td> <td  >".$result->getCampo('nro_solicitud')."</td> <td  >".$result->getCampo('fecha')."</td> <td width='5%' onclick='xajax_ctrl.c_ver(".$result->getCampo('id').");' ><i class='fa fa-search'></i></td></tr>";
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
              $this->objResponse->assign("form","action","solicitud_arancel.php");

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
<input type='hidden' name='nro_solicitud' value='".$result->getCampo('nro_solicitud')."'/>
<input type='hidden' name='fecha' value='".$result->getCampo('fecha')."'/>
<input type='hidden' name='user_id' value='".$result->getCampo('user_id')."'/>
");

     return $this->objResponse;
     }

   
}

    function c_ver($id)
   {
               $this->c_f_ver($id);
              $this->objResponse->assign("form","action","solicitud_arancel_v.php");

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
<input type='hidden' name='nro_solicitud' value='".$result->getCampo('nro_solicitud')."'/>
<input type='hidden' name='fecha' value='".$result->getCampo('fecha')."'/>
<input type='hidden' name='user_id' value='".$result->getCampo('user_id')."'/>
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
             $rel_1=new Rs($this->modelo->rel_existente_solicitud_arancel_estatus());
          if(!$rel_1->Registros()){
$rel_2=new Rs($this->modelo->rel_existente_solicitud_arancel_detalles());
          if(!$rel_2->Registros()){
$bo=$this->modelo->eliminar();

}}     if ($bo=='false')

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
             $rel_1=new Rs($this->modelo->rel_existente_solicitud_arancel_estatus());
          if(!$rel_1->Registros()){
$rel_2=new Rs($this->modelo->rel_existente_solicitud_arancel_detalles());
          if(!$rel_2->Registros()){
$bo=$this->modelo->eliminar();

}}     if ($bo=='false')

	     {

		     $this->objResponse->alert("no es posible eliminar debido a que tiene registros asociados");

	     }

		  $this->objResponse->assign("mensaje","innerHTML","Registro Eliminado");
  
	 $this->objResponse->redirect('solicitud_arancel',2);
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
