<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{

  private $id;
     private $id_grupos;
     private $id_modulos;
     private $seleccionar;
     private $insertar;
     private $actualizar;
     private $eliminar;
     private $ejecutar;
	 
	 private $valor;
	 private $elemento;

     function getid(){ return $this->id;}
     function getid_grupos(){ return $this->id_grupos;}
     function getid_modulos(){ return $this->id_modulos;}
     function getseleccionar(){ return $this->seleccionar;}
     function getinsertar(){ return $this->insertar;}
     function getactualizar(){ return $this->actualizar;}
     function geteliminar(){ return $this->eliminar;}
     function getejecutar(){ return $this->ejecutar;}
	 
	 function getelemento(){ return $this->elemento;}
     function getvalor(){ return $this->valor;}

     function setid($id){$this->id=$id;}
     function setid_grupos($id_grupos){$this->id_grupos=$id_grupos;}
     function setid_modulos($id_modulos){$this->id_modulos=$id_modulos;}
     function setseleccionar($seleccionar){$this->seleccionar=$seleccionar;}
     function setinsertar($insertar){$this->insertar=$insertar;}
     function setactualizar($actualizar){$this->actualizar=$actualizar;}
     function seteliminar($eliminar){$this->eliminar=$eliminar;}
     function setejecutar($ejecutar){$this->ejecutar=$ejecutar;}
	 
	 function setelemento($elemento){$this->elemento=$elemento;}
     function setvalor($valor){$this->valor=$valor;}



     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into sis_permisos(id_grupos,id_modulos,seleccionar,insertar,actualizar,eliminar,ejecutar) values(".$this->getid_grupos().",".$this->getid_modulos().",0,0,0,0,0);");
               $boolean=1;
          }
          return $boolean;
              }
			  
			  function insertar_r()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into sis_permisos(id_grupos,id_modulos,seleccionar,insertar,actualizar,eliminar,ejecutar) values(".$this->getid_grupos().",".$this->getid_modulos().",1,1,1,1,1);");
               $boolean=1;
          }
          return $boolean;
              }
function m_actualizar()
     {
            $boolean=$this->Ejecutar("update sis_permisos set ".$this->getelemento()."=".$this->getvalor()." where id=".$this->getid().";");
     return $boolean;
      }
	  
	  function m_marcar()
     {
            $boolean=$this->Ejecutar("update sis_permisos set seleccionar=1, insertar=1,actualizar=1,eliminar=1,ejecutar=1 where id=".$this->getid().";");
     return $boolean;
      }
	  function m_desmarcar()
     {
          $boolean=$this->Ejecutar("update sis_permisos set seleccionar=0, insertar=0,actualizar=0,eliminar=0,ejecutar=0 where id=".$this->getid().";");
     return $boolean;
      }
     function actualizar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0) 
          {
               $this->Ejecutar("update sis_permisos set id_grupos=".$this->getid_grupos().",id_modulos=".$this->getid_modulos().",seleccionar=".$this->getseleccionar().",insertar=".$this->getinsertar().",actualizar=".$this->getactualizar().",eliminar=".$this->geteliminar().",ejecutar=".$this->getejecutar()." where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update sis_permisos set id_grupos=".$this->getid_grupos().",id_modulos=".$this->getid_modulos().",seleccionar=".$this->getseleccionar().",insertar=".$this->getinsertar().",actualizar=".$this->getactualizar().",eliminar=".$this->geteliminar().",ejecutar=".$this->getejecutar()." where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
             }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from sis_permisos  where id=".$this->getid().";");
     return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from sis_permisos  where id=".$this->getid().";");
     return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos  where id_grupos=".$this->getid_grupos()." order by descripcion;");
     return $result;
}

 function buscar_modulos_para_agregar()
     {
          $result=$this->EjecutarSql("SELECT sis_permisos.id FROM sis_permisos where sis_permisos.id_grupos=".$this->getid_grupos()." and sis_permisos.id_modulos=".$this->getid_modulos()." ;");
     return $result;
}

 function buscar_grupos()
     {
          $result=$this->EjecutarSql("select id,nombre from sis_grupos;");
     return $result;
}

function buscar_modulos()
     {
          $result=$this->EjecutarSql("select id from sis_modulos;");
     return $result;
}


     function buscar()
     {
          //revisar$result=$this->EjecutarSql("select * from sisv_b_i_permisos  where ;");
     return $result;
     }

     function m_id_grupos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_grupos`.`id` AS `id`,`sis_grupos`.`nombre` AS `descripcion` from `sis_grupos`
) as sisv_s_id_sis_grupos ;");
     return $result;
}

     function m_id_modulos()
     {
          $result=$this->EjecutarSql("select * from (select `v`.`id` AS `id`,`v`.`descripcion` AS `descripcion` from `sis_modulos` `v`) as sisv_s_id_sis_modulos ;");
     return $result;
}

}
?>
