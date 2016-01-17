<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $unidad;
     private $fecha;
     private $is_inactiva;

     private $order;

     function getid(){ return $this->id;}
     function getunidad(){ return $this->unidad;}
     function getfecha(){ return $this->fecha;}
     function getis_inactiva(){ return $this->is_inactiva;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setunidad($unidad){$this->unidad=$unidad;}
     function setfecha($fecha){$this->fecha=$fecha;}
     function setis_inactiva($is_inactiva){$this->is_inactiva=$is_inactiva;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into unidad_tributaria(unidad,fecha,is_inactiva) values('".$this->getunidad()."','".$this->getfecha()."','".$this->getis_inactiva()."');");
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
               $this->Ejecutar("update unidad_tributaria set unidad='".$this->getunidad()."',fecha='".$this->getfecha()."',is_inactiva='".$this->getis_inactiva()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update unidad_tributaria set unidad='".$this->getunidad()."',fecha='".$this->getfecha()."',is_inactiva='".$this->getis_inactiva()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from unidad_tributaria  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from unidad_tributaria  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `unidad_tributaria`.`id` AS `id`,`unidad_tributaria`.`unidad` AS `unidad`,`unidad_tributaria`.`fecha` AS `fecha`,`unidad_tributaria`.`is_inactiva` AS `is_inactiva` from `unidad_tributaria`) as bg where  bg.unidad like '%".$this->getunidad()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `unidad_tributaria`.`id` AS `id`,`unidad_tributaria`.`unidad` AS `unidad` from `unidad_tributaria`) as b_i  where  b_i.unidad='".$this->getunidad()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `unidad_tributaria`.`id` AS `id`,`unidad_tributaria`.`unidad` AS `unidad`,`unidad_tributaria`.`fecha` AS `fecha`,`unidad_tributaria`.`is_inactiva` AS `is_inactiva` from `unidad_tributaria`) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
}
?>
