<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $tabla;
     private $id_sis_main;
     private $descripcion;
     private $main_titulo;

     private $order;

     function getid(){ return $this->id;}
     function gettabla(){ return $this->tabla;}
     function getid_sis_main(){ return $this->id_sis_main;}
     function getdescripcion(){ return $this->descripcion;}
     function getmain_titulo(){ return $this->main_titulo;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function settabla($tabla){$this->tabla=$tabla;}
     function setid_sis_main($id_sis_main){$this->id_sis_main=$id_sis_main;}
     function setdescripcion($descripcion){$this->descripcion=$descripcion;}
     function setmain_titulo($main_titulo){$this->main_titulo=$main_titulo;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into sis_tablas(tabla,id_sis_main,descripcion) values('".$this->gettabla()."',".$this->getid_sis_main().",'".$this->getdescripcion()."');");
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
               $this->Ejecutar("update sis_tablas set tabla='".$this->gettabla()."',id_sis_main=".$this->getid_sis_main().",descripcion='".$this->getdescripcion()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update sis_tablas set tabla='".$this->gettabla()."',id_sis_main=".$this->getid_sis_main().",descripcion='".$this->getdescripcion()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from sis_tablas  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from sis_tablas  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`tabla` AS `tabla`,`s`.`descripcion` AS `descripcion`,`sis_main`.`main_titulo` AS `main_titulo` from (`sis_tablas` `s` join `sis_main` on((`sis_main`.`id` = `s`.`id_sis_main`)))) as bg where  tabla like '%".$this->gettabla()."%'  and  descripcion like '%".$this->getdescripcion()."%'  and  main_titulo like '%".$this->getmain_titulo()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`tabla` AS `tabla`,`s`.`id_sis_main` AS `id_sis_main`,`s`.`descripcion` AS `descripcion` from `sis_tablas` `s`) as b_i  where  tabla='".$this->gettabla()."' and  id_sis_main='".$this->getid_sis_main()."' and  descripcion='".$this->getdescripcion()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`tabla` AS `tabla`,`s`.`id_sis_main` AS `id_sis_main`,`s`.`descripcion` AS `descripcion`,`sis_main`.`main_titulo` AS `main_titulo` from (`sis_tablas` `s` join `sis_main` on((`sis_main`.`id` = `s`.`id_sis_main`)))) as vst  where id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
     function m_id_sis_main()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`main_titulo` AS `descripcion` from `sis_main` `s`) as s  ;");
     return $result;
}

}
?>
