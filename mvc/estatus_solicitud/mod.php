<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $estatus;

     private $order;

     function getid(){ return $this->id;}
     function getestatus(){ return $this->estatus;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setestatus($estatus){$this->estatus=$estatus;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into estatus_solicitud(estatus) values('".$this->getestatus()."');");
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
               $this->Ejecutar("update estatus_solicitud set estatus='".$this->getestatus()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update estatus_solicitud set estatus='".$this->getestatus()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from estatus_solicitud  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from estatus_solicitud  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `estatus_solicitud`.`id` AS `id`,`estatus_solicitud`.`estatus` AS `estatus` from `estatus_solicitud`) as bg where  bg.estatus like '%".$this->getestatus()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `estatus_solicitud`.`id` AS `id`,`estatus_solicitud`.`estatus` AS `estatus` from `estatus_solicitud`) as b_i  where  b_i.estatus='".$this->getestatus()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `estatus_solicitud`.`id` AS `id`,`estatus_solicitud`.`estatus` AS `estatus` from `estatus_solicitud`) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
  function rel_existente_solicitud_arancel_estatus()
     {
          $result=$this->EjecutarSql("select * from solicitud_arancel_estatus  where id_estatus_solicitud=".$this->getid().";");
     return $result;
     }

}
?>
