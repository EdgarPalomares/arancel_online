<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $vigencia_solicitud;
     private $dias_elaboracion;
     private $dias_firma;
     private $dias_entrega;

     private $order;

     function getid(){ return $this->id;}
     function getvigencia_solicitud(){ return $this->vigencia_solicitud;}
     function getdias_elaboracion(){ return $this->dias_elaboracion;}
     function getdias_firma(){ return $this->dias_firma;}
     function getdias_entrega(){ return $this->dias_entrega;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setvigencia_solicitud($vigencia_solicitud){$this->vigencia_solicitud=$vigencia_solicitud;}
     function setdias_elaboracion($dias_elaboracion){$this->dias_elaboracion=$dias_elaboracion;}
     function setdias_firma($dias_firma){$this->dias_firma=$dias_firma;}
     function setdias_entrega($dias_entrega){$this->dias_entrega=$dias_entrega;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into configuraciones(vigencia_solicitud,dias_elaboracion,dias_firma,dias_entrega) values('".$this->getvigencia_solicitud()."','".$this->getdias_elaboracion()."','".$this->getdias_firma()."','".$this->getdias_entrega()."');");
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
               $this->Ejecutar("update configuraciones set vigencia_solicitud='".$this->getvigencia_solicitud()."',dias_elaboracion='".$this->getdias_elaboracion()."',dias_firma='".$this->getdias_firma()."',dias_entrega='".$this->getdias_entrega()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update configuraciones set vigencia_solicitud='".$this->getvigencia_solicitud()."',dias_elaboracion='".$this->getdias_elaboracion()."',dias_firma='".$this->getdias_firma()."',dias_entrega='".$this->getdias_entrega()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from configuraciones  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from configuraciones  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `configuraciones`.`id` AS `id`,`configuraciones`.`vigencia_solicitud` AS `vigencia_solicitud`,`configuraciones`.`dias_elaboracion` AS `dias_elaboracion`,`configuraciones`.`dias_firma` AS `dias_firma`,`configuraciones`.`dias_entrega` AS `dias_entrega` from `configuraciones`) as bg where  bg.vigencia_solicitud like '%".$this->getvigencia_solicitud()."%'  and  bg.dias_elaboracion like '%".$this->getdias_elaboracion()."%'  and  bg.dias_firma like '%".$this->getdias_firma()."%'  and  bg.dias_entrega like '%".$this->getdias_entrega()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `configuraciones`.`id` AS `id` from `configuraciones`) as b_i  where ;");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `configuraciones`.`id` AS `id`,`configuraciones`.`vigencia_solicitud` AS `vigencia_solicitud`,`configuraciones`.`dias_elaboracion` AS `dias_elaboracion`,`configuraciones`.`dias_firma` AS `dias_firma`,`configuraciones`.`dias_entrega` AS `dias_entrega` from `configuraciones`) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
}
?>
