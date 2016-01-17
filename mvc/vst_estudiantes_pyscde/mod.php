<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $cedula;
     private $primer_apellido;
     private $segundo_apellido;
     private $primer_nombre;
     private $segundo_nombre;
     private $cod_carrera;
     private $carrera;
     private $cod_sede;
     private $sede;
     private $estatus;

     private $order;

     function getcedula(){ return $this->cedula;}
     function getprimer_apellido(){ return $this->primer_apellido;}
     function getsegundo_apellido(){ return $this->segundo_apellido;}
     function getprimer_nombre(){ return $this->primer_nombre;}
     function getsegundo_nombre(){ return $this->segundo_nombre;}
     function getcod_carrera(){ return $this->cod_carrera;}
     function getcarrera(){ return $this->carrera;}
     function getcod_sede(){ return $this->cod_sede;}
     function getsede(){ return $this->sede;}
     function getestatus(){ return $this->estatus;}

     function getorder(){ return $this->order;}

     function setcedula($cedula){$this->cedula=$cedula;}
     function setprimer_apellido($primer_apellido){$this->primer_apellido=$primer_apellido;}
     function setsegundo_apellido($segundo_apellido){$this->segundo_apellido=$segundo_apellido;}
     function setprimer_nombre($primer_nombre){$this->primer_nombre=$primer_nombre;}
     function setsegundo_nombre($segundo_nombre){$this->segundo_nombre=$segundo_nombre;}
     function setcod_carrera($cod_carrera){$this->cod_carrera=$cod_carrera;}
     function setcarrera($carrera){$this->carrera=$carrera;}
     function setcod_sede($cod_sede){$this->cod_sede=$cod_sede;}
     function setsede($sede){$this->sede=$sede;}
     function setestatus($estatus){$this->estatus=$estatus;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into vst_estudiantes_pyscde(primer_apellido,segundo_apellido,primer_nombre,segundo_nombre,cod_carrera,carrera,cod_sede,sede,estatus) values('".$this->getprimer_apellido()."','".$this->getsegundo_apellido()."','".$this->getprimer_nombre()."','".$this->getsegundo_nombre()."','".$this->getcod_carrera()."','".$this->getcarrera()."','".$this->getcod_sede()."','".$this->getsede()."','".$this->getestatus()."');");
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
               $this->Ejecutar("update vst_estudiantes_pyscde set primer_apellido='".$this->getprimer_apellido()."',segundo_apellido='".$this->getsegundo_apellido()."',primer_nombre='".$this->getprimer_nombre()."',segundo_nombre='".$this->getsegundo_nombre()."',cod_carrera='".$this->getcod_carrera()."',carrera='".$this->getcarrera()."',cod_sede='".$this->getcod_sede()."',sede='".$this->getsede()."',estatus='".$this->getestatus()."' where id=".$this->getcedula().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('cedula'))==($this->getcedula()))

          		{

              $this->Ejecutar("update vst_estudiantes_pyscde set primer_apellido='".$this->getprimer_apellido()."',segundo_apellido='".$this->getsegundo_apellido()."',primer_nombre='".$this->getprimer_nombre()."',segundo_nombre='".$this->getsegundo_nombre()."',cod_carrera='".$this->getcod_carrera()."',carrera='".$this->getcarrera()."',cod_sede='".$this->getcod_sede()."',sede='".$this->getsede()."',estatus='".$this->getestatus()."' where id=".$this->getcedula().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from vst_estudiantes_pyscde  where cedula=".$this->getcedula().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from vst_estudiantes_pyscde  where cedula=".$this->getcedula().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `vst_estudiantes_pyscde`.`cedula` AS `cedula`,`vst_estudiantes_pyscde`.`primer_apellido` AS `primer_apellido`,`vst_estudiantes_pyscde`.`segundo_apellido` AS `segundo_apellido`,`vst_estudiantes_pyscde`.`primer_nombre` AS `primer_nombre`,`vst_estudiantes_pyscde`.`segundo_nombre` AS `segundo_nombre`,`vst_estudiantes_pyscde`.`cod_carrera` AS `cod_carrera`,`vst_estudiantes_pyscde`.`carrera` AS `carrera`,`vst_estudiantes_pyscde`.`cod_sede` AS `cod_sede`,`vst_estudiantes_pyscde`.`sede` AS `sede`,`vst_estudiantes_pyscde`.`estatus` AS `estatus` from `vst_estudiantes_pyscde`) as bg where  bg.primer_apellido like '%".$this->getprimer_apellido()."%'  and  bg.segundo_apellido like '%".$this->getsegundo_apellido()."%'  and  bg.primer_nombre like '%".$this->getprimer_nombre()."%'  and  bg.segundo_nombre like '%".$this->getsegundo_nombre()."%'  and  bg.cod_carrera like '%".$this->getcod_carrera()."%'  and  bg.carrera like '%".$this->getcarrera()."%'  and  bg.cod_sede like '%".$this->getcod_sede()."%'  and  bg.sede like '%".$this->getsede()."%'  and  bg.estatus like '%".$this->getestatus()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `vst_estudiantes_pyscde`.`cedula` AS `cedula`,`vst_estudiantes_pyscde`.`primer_apellido` AS `primer_apellido`,`vst_estudiantes_pyscde`.`segundo_apellido` AS `segundo_apellido`,`vst_estudiantes_pyscde`.`primer_nombre` AS `primer_nombre`,`vst_estudiantes_pyscde`.`segundo_nombre` AS `segundo_nombre`,`vst_estudiantes_pyscde`.`cod_carrera` AS `cod_carrera`,`vst_estudiantes_pyscde`.`carrera` AS `carrera`,`vst_estudiantes_pyscde`.`cod_sede` AS `cod_sede`,`vst_estudiantes_pyscde`.`sede` AS `sede`,`vst_estudiantes_pyscde`.`estatus` AS `estatus` from `vst_estudiantes_pyscde`) as b_i  where  b_i.primer_apellido='".$this->getprimer_apellido()."' and  b_i.segundo_apellido='".$this->getsegundo_apellido()."' and  b_i.primer_nombre='".$this->getprimer_nombre()."' and  b_i.segundo_nombre='".$this->getsegundo_nombre()."' and  b_i.cod_carrera='".$this->getcod_carrera()."' and  b_i.carrera='".$this->getcarrera()."' and  b_i.cod_sede='".$this->getcod_sede()."' and  b_i.sede='".$this->getsede()."' and  b_i.estatus='".$this->getestatus()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `vst_estudiantes_pyscde`.`cedula` AS `cedula`,`vst_estudiantes_pyscde`.`primer_apellido` AS `primer_apellido`,`vst_estudiantes_pyscde`.`segundo_apellido` AS `segundo_apellido`,`vst_estudiantes_pyscde`.`primer_nombre` AS `primer_nombre`,`vst_estudiantes_pyscde`.`segundo_nombre` AS `segundo_nombre`,`vst_estudiantes_pyscde`.`cod_carrera` AS `cod_carrera`,`vst_estudiantes_pyscde`.`carrera` AS `carrera`,`vst_estudiantes_pyscde`.`cod_sede` AS `cod_sede`,`vst_estudiantes_pyscde`.`sede` AS `sede`,`vst_estudiantes_pyscde`.`estatus` AS `estatus` from `vst_estudiantes_pyscde`) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
}
?>
