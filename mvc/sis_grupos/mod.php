<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $nombre;
     private $descripcion;

     private $order;

     function getid(){ return $this->id;}
     function getnombre(){ return $this->nombre;}
     function getdescripcion(){ return $this->descripcion;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setnombre($nombre){$this->nombre=$nombre;}
     function setdescripcion($descripcion){$this->descripcion=$descripcion;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into sis_grupos(nombre,descripcion) values('".$this->getnombre()."','".$this->getdescripcion()."');");
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
               $this->Ejecutar("update sis_grupos set nombre='".$this->getnombre()."',descripcion='".$this->getdescripcion()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update sis_grupos set nombre='".$this->getnombre()."',descripcion='".$this->getdescripcion()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from sis_grupos  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from sis_grupos  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`nombre` AS `nombre`,`s`.`descripcion` AS `descripcion` from `sis_grupos` `s`) as bg where  nombre like '%".$this->getnombre()."%'  and  descripcion like '%".$this->getdescripcion()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`nombre` AS `nombre`,`s`.`descripcion` AS `descripcion` from `sis_grupos` `s`) as b_i  where  nombre='".$this->getnombre()."' and  descripcion='".$this->getdescripcion()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`nombre` AS `nombre`,`s`.`descripcion` AS `descripcion` from `sis_grupos` `s`) as vst  where id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
}
?>
