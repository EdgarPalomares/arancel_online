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
	  $this->agregar_modulos();
	   $this->c_busqueda($aFormValues);
	   
	    //$this->c_accesos();
    
         return $this->objResponse;
     }
	 
   function limpiarformulario()
   {
     $this->objResponse->assign("id","value","");
     $this->objResponse->assign("id_grupos","value","");
     $this->objResponse->assign("id_modulos","value","");
     $this->objResponse->assign("seleccionar","value","");
     $this->objResponse->assign("insertar","value","");
     $this->objResponse->assign("actualizar","value","");
     $this->objResponse->assign("eliminar","value","");
     $this->objResponse->assign("ejecutar","value","");

   }
    function agregar_modulos()
   {
      
	  
	  $result=new Rs($this->modelo->buscar_grupos());
         while($result->Registros())
         {
		 $ngrupo=$result->getCampo('nombre');
		     $this->modelo->setid_grupos($result->getCampo('id'));			 
		 	 $result2=new Rs($this->modelo->buscar_modulos());
				while($result2->Registros())
				{
					$this->modelo->setid_modulos($result2->getCampo('id'));
					$result3=new Rs($this->modelo->buscar_modulos_para_agregar());
					if($result3->Registros())
					{					
					}
					else
					{
							if (($ngrupo=='Super') or ($ngrupo=='Administradores'))//revisar es para colocar 1 a super adminsitrador y habilitar todos los permisos
							{
								$this->modelo->insertar_r();		
							}
							else
							{
								$this->modelo->insertar();			
							}
					}
										
					
				}
		 }
		 
      return $this->objResponse;
   }
   
   
   
   function guardarformulario($aFormValues)
   {
      $msg_insertado='Almacenado con Exito';
      $msg_registro_existente='El registro ya existe';
      $msg_actualizado='Actualizado con Exito';
      if($this->validaciones($aFormValues))
      {
     /*$this->modelo->setid($aFormValues['id']);
     $this->modelo->setid_grupos($aFormValues['id_grupos']);
     $this->modelo->setid_modulos($aFormValues['id_modulos']);
     $this->modelo->setseleccionar($aFormValues['seleccionar']);
     $this->modelo->setinsertar($aFormValues['insertar']);
     $this->modelo->setactualizar($aFormValues['actualizar']);
     $this->modelo->seteliminar($aFormValues['eliminar']);
     $this->modelo->setejecutar($aFormValues['ejecutar']);*/
	 
	  $this->objResponse->assign("mensaje","innerHTML",$aFormValues['seleccionar']);
	  $this->limpiarmensaje();
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

   function validaciones($aFormValues)
   {
      $bError =1;
      $n_id_grupos='Ingrese id_grupos';
      $n_id_modulos='Ingrese id_modulos';
      $n_seleccionar='Ingrese seleccionar';
      $n_insertar='Ingrese insertar';
      $n_actualizar='Ingrese actualizar';
      $n_eliminar='Ingrese eliminar';
      $n_ejecutar='Ingrese ejecutar';

      if ((trim($aFormValues['id_grupos']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_grupos);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['id_modulos']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_id_modulos);
            $this->limpiarmensaje();
            $bError = 0;
         }

    

         return $bError;
   }
   function c_busqueda($aFormValues)
   {
 
  		$id_grupos=$aFormValues['id_grupos'];
         $this->modelo->setid_grupos($aFormValues['id_grupos']);		
         $result=new Rs($this->modelo->busqueda());
         $str="<tr bgcolor='white' background='../tema/images/menu2.jpg'><th>M&oacute;dulo</th><th>Seleccionar</th><th>Insertar</th><th>Actualizar</th><th>Eliminar</th><th>Ejecutar</th></tr>";
         while($result->Registros())
         {
		  if ($result->getCampo('seleccionar')==1)
			 {
				 $img_seleccionar='activo';
			 }
			 else
			 {
				 $img_seleccionar='inactivo';
			 }
			 
			 if ($result->getCampo('insertar')==1)
			 {
				 $img_insertar='activo';
			 }
			 else
			 {
				 $img_insertar='inactivo';
			 }
			 
			 if ($result->getCampo('actualizar')==1)
			 {
				 $img_actualizar='activo';
			 }
			 else
			 {
				 $img_actualizar='inactivo';
			 }
			 
			 if ($result->getCampo('eliminar')==1)
			 {
				 $img_eliminar='activo';
			 }
			 else
			 {
				 $img_eliminar='inactivo';
			 }
			  if ($result->getCampo('ejecutar')==1)
			 {
				 $img_ejecutar='activo';
			 }
			 else
			 {
				 $img_ejecutar='inactivo';
			 }
			 
          $str.="<tr><td align='left'>".$result->getCampo('descripcion')."</td><td align='center' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",1,".$id_grupos.",".$result->getCampo('seleccionar').");' ><img alt='Seleccinar'  src='../sis_design/img/".$img_seleccionar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",2,".$id_grupos.",".$result->getCampo('insertar').");' ><img alt='Insertar'  src='../sis_design/img/".$img_insertar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",3,".$id_grupos.",".$result->getCampo('actualizar').");' ><img alt='Actualizar'  src='../sis_design/img/".$img_actualizar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",4,".$id_grupos.",".$result->getCampo('eliminar').");' ><img alt='Eliminar'  src='../sis_design/img/".$img_eliminar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",5,".$id_grupos.",".$result->getCampo('ejecutar').");' ><img alt='Ejecutar'  src='../sis_design/img/".$img_ejecutar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_marcar(".$result->getCampo('id').",".$id_grupos.");' >Todo</td><td  align='center'  onclick='xajax_ctrl.c_desmarcar(".$result->getCampo('id').",".$id_grupos.");' >Desmarcar</td></tr>";
		
		  
         }
		
         $this->objResponse->assign("d_permisos","innerHTML","<div class='table-responsive'><table class='table table-striped table-bordered table-hover' border='0' width='100%' >$str</table></div>");
      return $this->objResponse;

   }
   
     function c_busqueda2($id_grupos)
   {
  
          $this->modelo->setid_grupos($id_grupos);		
         $result=new Rs($this->modelo->busqueda());
         $str="<tr bgcolor='white' background='../tema/images/menu2.jpg'><th>M&oacute;dulo</th><th>Seleccionar</th><th>Insertar</th><th>Actualizar</th><th>Eliminar</th><th>Ejecutar</th></tr>";
         while($result->Registros())
         {
			  if ($result->getCampo('seleccionar')==1)
			 {
				 $img_seleccionar='activo';
			 }
			 else
			 {
				 $img_seleccionar='inactivo';
			 }
			 
			 if ($result->getCampo('insertar')==1)
			 {
				 $img_insertar='activo';
			 }
			 else
			 {
				 $img_insertar='inactivo';
			 }
			 
			 if ($result->getCampo('actualizar')==1)
			 {
				 $img_actualizar='activo';
			 }
			 else
			 {
				 $img_actualizar='inactivo';
			 }
			 
			 if ($result->getCampo('eliminar')==1)
			 {
				 $img_eliminar='activo';
			 }
			 else
			 {
				 $img_eliminar='inactivo';
			 }
			 
           if ($result->getCampo('ejecutar')==1)
			 {
				 $img_ejecutar='activo';
			 }
			 else
			 {
				 $img_ejecutar='inactivo';
			 }
			 
              $str.="<tr ><td align='left'>".$result->getCampo('descripcion')."</td><td align='center' onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",1,".$id_grupos.",".$result->getCampo('seleccionar').");' ><img alt='Seleccinar'  src='../sis_design/img/".$img_seleccionar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",2,".$id_grupos.",".$result->getCampo('insertar').");' ><img alt='Insertar'  src='../sis_design/img/".$img_insertar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",3,".$id_grupos.",".$result->getCampo('actualizar').");' ><img alt='Actualizar'  src='../sis_design/img/".$img_actualizar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",4,".$id_grupos.",".$result->getCampo('eliminar').");' ><img alt='Eliminar'  src='../sis_design/img/".$img_eliminar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_actualizar(".$result->getCampo('id').",5,".$id_grupos.",".$result->getCampo('ejecutar').");' ><img alt='Ejecutar'  src='../sis_design/img/".$img_ejecutar.".png' /></td><td  align='center'  onclick='xajax_ctrl.c_marcar(".$result->getCampo('id').",".$id_grupos.");' >Todo</td><td  align='center'  onclick='xajax_ctrl.c_desmarcar(".$result->getCampo('id').",".$id_grupos.");' >Desmarcar</td></tr>";
         }
         $this->objResponse->assign("d_permisos","innerHTML","<div class='table-responsive'><table class='table table-striped table-bordered table-hover' border='0' width='100%' >$str</table></div>");
      return $this->objResponse;

   }
   
    function c_actualizar($id,$elemento,$id_grupos,$valor)
   {
   
                 $this->modelo->setid($id);
	if ($elemento==1)
	{
		$elemento="seleccionar";
	}
	if ($elemento==2)
	{
		$elemento="insertar";
	}
	if ($elemento==3)
	{
		$elemento="actualizar";
	}
	if ($elemento==4)
	{
		$elemento="eliminar";
	}
	if ($elemento==5)
	{
		$elemento="ejecutar";
	}
				  $this->modelo->setelemento($elemento);
	if ($valor==0)
	{
		$valor=1;
	}
	else
	{
		$valor=0;
	}
     $this->modelo->setvalor($valor);
	 
	 
        if($this->modelo->m_actualizar())
            {
              $this->c_busqueda2($id_grupos);
            }
          return $this->objResponse;
   }
   
   function c_marcar($id,$id_grupos)
   {
   
                 $this->modelo->setid($id);
	
		 if($this->modelo->m_marcar())
            {
              $this->c_busqueda2($id_grupos);
            }
          return $this->objResponse;
   }
   
    function c_desmarcar($id,$id_grupos)
   {
   
                 $this->modelo->setid($id);
	
		 if($this->modelo->m_desmarcar())
            {
              $this->c_busqueda2($id_grupos);
            }
          return $this->objResponse;
   }
   
   

   function limpiarmensaje()
   {
      $this->objResponse->sleep(10);
      $this->objResponse->assign("mensaje","innerHTML","&nbsp;");
   }
   function c_id_grupos($id)
   {
      $result=new Rs($this->modelo->m_id_grupos());
         $str="<select id='id_grupos' class='form-control' name='id_grupos' onchange=\"xajax_ctrl.c_busqueda(xajax.getFormValues('form'))\"><option value=''>Seleccione</option>";
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
  function c_id_modulos($id)
   {
      $result=new Rs($this->modelo->m_id_modulos());
         $str="<select id='id_modulos'   name='id_modulos'><option value=''>Seleccione</option>";
         while($result->Registros())
          {
            		$str.="<option value='".$result->getCampo('id')."'";
          if ($id==$result->getCampo('id')){
     $str.=" selected";
          }
    $str.=">".$result->getCampo('descripcion')."</option>";
  }
          $str.="</select>";
          $this->objResponse->assign("d_id_modulos","innerHTML",$str);
           return $this->objResponse;

 ;      }
}
$xajax->register(XAJAX_CALLABLE_OBJECT,new ctrl());
$xajax->processRequest();
?>
