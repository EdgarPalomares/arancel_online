<?
require_once '../../lib/xajax_core/xajax.inc.php';
require_once ("mod.php");
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
///////////////configuraciones mensajes validaciones////////////////
      $n_tabla='Ingrese Tabla';
      $n_id_sis_main='Seleccione Men&uacute;';
      $n_descripcion='Ingrese Descripci&oacute;n';
/////////////encabezado resultado busqueda grid/////////////////
      $ng_tabla='Tabla';
      $ng_descripcion='Descripci&oacute;n';
      $ng_main_titulo='T&iacute;tulo del Men&uacute;';
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
     $this->c_id_sis_main($aFormValues['h_id_sis_main']);
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
     $this->objResponse->assign("tabla","value","");
     $this->objResponse->assign("id_sis_main","value","");
     $this->objResponse->assign("descripcion","value","");

   }
   function validaciones($aFormValues)
   {
           $bError =1;
           global $n_tabla;
      global $n_id_sis_main;
      global $n_descripcion;
           if ((trim($aFormValues['tabla']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_tabla);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['id_sis_main']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_sis_main);
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
   function guardarformulario($aFormValues)
   {
      $msg_insertado='Almacenado con Exito';
      $msg_registro_existente='El registro ya existe';
      $msg_actualizado='Actualizado con Exito';
      if($this->validaciones($aFormValues))
      {
          $this->modelo->setid($aFormValues['id']);
          $this->modelo->settabla($aFormValues['tabla']);
          $this->modelo->setid_sis_main($aFormValues['id_sis_main']);
          $this->modelo->setdescripcion($aFormValues['descripcion']);
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
      global $ng_tabla;
      global $ng_descripcion;
      global $ng_main_titulo;

if($_SESSION["seleccionar"])
     {
                    $this->modelo->setid($aFormValues['id']);
          $this->modelo->settabla($aFormValues['tabla']);
          $this->modelo->setid_sis_main($aFormValues['id_sis_main']);
          $this->modelo->setdescripcion($aFormValues['descripcion']);
          $this->modelo->setmain_titulo($aFormValues['main_titulo']);

         $this->modelo->setorder($order);

 $result=new Rs($this->modelo->busqueda());
         $str="
<thead><tr bgcolor='white' ><th width='5%'>#</th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'tabla')\"    >$ng_tabla<img id='imtabla'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'descripcion')\"    >$ng_descripcion<img id='imdescripcion'></th> <th onclick=\"xajax_ctrl.c_order(xajax.getFormValues('form'),'main_titulo')\"    >$ng_main_titulo<img id='immain_titulo'></th></tr></thead>";
         $i=0;
      $str.="<tbody>";   
     while($result->Registros())
         {
           $i++;
     $str.="<tr ><td>".$i."</td> <td  >".$result->getCampo('tabla')."</td> <td  >".$result->getCampo('descripcion')."</td> <td  >".$result->getCampo('main_titulo')."</td><td width='5%' onclick='xajax_ctrl.c_ver(".$result->getCampo('id').");' ><i class='fa fa-search'></i></td><td width='5%' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').");' ><i class='fa fa-edit'></i></td><td width='5%' onclick='el(".$result->getCampo('id').");'  ><i class='fa fa-trash-o'></i></td></tr>";
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
              $this->objResponse->assign("form","action","sis_tablas.php");

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
<input type='hidden' name='tabla' value='".$result->getCampo('tabla')."'/>
<input type='hidden' name='id_sis_main' value='".$result->getCampo('id_sis_main')."'/>
<input type='hidden' name='descripcion' value='".$result->getCampo('descripcion')."'/>
");

     return $this->objResponse;
     }

   
}

    function c_ver($id)
   {
               $this->c_f_ver($id);
              $this->objResponse->assign("form","action","sis_tablas_v.php");

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
<input type='hidden' name='tabla' value='".$result->getCampo('tabla')."'/>
<input type='hidden' name='id_sis_main' value='".$result->getCampo('id_sis_main')."'/>
<input type='hidden' name='descripcion' value='".$result->getCampo('descripcion')."'/>
<input type='hidden' name='main_titulo' value='".$result->getCampo('main_titulo')."'/>
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
  
	 $this->objResponse->redirect('sis_tablas',2);
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
   function c_id_sis_main($id)
   {
      $result=new Rs($this->modelo->m_id_sis_main());
         $str="<select id='id_sis_main'  class='form-control' name='id_sis_main' onchange=\"xajax_ctrl.sel_id_sis_main(xajax.getFormValues('";
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
          $this->objResponse->assign("d_id_sis_main","innerHTML",$str);
           return $this->objResponse;

       }
function sel_id_sis_main()
     {
      return $this->objResponse;
     }

}
$xajax->register(XAJAX_CALLABLE_OBJECT,new ctrl());
$xajax->processRequest();
?>
