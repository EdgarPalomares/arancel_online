<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $dependencia;
     private $descripcion;

     function getid(){ return $this->id;}
     function getdependencia(){ return $this->dependencia;}
     function getdescripcion(){ return $this->descripcion;}

     function setid($id){$this->id=$id;}
     function setdependencia($dependencia){$this->dependencia=$dependencia;}
     function setdescripcion($descripcion){$this->descripcion=$descripcion;}



     function buscar()
     {
          $result=$this->EjecutarSql("select * from sis_usuarios  where  login='".$this->getdependencia()."' and password='".$this->getdescripcion()."';");
     return $result;
     }

}
?>
