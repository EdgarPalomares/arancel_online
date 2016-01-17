<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $id_solicitud_arancel;
     private $nro_solicitud;
     private $fecha;
     private $user_id;
     private $id_arancel;
     private $nombre;
     private $monto;
     private $max;
     private $cantidad;

     private $order;

     function getid(){ return $this->id;}
     function getid_solicitud_arancel(){ return $this->id_solicitud_arancel;}
     function getnro_solicitud(){ return $this->nro_solicitud;}
     function getfecha(){ return $this->fecha;}
     function getuser_id(){ return $this->user_id;}
     function getid_arancel(){ return $this->id_arancel;}
     function getnombre(){ return $this->nombre;}
     function getmonto(){ return $this->monto;}
     function getmax(){ return $this->max;}
     function getcantidad(){ return $this->cantidad;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setid_solicitud_arancel($id_solicitud_arancel){$this->id_solicitud_arancel=$id_solicitud_arancel;}
     function setnro_solicitud($nro_solicitud){$this->nro_solicitud=$nro_solicitud;}
     function setfecha($fecha){$this->fecha=$fecha;}
     function setuser_id($user_id){$this->user_id=$user_id;}
     function setid_arancel($id_arancel){$this->id_arancel=$id_arancel;}
     function setnombre($nombre){$this->nombre=$nombre;}
     function setmonto($monto){$this->monto=$monto;}
     function setmax($max){$this->max=$max;}
     function setcantidad($cantidad){$this->cantidad=$cantidad;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
                $this->Ejecutar("insert into solicitud_arancel_detalles(id_solicitud_arancel,id_arancel,cantidad) values('".$_SESSION['id_solicitud_arancel']."',".$this->getid_arancel().",'".$this->getcantidad()."');");
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
               $this->Ejecutar("update solicitud_arancel_detalles set cantidad='".$this->getcantidad()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update solicitud_arancel_detalles set cantidad='".$this->getcantidad()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

        function actualizar_estado()
     {
          $boolean=0;
         
                $this->Ejecutar("update solicitud_arancel set estado=1 where id=".$_SESSION['id_solicitud_arancel'].";");
                $this->Ejecutar("insert into solicitud_arancel(id_solicitud_arancel,fecha,estatus) values ("-$_SESSION['id_solicitud_arancel'].",'".date('Y-m-d g:i:s')."',1);");

               $boolean=1;
         
          return $boolean;
         }


     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from solicitud_arancel_detalles  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from solicitud_arancel_detalles  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel_detalles`.`id` AS `id`,`solicitud_arancel`.id as id_solicitud_arancel, `solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id`,`arancel`.`nombre` AS `nombre`,`arancel`.`monto` AS `monto`,`arancel`.`max` AS `max`,`solicitud_arancel_detalles`.`cantidad` AS `cantidad` from ((`solicitud_arancel_detalles` join `solicitud_arancel` on((`solicitud_arancel`.`id` = `solicitud_arancel_detalles`.`id_solicitud_arancel`))) join `arancel` on((`arancel`.`id` = `solicitud_arancel_detalles`.`id_arancel`)))) as bg where bg.id_solicitud_arancel=".$_SESSION['id_solicitud_arancel']." ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel_detalles`.`id` AS `id`,`solicitud_arancel_detalles`.`id_solicitud_arancel` AS `id_solicitud_arancel`,`solicitud_arancel_detalles`.`id_arancel` AS `id_arancel` from `solicitud_arancel_detalles`) as b_i  where  b_i.id_solicitud_arancel='".$this->getid_solicitud_arancel()."' and  b_i.id_arancel='".$this->getid_arancel()."';");
     return $result;
     }

     function buscar_encabezado()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id` from `solicitud_arancel`) as bg where  bg.id=".$_SESSION['id_solicitud_arancel'].";");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel_detalles`.`id` AS `id`,`solicitud_arancel_detalles`.`id_solicitud_arancel` AS `id_solicitud_arancel`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id`,`solicitud_arancel_detalles`.`id_arancel` AS `id_arancel`,`arancel`.`nombre` AS `nombre`,`arancel`.`monto` AS `monto`,`arancel`.`max` AS `max`,`solicitud_arancel_detalles`.`cantidad` AS `cantidad` from ((`solicitud_arancel_detalles` join `solicitud_arancel` on((`solicitud_arancel`.`id` = `solicitud_arancel_detalles`.`id_solicitud_arancel`))) join `arancel` on((`arancel`.`id` = `solicitud_arancel_detalles`.`id_arancel`)))) as vst  where vst.id=".$this->getid()."; ;");
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

     function m_id_arancel()
     {
          $result=$this->EjecutarSql("select * from (select `arancel`.`id` AS `id`,`arancel`.`nombre` AS `descripcion` from `arancel`) as s  ;");
     return $result;
}

}
?>
