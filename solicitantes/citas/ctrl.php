<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
///////////////configuraciones mensajes validaciones////////////////
      $n_fecha_ini='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo siento!</b> Seleccione una fecha de inicio
                                    </div>';
      $n_fecha_fin='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo siento!</b> Seleccione una fecha final
                                    </div>';
      $n_user_id='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo siento!</b> Seleccione un usuario
                                    </div>';
      $n_id_tipo_solicitud='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo siento!</b> Seleccione solicitud
                                    </div>';
/////////////encabezado resultado busqueda grid/////////////////
      $ng_fecha_ini='fecha_ini';
      $ng_fecha_fin='fecha_fin';
      $ng_user_id='user_id';
      $ng_solicitud='solicitud';
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
     $this->c_id_tipo_solicitud($aFormValues['h_id_tipo_solicitud']);
         return $this->objResponse;
     }
     function permisos()
     {
          if ($_SESSION['id_usuario']=="")
          {
               $this->objResponse->assign("content","innerHTML","<table border='0' width='300' height='260'  ><tr  ><td align='center' ><h3>Debe Iniciar Sesi&oacute;n para Continuar</h3><td/><tr/></table>");
               $this->objResponse->redirect("../sis_inicio_sesion/inicio.php",3);
          }
          $_SESSION["modulo_permisos"]='citas';
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
     $this->objResponse->assign("fecha_ini","value","");
     $this->objResponse->assign("fecha_fin","value","");
     $this->objResponse->assign("user_id","value","");
     $this->objResponse->assign("id_tipo_solicitud","value","");

   }
   function validaciones($aFormValues)
   {
           $bError =1;
           global $n_fecha_ini;
      global $n_fecha_fin;
      global $n_user_id;
      global $n_id_tipo_solicitud;
           if ((trim($aFormValues['fecha_ini']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_fecha_ini);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['fecha_fin']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_fecha_fin);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['user_id']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_user_id);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['id_tipo_solicitud']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_tipo_solicitud);
            $this->limpiarmensaje();
            $bError = 0;
         }

              return $bError;
   }
   function guardarformulario($aFormValues)
   {
      $msg_insertado='<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Excelente!</b> Cita programada con &eacute;xito
                                    </div>';
      $msg_registro_existente='<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo Siento!</b> Ya hay una cita asignada
                                    </div>';
      $msg_actualizado='Actualizado con Exito';
      if($this->validaciones($aFormValues))
      {
          $this->modelo->setid($aFormValues['id']);
          $this->modelo->setfecha_ini($aFormValues['fecha_ini']);
          $this->modelo->setfecha_fin($aFormValues['fecha_fin']);
          $this->modelo->setuser_id($aFormValues['user_id']);
          $this->modelo->setid_tipo_solicitud($aFormValues['id_tipo_solicitud']);
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
      global $ng_fecha_ini;
      global $ng_fecha_fin;
      global $ng_user_id;
      global $ng_solicitud;

if($_SESSION["seleccionar"])
     {
                    $this->modelo->setid($aFormValues['id']);
          $this->modelo->setfecha_ini($aFormValues['fecha_ini']);
          $this->modelo->setfecha_fin($aFormValues['fecha_fin']);
          $this->modelo->setuser_id($aFormValues['user_id']);
          $this->modelo->setid_tipo_solicitud($aFormValues['id_tipo_solicitud']);
          $this->modelo->setsolicitud($aFormValues['solicitud']);

         $this->modelo->setorder($order);

 $result=new Rs($this->modelo->busqueda());
         $str="
<thead><tr bgcolor='white' ><th width='5%'>#</th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'fecha_ini')\"    >$ng_fecha_ini<img id='imfecha_ini'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'fecha_fin')\"    >$ng_fecha_fin<img id='imfecha_fin'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'user_id')\"    >$ng_user_id<img id='imuser_id'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'solicitud')\"    >$ng_solicitud<img id='imsolicitud'></th></tr></thead>";
         $i=0;
      $str.="<tbody>";   
     while($result->Registros())
         {
           $i++;
     $str.="<tr ><td>".$i."</td> <td  >".$result->getCampo('fecha_ini')."</td> <td  >".$result->getCampo('fecha_fin')."</td> <td  >".$result->getCampo('user_id')."</td> <td  >".$result->getCampo('solicitud')."</td><td width='5%' onclick='xajax_ctrl.c_ver(".$result->getCampo('id').");' ><i class='fa fa-search'></i></td><td width='5%' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').");' ><i class='fa fa-edit'></i></td><td width='5%' onclick='el(".$result->getCampo('id').");'  ><i class='fa fa-trash-o'></i></td></tr>";
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
              $this->objResponse->assign("form","action","citas.php");

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
<input type='hidden' name='fecha_ini' value='".$result->getCampo('fecha_ini')."'/>
<input type='hidden' name='fecha_fin' value='".$result->getCampo('fecha_fin')."'/>
<input type='hidden' name='user_id' value='".$result->getCampo('user_id')."'/>
<input type='hidden' name='id_tipo_solicitud' value='".$result->getCampo('id_tipo_solicitud')."'/>
");

     return $this->objResponse;
     }

   
}

    function c_ver($id)
   {
               $this->c_f_ver($id);
              $this->objResponse->assign("form","action","citas_v.php");

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
<input type='hidden' name='fecha_ini' value='".$result->getCampo('fecha_ini')."'/>
<input type='hidden' name='fecha_fin' value='".$result->getCampo('fecha_fin')."'/>
<input type='hidden' name='user_id' value='".$result->getCampo('user_id')."'/>
<input type='hidden' name='id_tipo_solicitud' value='".$result->getCampo('id_tipo_solicitud')."'/>
<input type='hidden' name='solicitud' value='".$result->getCampo('solicitud')."'/>
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
  
	 $this->objResponse->redirect('citas',2);
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
   function c_id_tipo_solicitud($id)
   {
      $result=new Rs($this->modelo->m_id_tipo_solicitud());
         $str="<select id='id_tipo_solicitud' class='form-control' name='id_tipo_solicitud' onchange=\"xajax_ctrl.sel_id_tipo_solicitud(xajax.getFormValues('";
     $str.="form'));\"><option value=''>Seleccione</option>";
         while($result->Registros())
          {
            		$str.="<option value='".$result->getCampo('id')."'";
          if ($id==$result->getCampo('id')){
     $str.=" selected";
          }
    $str.=">".$result->getCampo('descripcion')."</option>";
  }
          $str.="</select>";
          $this->objResponse->assign("d_id_tipo_solicitud","innerHTML",$str);
           return $this->objResponse;

       }
function sel_id_tipo_solicitud()
     {
      return $this->objResponse;
     }

}
$xajax->register(XAJAX_CALLABLE_OBJECT,new ctrl());
$xajax->processRequest();
?>
