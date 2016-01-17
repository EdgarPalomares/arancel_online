<?
require_once '../../lib/xajax_core/xajax.inc.php';
$xajax = new xajax();
$xajax->configure("debug",false);
session_start();
///////////////configuraciones mensajes validaciones////////////////
      $n_host='Ingrese host';
      $n_usr='Ingrese usr';
      $n_pass='Ingrese pass';
      $n_bd='Ingrese bd';
/////////////encabezado resultado busqueda grid/////////////////
/////////////encabezado resultado busqueda grid/////////////////

class ctrl{
   private $modelo;
   private $objResponse;

   function __construct(){
     
      $this->objResponse = new xajaxResponse();
   }

   function iload($aFormValues)
   {
         $this->existe_conexion();
         return $this->objResponse;
     }
    
   function limpiarformulario()
   {
     $this->objResponse->assign("id","value","");
     $this->objResponse->assign("host","value","");
     $this->objResponse->assign("usr","value","");
     $this->objResponse->assign("pass","value","");
     $this->objResponse->assign("bd","value","");

   }
   
    function limpiarmensaje()
   {
      $this->objResponse->sleep(10);
      $this->objResponse->assign("mensaje","innerHTML","&nbsp;");
   }
   
    function existe_conexion()
   {
      if (is_file("../../lib/conexion.lib.php"))
	  {
	  	copy("index.php","../../index.php");
		//$this->objResponse->redirect("../../index.php",2);
		 $this->objResponse->assign("mensaje","innerHTML","La Conexion ya existe, si lo desea puede volver a cargarla");
		 
		//$this->objResponse->redirect("../sis_cargar_sql/sis_cargar_sql.php",2);
	  }
	 
	   return $this->objResponse;
   }
   
   function validaciones($aFormValues)
   {
           $bError =1;
           global $n_host;
      global $n_usr;
      global $n_pass;
      global $n_bd;
           if ((trim($aFormValues['host']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_host);
            $this->limpiarmensaje();
            $bError = 0;
         }

      if ((trim($aFormValues['usr']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_usr);
            $this->limpiarmensaje();
            $bError = 0;
         }

     

      if ((trim($aFormValues['bd']) == "") and ($bError ==1))
         {
            $this->objResponse->assign("mensaje","innerHTML",$n_bd);
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
	  $conex=@mysql_connect($aFormValues['host'],$aFormValues['usr'],$aFormValues['pass']);
        
		if ($conex)
		{
			////
			  $this->lib($aFormValues['host'],$aFormValues['usr'],$aFormValues['pass'],$aFormValues['bd']);
		      copy("conexion.lib.php","../../lib/conexion.lib.php");
			  copy("str_conexion.php","../../lib/str_conexion.php");
		 
		     
			  copy("index.php","../../index.php");
               $seleccion="";
			  $seleccion=@mysql_select_db($aFormValues['bd'],$conex);
			  
			if ($seleccion)
			{
			  $this->objResponse->assign("mensaje","innerHTML","Conexion Establecida");
			  $this->objResponse->redirect("../sis_cargar_sql/sis_cargar_sql.php",2);
			}
			else
			{
			$this->objResponse->assign("mensaje","innerHTML","La Bd no Existe");
			$this->limpiarmensaje();
			}
			
		}
		else
		{
			 $this->objResponse->assign("mensaje","innerHTML","error en conexion");
		}
		
         
       }
      return $this->objResponse;
   }
   
   function lib($host,$usr,$pass,$bd)
	{
	
	$str="<?php\nclass Conexion{\n     private \$host_port;\n     private \$usr;\n     private \$pass;\n     private \$base_datos;\n     private \$conn;\n     private \$sql;\n     private \$result;\n     private \$err;\n     function __construct(\$host_port=\"".$host."\",\$usr=\"".$usr."\",\$pass=\"".$pass."\",\$base_datos=\"".$bd."\")\n     {\n          \$this->host_port=\$host_port;\n          \$this->usr=\$usr;\n          \$this->pass=\$pass;\n          \$this->base_datos=\$base_datos;\n     }\n     function Conectar()\n     {\n          \$this->conn=mysql_connect(\$this->host_port,\$this->usr,\$this->pass);\n          if(\$this->conn)\n          {\n               \$this->SelBd();\n          }\n          else\n          {\n               \$this->Err();\n          }\n      }\n     function Desconectar()\n     {\n          if(\$this->conn)\n          {\n               mysql_close(\$this->conn);\n          }\n     }\n     function SelBd()\n     {\n          mysql_select_db(\$this->base_datos,\$this->conn);\n     }\n     function Ejecutar(\$sql)\n     {\n          \$this->Conectar();\n          \$this->sql=\$sql;\n          if(\$this->conn)\n          {\n               \$this->result=mysql_query(\$this->sql,\$this->conn);\n               if(\$this->result)\n               {\n                \$boolean=\"true\";\n               }\n              else\n               {\n               \$this->Err();     \n               \$boolean=\"false\";\n          }\n     }\n     \$this->Desconectar();\n     return \$boolean;\n     }\n     function EjecutarSql(\$sql)\n     {\n          \$this->Conectar();\n          \$this->sql=\$sql;\n          if(\$this->conn)\n          {\n               \$this->result=mysql_query(\$this->sql,\$this->conn);\n               if(\$this->result)\n               {\n                    \$ress=\$this->result;\n               }\n               else\n               {\n                    \$this->Err();\n                    \$ress=\"\";\n               }\n          }\n          \$this->Desconectar();\n          return \$ress;\n     }\n     function Err()\n     {\n          \$this->err=mysql_errno().\": \".mysql_error();\n     }\n     function getErr()\n     {\n          return \$this->err;\n     }\n  }\n?>";     
	$str_conexion="<?php\n          \$host_port=\"".$host."\";\n          \$usr=\"".$usr."\";\n          \$pass=\"".$pass."\";\n          \$bd=\"".$bd."\";\n          \$conn=mysql_connect(\$host_port,\$usr,\$pass);\n          mysql_select_db(\$bd,\$conn);\n          \n?>";     
		
		
		$this->generar_archivo("conexion.lib.php",$str);
		$this->generar_archivo("str_conexion.php",$str_conexion);
		
		return $this->objResponse;
		
		}
		
	function generar_archivo($archivo,$contenido)
	{
			$fp = fopen($archivo, "w");					
			$write = fputs($fp, $contenido);
			fclose($fp); 
	
	}

   

}
$xajax->register(XAJAX_CALLABLE_OBJECT,new ctrl());
$xajax->processRequest();
?>
