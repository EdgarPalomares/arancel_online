<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $nro_solicitud;
     private $fecha;
     private $user_id;
     private $correlativo;

     private $order;

     function getid(){ return $this->id;}
     function getnro_solicitud(){ return $this->nro_solicitud;}
     function getfecha(){ return $this->fecha;}
     function getuser_id(){ return $this->user_id;}
     function getcorrelativo(){ return $this->correlativo;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setnro_solicitud($nro_solicitud){$this->nro_solicitud=$nro_solicitud;}
     function setfecha($fecha){$this->fecha=$fecha;}
     function setuser_id($user_id){$this->user_id=$user_id;}
     function setcorrelativo($correlativo){$this->correlativo=$correlativo;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into solicitud_arancel(nro_solicitud,fecha,user_id,id_carrera_sedes,estatus) values('".$this->getnro_solicitud()."','".date('Y-m-d g:i:s')."','".$this->getuser_id()."',".$_SESSION['id_carrera_sedes'].",0);");
               $this->Ejecutar("update correlativos set nro_solicitud=".$this->getcorrelativo());
               

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
               $this->Ejecutar("update solicitud_arancel set nro_solicitud='".$this->getnro_solicitud()."',fecha='".$this->getfecha()."',user_id='".$this->getuser_id()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update solicitud_arancel set nro_solicitud='".$this->getnro_solicitud()."',fecha='".$this->getfecha()."',user_id='".$this->getuser_id()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from solicitud_arancel  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from solicitud_arancel  where id=".$this->getid().";");
          return $result;
}
 function maxid()
     {
          $result=$this->EjecutarSql("select max(id) as id from solicitud_arancel  ;");
          return $result;
}

 function correlativos()
     {
          $result=$this->EjecutarSql("select * from  correlativos  ;");
          return $result;
}


     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id` from `solicitud_arancel`) as bg where  user_id=".$_SESSION['id_usuario']." and (bg.nro_solicitud like '%".$this->getnro_solicitud()."%'  and  bg.fecha like '%".$this->getfecha()."%'  ".$this->getorder()." );");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id` from `solicitud_arancel`) as b_i  where  b_i.nro_solicitud='".$this->getnro_solicitud()."' and  b_i.fecha='".$this->getfecha()."' and  b_i.user_id='".$this->getuser_id()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id` from `solicitud_arancel`) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
  function rel_existente_solicitud_arancel_estatus()
     {
          $result=$this->EjecutarSql("select * from solicitud_arancel_estatus  where id_solicitud_arancel=".$this->getid().";");
     return $result;
     }

  function rel_existente_solicitud_arancel_detalles()
     {
          $result=$this->EjecutarSql("select * from solicitud_arancel_detalles  where id_solicitud_arancel=".$this->getid().";");
     return $result;
     }

}
?>
