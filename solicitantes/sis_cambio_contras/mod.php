<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $anterior;
     private $actual;
     private $confirmar;

     function getid(){ return $this->id;}
     function getanterior(){ return $this->anterior;}
     function getactual(){ return $this->actual;}
     function getconfirmar(){ return $this->confirmar;}

     function setid($id){$this->id=$id;}
     function setanterior($anterior){$this->anterior=$anterior;}
     function setactual($actual){$this->actual=$actual;}
     function setconfirmar($confirmar){$this->confirmar=$confirmar;}


     function busqueda()
     {
          $result=$this->EjecutarSql("select * from sis_usuarios  where  password='".$this->getanterior()."' and id=".$_SESSION['id_usuario'].";");
     return $result;
     }
	 
	 function insertar()
     {
          $result=$this->EjecutarSql("update sis_usuarios  set  password='".$this->getconfirmar()."' where id=".$_SESSION['id_usuario'].";");
     return $result;
     }

}
?>
