<?php
class Conexion{
     private $host_port;
     private $usr;
     private $pass;
     private $base_datos;
     private $conn;
     private $sql;
     private $result;
     private $err;
     function __construct($host_port="localhost",$usr="root",$pass="",$base_datos="arancel_online_bd")
     {
          $this->host_port=$host_port;
          $this->usr=$usr;
          $this->pass=$pass;
          $this->base_datos=$base_datos;
     }
     function Conectar()
     {
          $this->conn=mysql_connect($this->host_port,$this->usr,$this->pass);
          if($this->conn)
          {
               $this->SelBd();
          }
          else
          {
               $this->Err();
          }
      }
     function Desconectar()
     {
          if($this->conn)
          {
               mysql_close($this->conn);
          }
     }
     function SelBd()
     {
          mysql_select_db($this->base_datos,$this->conn);
     }
     function Ejecutar($sql)
     {
          $this->Conectar();
          $this->sql=$sql;
          if($this->conn)
          {
               $this->result=mysql_query($this->sql,$this->conn);
               if($this->result)
               {
                $boolean="true";
               }
              else
               {
               $this->Err();     
               $boolean="false";
          }
     }
     $this->Desconectar();
     return $boolean;
     }
     function EjecutarSql($sql)
     {
          $this->Conectar();
          $this->sql=$sql;
          if($this->conn)
          {
               $this->result=mysql_query($this->sql,$this->conn);
               if($this->result)
               {
                    $ress=$this->result;
               }
               else
               {
                    $this->Err();
                    $ress="";
               }
          }
          $this->Desconectar();
          return $ress;
     }
     function Err()
     {
          $this->err=mysql_errno().": ".mysql_error();
     }
     function getErr()
     {
          return $this->err;
     }
  }
?>