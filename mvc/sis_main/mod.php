<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $main_titulo;
     private $main;

     private $order;

     function getid(){ return $this->id;}
     function getmain_titulo(){ return $this->main_titulo;}
     function getmain(){ return $this->main;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setmain_titulo($main_titulo){$this->main_titulo=$main_titulo;}
     function setmain($main){$this->main=$main;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into sis_main(main_titulo,main) values('".$this->getmain_titulo()."','".$this->getmain()."');");
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
               $this->Ejecutar("update sis_main set main_titulo='".$this->getmain_titulo()."',main='".$this->getmain()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update sis_main set main_titulo='".$this->getmain_titulo()."',main='".$this->getmain()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from sis_main  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from sis_main  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`main_titulo` AS `main_titulo`,`s`.`main` AS `main` from `sis_main` `s`) as bg where  main_titulo like '%".$this->getmain_titulo()."%'  and  main like '%".$this->getmain()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`main` AS `main` from `sis_main` `s`) as b_i  where  main='".$this->getmain()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `s`.`id` AS `id`,`s`.`main_titulo` AS `main_titulo`,`s`.`main` AS `main` from `sis_main` `s`) as vst  where id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
}
?>
