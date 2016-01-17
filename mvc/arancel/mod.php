<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $nombre;
     private $monto;
     private $max;

     private $order;

     function getid(){ return $this->id;}
     function getnombre(){ return $this->nombre;}
     function getmonto(){ return $this->monto;}
     function getmax(){ return $this->max;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setnombre($nombre){$this->nombre=$nombre;}
     function setmonto($monto){$this->monto=$monto;}
     function setmax($max){$this->max=$max;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into arancel(nombre,monto,max) values('".$this->getnombre()."','".$this->getmonto()."','".$this->getmax()."');");
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
               $this->Ejecutar("update arancel set nombre='".$this->getnombre()."',monto='".$this->getmonto()."',max='".$this->getmax()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update arancel set nombre='".$this->getnombre()."',monto='".$this->getmonto()."',max='".$this->getmax()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from arancel  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from arancel  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `arancel`.`id` AS `id`,`arancel`.`nombre` AS `nombre`,`arancel`.`monto` AS `monto`,`arancel`.`max` AS `max` from `arancel`) as bg where  bg.nombre like '%".$this->getnombre()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `arancel`.`id` AS `id`,`arancel`.`nombre` AS `nombre` from `arancel`) as b_i  where  b_i.nombre='".$this->getnombre()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `arancel`.`id` AS `id`,`arancel`.`nombre` AS `nombre`,`arancel`.`monto` AS `monto`,`arancel`.`max` AS `max` from `arancel`) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
}
?>
