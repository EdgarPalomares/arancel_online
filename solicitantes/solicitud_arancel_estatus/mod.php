<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $id_solicitud_arancel;
     private $nro_solicitud;
     private $fecha_solicitud;
     private $user_id;
     private $fecha;
     private $id_estatus_solicitud;
     private $estatus;

     private $order;

     function getid(){ return $this->id;}
     function getid_solicitud_arancel(){ return $this->id_solicitud_arancel;}
     function getnro_solicitud(){ return $this->nro_solicitud;}
     function getfecha_solicitud(){ return $this->fecha_solicitud;}
     function getuser_id(){ return $this->user_id;}
     function getfecha(){ return $this->fecha;}
     function getid_estatus_solicitud(){ return $this->id_estatus_solicitud;}
     function getestatus(){ return $this->estatus;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setid_solicitud_arancel($id_solicitud_arancel){$this->id_solicitud_arancel=$id_solicitud_arancel;}
     function setnro_solicitud($nro_solicitud){$this->nro_solicitud=$nro_solicitud;}
     function setfecha_solicitud($fecha_solicitud){$this->fecha_solicitud=$fecha_solicitud;}
     function setuser_id($user_id){$this->user_id=$user_id;}
     function setfecha($fecha){$this->fecha=$fecha;}
     function setid_estatus_solicitud($id_estatus_solicitud){$this->id_estatus_solicitud=$id_estatus_solicitud;}
     function setestatus($estatus){$this->estatus=$estatus;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into solicitud_arancel_estatus(id_solicitud_arancel,fecha,id_estatus_solicitud) values(".$this->getid_solicitud_arancel().",'".$this->getfecha()."',".$this->getid_estatus_solicitud().");");
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
               $this->Ejecutar("update solicitud_arancel_estatus set id_solicitud_arancel=".$this->getid_solicitud_arancel().",fecha='".$this->getfecha()."',id_estatus_solicitud=".$this->getid_estatus_solicitud()." where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update solicitud_arancel_estatus set id_solicitud_arancel=".$this->getid_solicitud_arancel().",fecha='".$this->getfecha()."',id_estatus_solicitud=".$this->getid_estatus_solicitud()." where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from solicitud_arancel_estatus  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from solicitud_arancel_estatus  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel_estatus`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha_solicitud`,`solicitud_arancel`.`user_id` AS `user_id`,`solicitud_arancel_estatus`.`fecha` AS `fecha`,`estatus_solicitud`.`estatus` AS `estatus` from ((`solicitud_arancel_estatus` join `solicitud_arancel` on((`solicitud_arancel`.`id` = `solicitud_arancel_estatus`.`id_solicitud_arancel`))) join `estatus_solicitud` on((`estatus_solicitud`.`id` = `solicitud_arancel_estatus`.`id_estatus_solicitud`)))) as bg where  bg.nro_solicitud like '%".$this->getnro_solicitud()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel_estatus`.`id` AS `id`,`solicitud_arancel_estatus`.`id_solicitud_arancel` AS `id_solicitud_arancel`,`solicitud_arancel_estatus`.`fecha` AS `fecha`,`solicitud_arancel_estatus`.`id_estatus_solicitud` AS `id_estatus_solicitud` from `solicitud_arancel_estatus`) as b_i  where  b_i.id_solicitud_arancel='".$this->getid_solicitud_arancel()."' and  b_i.fecha='".$this->getfecha()."' and  b_i.id_estatus_solicitud='".$this->getid_estatus_solicitud()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel_estatus`.`id` AS `id`,`solicitud_arancel_estatus`.`id_solicitud_arancel` AS `id_solicitud_arancel`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha_solicitud`,`solicitud_arancel`.`user_id` AS `user_id`,`solicitud_arancel_estatus`.`fecha` AS `fecha`,`solicitud_arancel_estatus`.`id_estatus_solicitud` AS `id_estatus_solicitud`,`estatus_solicitud`.`estatus` AS `estatus` from ((`solicitud_arancel_estatus` join `solicitud_arancel` on((`solicitud_arancel`.`id` = `solicitud_arancel_estatus`.`id_solicitud_arancel`))) join `estatus_solicitud` on((`estatus_solicitud`.`id` = `solicitud_arancel_estatus`.`id_estatus_solicitud`)))) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
     function m_id_solicitud_arancel()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `descripcion` from `solicitud_arancel`) as s  ;");
     return $result;
}

     function m_id_estatus_solicitud()
     {
          $result=$this->EjecutarSql("select * from (select `estatus_solicitud`.`id` AS `id`,`estatus_solicitud`.`estatus` AS `descripcion` from `estatus_solicitud`) as s  ;");
     return $result;
}

}
?>
