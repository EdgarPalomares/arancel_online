<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $id_sis_tablas;
     private $id_sis_tablas_relacion;
     private $tabla;
     private $tabla_relacion;

     function getid(){ return $this->id;}
     function getid_sis_tablas(){ return $this->id_sis_tablas;}
     function getid_sis_tablas_relacion(){ return $this->id_sis_tablas_relacion;}
     function gettabla(){ return $this->tabla;}
     function gettabla_relacion(){ return $this->tabla_relacion;}

     function setid($id){$this->id=$id;}
     function setid_sis_tablas($id_sis_tablas){$this->id_sis_tablas=$id_sis_tablas;}
     function setid_sis_tablas_relacion($id_sis_tablas_relacion){$this->id_sis_tablas_relacion=$id_sis_tablas_relacion;}
     function settabla($tabla){$this->tabla=$tabla;}
     function settabla_relacion($tabla_relacion){$this->tabla_relacion=$tabla_relacion;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into sis_relaciones(id_sis_tablas,id_sis_tablas_relacion) values(".$this->getid_sis_tablas().",".$this->getid_sis_tablas_relacion().");");
               $boolean=1;
          }
          return $boolean;
         }

     function actualizar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0) 
          {
               $this->Ejecutar("update sis_relaciones set id_sis_tablas=".$this->getid_sis_tablas().",id_sis_tablas_relacion=".$this->getid_sis_tablas_relacion()." where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update sis_relaciones set id_sis_tablas=".$this->getid_sis_tablas().",id_sis_tablas_relacion=".$this->getid_sis_tablas_relacion()." where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from sis_relaciones  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from sis_relaciones  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (      SELECT s.`id`, s.`id_sis_tablas`, s.`id_sis_tablas_relacion`,st1.tabla as tabla,str.tabla as tabla_relacion FROM sis_relaciones s inner join sis_tablas as st1 on st1.id=s.id_sis_tablas inner join sis_tablas as str on str.id=s.id_sis_tablas_relacion) as  sisv_bg_sis_relaciones  where  tabla like '%".$this->gettabla()."%'  and  tabla_relacion like '%".$this->gettabla_relacion()."%' ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `sis_relaciones`.`id` AS `id`,`sis_relaciones`.`id_sis_tablas` AS `id_sis_tablas`,`sis_relaciones`.`id_sis_tablas_relacion` AS `id_sis_tablas_relacion` from `sis_relaciones`) as sisv_b_i_sis_relaciones  where  id_sis_tablas='".$this->getid_sis_tablas()."' and  id_sis_tablas_relacion='".$this->getid_sis_tablas_relacion()."';");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
     function m_id_sis_tablas()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`descripcion` AS `descripcion` from `sis_tablas` `s`
) as sisv_s_id_sis_tablas ;");
     return $result;
}

     function m_id_sis_tablas_relacion()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`descripcion` AS `descripcion` from `sis_tablas` `s`
) as sisv_s_id_sis_tablas;");
     return $result;
}

}
?>
