<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
///////////////configuraciones mensajes validaciones////////////////
      $n_id_solicitud_arancel='Ingrese id_solicitud_arancel';
      $n_id_bancos='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo Siento!</b> Seleccione un Banco
                                    </div>';
      $n_monto='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo Siento!</b> Ingrense un monto
                                    </div>';
      $n_nro_deposito='<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Lo Siento!</b> Ingrense un numero de deposito
                                    </div>';
/////////////encabezado resultado busqueda grid/////////////////
      $ng_nro_solicitud='nro_solicitud';
      $ng_fecha='fecha';
      $ng_user_id='user_id';
      $ng_banco='banco';
      $ng_monto='monto';
      $ng_nro_deposito='nro_deposito';
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
         $this->encabezado_pago();

     
     $this->c_id_bancos($aFormValues['h_id_bancos']);
         return $this->objResponse;
     }
     function permisos()
     {
          if ($_SESSION['id_usuario']=="")
          {
               $this->objResponse->assign("content","innerHTML","<table border='0' width='300' height='260'  ><tr  ><td align='center' ><h3>Debe Iniciar Sesi&oacute;n para Continuar</h3><td/><tr/></table>");
               $this->objResponse->redirect("../sis_inicio_sesion/inicio.php",3);
          }
          $_SESSION["modulo_permisos"]='pagos';
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
     $this->objResponse->assign("id_solicitud_arancel","value","");
     $this->objResponse->assign("id_bancos","value","");
     $this->objResponse->assign("monto","value","");
     $this->objResponse->assign("nro_deposito","value","");

   }
   function validaciones($aFormValues)
   {
           $bError =1;
           global $n_id_solicitud_arancel;
      global $n_id_bancos;
      global $n_monto;
      global $n_nro_deposito;
           if ((trim($aFormValues['id_solicitud_arancel']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_solicitud_arancel);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['id_bancos']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_bancos);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['monto']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_monto);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['nro_deposito']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_nro_deposito);
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
          
          $this->modelo->setid_bancos($aFormValues['id_bancos']);
          $this->modelo->setmonto($aFormValues['monto']);
          $this->modelo->setnro_deposito($aFormValues['nro_deposito']);
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
      global $ng_nro_solicitud;
      global $ng_fecha;
      global $ng_user_id;
      global $ng_banco;
      global $ng_monto;
      global $ng_nro_deposito;

if($_SESSION["seleccionar"])
     {
                    $this->modelo->setid($aFormValues['id']);
          $this->modelo->setid_solicitud_arancel($aFormValues['id_solicitud_arancel']);
          $this->modelo->setnro_solicitud($aFormValues['nro_solicitud']);
          $this->modelo->setfecha($aFormValues['fecha']);
          $this->modelo->setuser_id($aFormValues['user_id']);
          $this->modelo->setid_bancos($aFormValues['id_bancos']);
          $this->modelo->setbanco($aFormValues['banco']);
          $this->modelo->setmonto($aFormValues['monto']);
          $this->modelo->setnro_deposito($aFormValues['nro_deposito']);

         $this->modelo->setorder($order);

 $result=new Rs($this->modelo->busqueda());
         $str="
<thead><tr bgcolor='white' ><th width='5%'>#</th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'nro_solicitud')\"    >$ng_nro_solicitud<img id='imnro_solicitud'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'fecha')\"    >$ng_fecha<img id='imfecha'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'user_id')\"    >$ng_user_id<img id='imuser_id'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'banco')\"    >$ng_banco<img id='imbanco'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'monto')\"    >$ng_monto<img id='immonto'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'nro_deposito')\"    >$ng_nro_deposito<img id='imnro_deposito'></th></tr></thead>";
         $i=0;
      $str.="<tbody>";   
     while($result->Registros())
         {
           $i++;
     $str.="<tr ><td>".$i."</td> <td  >".$result->getCampo('nro_solicitud')."</td> <td  >".$result->getCampo('fecha')."</td> <td  >".$result->getCampo('user_id')."</td> <td  >".$result->getCampo('banco')."</td> <td  >".$result->getCampo('monto')."</td> <td  >".$result->getCampo('nro_deposito')."</td><td width='5%' onclick='xajax_ctrl.c_ver(".$result->getCampo('id').");' ><i class='fa fa-search'></i></td><td width='5%' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').");' ><i class='fa fa-edit'></i></td><td width='5%' onclick='el(".$result->getCampo('id').");'  ><i class='fa fa-trash-o'></i></td></tr>";
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
              $this->objResponse->assign("form","action","pagos.php");

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
<input type='hidden' name='id_solicitud_arancel' value='".$result->getCampo('id_solicitud_arancel')."'/>
<input type='hidden' name='id_bancos' value='".$result->getCampo('id_bancos')."'/>
<input type='hidden' name='monto' value='".$result->getCampo('monto')."'/>
<input type='hidden' name='nro_deposito' value='".$result->getCampo('nro_deposito')."'/>
");

     return $this->objResponse;
     }

   
}

    function c_ver($id)
   {
               $this->c_f_ver($id);
              $this->objResponse->assign("form","action","pagos_v.php");

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
<input type='hidden' name='id_solicitud_arancel' value='".$result->getCampo('id_solicitud_arancel')."'/>
<input type='hidden' name='nro_solicitud' value='".$result->getCampo('nro_solicitud')."'/>
<input type='hidden' name='fecha' value='".$result->getCampo('fecha')."'/>
<input type='hidden' name='user_id' value='".$result->getCampo('user_id')."'/>
<input type='hidden' name='id_bancos' value='".$result->getCampo('id_bancos')."'/>
<input type='hidden' name='banco' value='".$result->getCampo('banco')."'/>
<input type='hidden' name='monto' value='".$result->getCampo('monto')."'/>
<input type='hidden' name='nro_deposito' value='".$result->getCampo('nro_deposito')."'/>
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
  
	 $this->objResponse->redirect('pagos',2);
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
   function c_id_solicitud_arancel($id)
   {
      $result=new Rs($this->modelo->m_id_solicitud_arancel());
         $str="<select id='id_solicitud_arancel' class='form-control' name='id_solicitud_arancel' onchange=\"xajax_ctrl.sel_id_solicitud_arancel(xajax.getFormValues('";
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
          $this->objResponse->assign("d_id_solicitud_arancel","innerHTML",$str);
           return $this->objResponse;

       }
function sel_id_solicitud_arancel()
     {
      return $this->objResponse;
     }
   function c_id_bancos($id)
   {
      $result=new Rs($this->modelo->m_id_bancos());
         $str="<select id='id_bancos' class='form-control' name='id_bancos' onchange=\"xajax_ctrl.sel_id_bancos(xajax.getFormValues('";
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
          $this->objResponse->assign("d_id_bancos","innerHTML",$str);
           return $this->objResponse;

       }
       function encabezado_pago()
 {

   $result=new Rs($this->modelo->buscar_encabezado());
         
     if($result->Registros())
         {


$str="<h4>Solicitante:    ".$_SESSION["nombres"]."<br>Registrar Pago de Solicitud Nro:   <b>".$result->getCampo('nro_solicitud')."</b>  </h4>";

 $this->objResponse->assign("ronald","innerHTML",$str);
      }

  return $this->objResponse;
 }
function sel_id_bancos()
     {
      return $this->objResponse;
     }

}
$xajax->register(XAJAX_CALLABLE_OBJECT,new ctrl());
$xajax->processRequest();
?>
