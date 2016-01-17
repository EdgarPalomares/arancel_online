<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $id_grupos;
     private $cedula;
     private $apellidos;
     private $nombres;
     private $login;
     private $password;
     private $nombre;

     function getid(){ return $this->id;}
     function getid_grupos(){ return $this->id_grupos;}
     function getcedula(){ return $this->cedula;}
     function getapellidos(){ return $this->apellidos;}
     function getnombres(){ return $this->nombres;}
     function getlogin(){ return $this->login;}
     function getpassword(){ return $this->password;}
     function getnombre(){ return $this->nombre;}

     function setid($id){$this->id=$id;}
     function setid_grupos($id_grupos){$this->id_grupos=$id_grupos;}
     function setcedula($cedula){$this->cedula=$cedula;}
     function setapellidos($apellidos){$this->apellidos=$apellidos;}
     function setnombres($nombres){$this->nombres=$nombres;}
     function setlogin($login){$this->login=$login;}
     function setpassword($password){$this->password=$password;}
     function setnombre($nombre){$this->nombre=$nombre;}

 function accesos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))
) as sisv_vst_permisos  where  modulo='usuarios' and id_grupos=".$_SESSION['id_grupos']." ;");
     return $result;
}
     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into sis_usuarios(id_grupos,cedula,apellidos,nombres,login,password) values(".$this->getid_grupos().",'".$this->getcedula()."','".$this->getapellidos()."','".$this->getnombres()."','".$this->getlogin()."','7c4a8d09ca3762af61e59520943dc26494f8941b');");
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
               $this->Ejecutar("update sis_usuarios set id_grupos=".$this->getid_grupos().",cedula='".$this->getcedula()."',apellidos='".$this->getapellidos()."',nombres='".$this->getnombres()."',login='".$this->getlogin()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update sis_usuarios set id_grupos=".$this->getid_grupos().",cedula='".$this->getcedula()."',apellidos='".$this->getapellidos()."',nombres='".$this->getnombres()."',login='".$this->getlogin()."'where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
             }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from sis_usuarios  where id=".$this->getid().";");
     return $boolean;
      }
	  
		function restablecer_pas()
				 {
					  $boolean=$this->Ejecutar("update sis_usuarios set password='7c4a8d09ca3762af61e59520943dc26494f8941b' where id=".$this->getid().";");
					   return $boolean;
			}
			
			
     function buscarid()
     {
          $result=$this->EjecutarSql("select * from sis_usuarios  where id=".$this->getid().";");
     return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `sis_usuarios`.`id` AS `id`,`sis_usuarios`.`apellidos` AS `apellidos`,`sis_usuarios`.`nombres` AS `nombres`,`sis_grupos`.`nombre` AS `nombre` from (`sis_usuarios` join `sis_grupos` on((`sis_usuarios`.`id_grupos` = `sis_grupos`.`id`)))) as sisv_bg_usuarios  where  apellidos like '%".$this->getapellidos()."%'  and  nombres like '%".$this->getnombres()."%'  and  nombre like '%".$this->getnombre()."%' ;");
     return $result;
}
	

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `sis_usuarios`.`id` AS `id`,`sis_usuarios`.`login` AS `login` from `sis_usuarios`
) as sisv_b_i_usuarios  where  login='".$this->getlogin()."';");
     return $result;
     }

     function m_id_grupos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_grupos`.`id` AS `id`,`sis_grupos`.`nombre` AS `descripcion` from `sis_grupos`
) as sisv_s_id_sis_grupos ;");
     return $result;
}

}
?>
