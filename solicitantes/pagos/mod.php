<?php
require_once '../../lib/conexion.lib.php';
require_once '../../lib/rs.lib.php';
class mod extends Conexion{
     private $id;
     private $id_solicitud_arancel;
     private $nro_solicitud;
     private $fecha;
     private $user_id;
     private $id_bancos;
     private $banco;
     private $monto;
     private $nro_deposito;

     private $order;

     function getid(){ return $this->id;}
     function getid_solicitud_arancel(){ return $this->id_solicitud_arancel;}
     function getnro_solicitud(){ return $this->nro_solicitud;}
     function getfecha(){ return $this->fecha;}
     function getuser_id(){ return $this->user_id;}
     function getid_bancos(){ return $this->id_bancos;}
     function getbanco(){ return $this->banco;}
     function getmonto(){ return $this->monto;}
     function getnro_deposito(){ return $this->nro_deposito;}

     function getorder(){ return $this->order;}

     function setid($id){$this->id=$id;}
     function setid_solicitud_arancel($id_solicitud_arancel){$this->id_solicitud_arancel=$id_solicitud_arancel;}
     function setnro_solicitud($nro_solicitud){$this->nro_solicitud=$nro_solicitud;}
     function setfecha($fecha){$this->fecha=$fecha;}
     function setuser_id($user_id){$this->user_id=$user_id;}
     function setid_bancos($id_bancos){$this->id_bancos=$id_bancos;}
     function setbanco($banco){$this->banco=$banco;}
     function setmonto($monto){$this->monto=$monto;}
     function setnro_deposito($nro_deposito){$this->nro_deposito=$nro_deposito;}

     function setorder($order){$this->order=$order;}

     function insertar()
     {
          $boolean=0;
          $result=new Rs($this->buscar());
          if (($result->getRowCount())==0)
          {
               $this->Ejecutar("insert into pagos(id_solicitud_arancel,id_bancos,monto,nro_deposito) values('".$_SESSION['id_solicitud_arancel']."',".$this->getid_bancos().",'".$this->getmonto()."','".$this->getnro_deposito()."');");
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
               $this->Ejecutar("update pagos set id_solicitud_arancel=".$this->getid_solicitud_arancel().",id_bancos=".$this->getid_bancos().",monto='".$this->getmonto()."',nro_deposito='".$this->getnro_deposito()."' where id=".$this->getid().";");
               $boolean=1;
          }
          else
           {
           if ($result->Registros())
 
          	{
				 if (($result->getCampo('id'))==($this->getid()))

          		{

              $this->Ejecutar("update pagos set id_solicitud_arancel=".$this->getid_solicitud_arancel().",id_bancos=".$this->getid_bancos().",monto='".$this->getmonto()."',nro_deposito='".$this->getnro_deposito()."' where id=".$this->getid().";");
 
               $boolean=1;

			   }

			 
			 }
          }
         return $boolean;
        }

     function eliminar()
     {
            $boolean=$this->Ejecutar("delete from pagos  where id=".$this->getid().";");
          return $boolean;
      }

     function buscarid()
     {
          $result=$this->EjecutarSql("select * from pagos  where id=".$this->getid().";");
          return $result;
}

     function busqueda()
     {
          $result=$this->EjecutarSql("select * from (select `pagos`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id`,`bancos`.`banco` AS `banco`,`pagos`.`monto` AS `monto`,`pagos`.`nro_deposito` AS `nro_deposito` from ((`pagos` join `solicitud_arancel` on((`solicitud_arancel`.`id` = `pagos`.`id_solicitud_arancel`))) join `bancos` on((`bancos`.`id` = `pagos`.`id_bancos`)))) as bg where  bg.nro_solicitud like '%".$this->getnro_solicitud()."%'  and  bg.nro_deposito like '%".$this->getnro_deposito()."%'  ".$this->getorder()." ;");
     return $result;
}

     function buscar()
     {
          $result=$this->EjecutarSql("select * from (select `pagos`.`id` AS `id`,`pagos`.`id_solicitud_arancel` AS `id_solicitud_arancel` from `pagos`) as b_i  where  b_i.id_solicitud_arancel='".$this->getid_solicitud_arancel()."';");
     return $result;
     }

     function buscar_vst()
     {
          $result=$this->EjecutarSql("select * from (select `pagos`.`id` AS `id`,`pagos`.`id_solicitud_arancel` AS `id_solicitud_arancel`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id`,`pagos`.`id_bancos` AS `id_bancos`,`bancos`.`banco` AS `banco`,`pagos`.`monto` AS `monto`,`pagos`.`nro_deposito` AS `nro_deposito` from ((`pagos` join `solicitud_arancel` on((`solicitud_arancel`.`id` = `pagos`.`id_solicitud_arancel`))) join `bancos` on((`bancos`.`id` = `pagos`.`id_bancos`)))) as vst  where vst.id=".$this->getid()."; ;");
     return $result;
     }
     function buscar_encabezado()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `nro_solicitud`,`solicitud_arancel`.`fecha` AS `fecha`,`solicitud_arancel`.`user_id` AS `user_id` from `solicitud_arancel`) as bg where  bg.id=".$_SESSION['id_solicitud_arancel'].";");
     return $result;
     }

     function busqueda_permisos()
     {
          $result=$this->EjecutarSql("select * from (select `sis_permisos`.`id` AS `id`,`sis_permisos`.`id_grupos` AS `id_grupos`,`sis_permisos`.`id_modulos` AS `id_modulos`,`sis_permisos`.`seleccionar` AS `seleccionar`,`sis_permisos`.`insertar` AS `insertar`,`sis_permisos`.`actualizar` AS `actualizar`,`sis_permisos`.`eliminar` AS `eliminar`,`sis_permisos`.`ejecutar` AS `ejecutar`,`sis_modulos`.`descripcion` AS `descripcion`,`sis_modulos`.`modulo` AS `modulo` from (`sis_permisos` join `sis_modulos` on((`sis_modulos`.`id` = `sis_permisos`.`id_modulos`)))) as sisv_vst_permisos where  modulo='".$_SESSION["modulo_permisos"]."' and id_grupos=".$_SESSION["id_grupos"].";");
     return $result;
     }
     function m_id_solicitud_arancel()
     {
          $result=$this->EjecutarSql("select * from (select `solicitud_arancel`.`id` AS `id`,`solicitud_arancel`.`nro_solicitud` AS `descripcion` from `solicitud_arancel`) as s  ;");
     return $result;
}

     function m_id_bancos()
     {
          $result=$this->EjecutarSql("select * from (select `bancos`.`id` AS `id`,`bancos`.`banco` AS `descripcion` from `bancos`) as s  ;");
     return $result;
}

}
?>
