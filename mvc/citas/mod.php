<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $fecha_ini;
     private $fecha_fin;
     private $user_id;
     private $id_tipo_solicitud;
     private $solicitud;

     private $order;

     function getid(){ return $this->id;}
     function getfecha_ini(){ return $this->fecha_ini;}
     function getfecha_fin(){ return $this->fecha_fin;}
     function getuser_id(){ return $this->user_id;}
     function getid_tipo_solicitud(){ return $this->id_tipo_solicitud;}
     function getsolicitud(){ return $this->solicitud;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setfecha_ini($fecha_ini){$this->fecha_ini=$fecha_ini;}
     function setfecha_fin($fecha_fin){$this->fecha_fin=$fecha_fin;}
     function setuser_id($user_id){$this->user_id=$user_id;}
     function setid_tipo_solicitud($id_tipo_solicitud){$this->id_tipo_solicitud=$id_tipo_solicitud;}
     function setsolicitud($solicitud){$this->solicitud=$solicitud;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into citas(fecha_ini,fecha_fin,user_id,id_tipo_solicitud) values('".$this->getfecha_ini()."','".$this->getfecha_fin()."','".$this->getuser_id()."',".$this->getid_tipo_solicitud().");");
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
               $this->Ejecutar("update citas set fecha_ini='".$this->getfecha_ini()."',fecha_fin='".$this->getfecha_fin()."',user_id='".$this->getuser_id()."',id_tipo_solicitud=".$this->getid_tipo_solicitud()." where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update citas set fecha_ini='".$this->getfecha_ini()."',fecha_fin='".$this->getfecha_fin()."',user_id='".$this->getuser_id()."',id_tipo_solicitud=".$this->getid_tipo_solicitud()." where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from citas  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from citas  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `citas`.`id` AS `id`,`citas`.`fecha_ini` AS `fecha_ini`,`citas`.`fecha_fin` AS `fecha_fin`,`citas`.`user_id` AS `user_id`,`tipo_solicitud`.`solicitud` AS `solicitud` from (`citas` join `tipo_solicitud` on((`tipo_solicitud`.`id` = `citas`.`id_tipo_solicitud`)))) as bg where  bg.fecha_ini like '%".$this->getfecha_ini()."%'  and  bg.fecha_fin like '%".$this->getfecha_fin()."%'  and  bg.solicitud like '%".$this->getsolicitud()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `citas`.`id` AS `id`,`citas`.`fecha_ini` AS `fecha_ini`,`citas`.`fecha_fin` AS `fecha_fin`,`citas`.`user_id` AS `user_id`,`citas`.`id_tipo_solicitud` AS `id_tipo_solicitud` from `citas`) as b_i  where  b_i.fecha_ini='".$this->getfecha_ini()."' and  b_i.fecha_fin='".$this->getfecha_fin()."' and  b_i.user_id='".$this->getuser_id()."' and  b_i.id_tipo_solicitud='".$this->getid_tipo_solicitud()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `citas`.`id` AS `id`,`citas`.`fecha_ini` AS `fecha_ini`,`citas`.`fecha_fin` AS `fecha_fin`,`citas`.`user_id` AS `user_id`,`citas`.`id_tipo_solicitud` AS `id_tipo_solicitud`,`tipo_solicitud`.`solicitud` AS `solicitud` from (`citas` join `tipo_solicitud` on((`tipo_solicitud`.`id` = `citas`.`id_tipo_solicitud`)))) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
     function m_id_tipo_solicitud()
     {
          $result=$this->EjecutarSql("select * from (select `tipo_solicitud`.`id` AS `id`,`tipo_solicitud`.`solicitud` AS `descripcion` from `tipo_solicitud`) as s  ;");
     return $result;
}

}
?>
