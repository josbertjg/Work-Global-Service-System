<?php

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class precios extends DBConnect{
   private $id;
   private $precio;
   private $Establecimiento;
   private $Servicio;
   private $habilitado;

   private function validarSTA($datoArray,$diff){
    $arrayLogico = array(0 => "/^[A-Za-z]{3,30}$/", 
    1 => "/^[0-9]{1,30}$/", 
    2 => "/^[0-9A-Za-z- ]{0,30}$/", 3 => "/^[0-9:\/-]{1,30}$/", 4 => "/^[0-9A-Za-z ]{0,30}$/");
    foreach ($datoArray as $key) {
      $validador = preg_match_all($arrayLogico[$diff], $key);
      if($validador!=1){
        exit("Datos incorrectos");
      }
    }
    return 0;
  } 

    public function __construct(){
    	parent::__construct();
    } 
    public function funcionPrueba(){
      $respuesta = array(
        "nombre" => "Juan Pérez",
        "correo" => "juan.perez@correo.com",
        "edad" => 30
      );

      $error = array(
        "error" => "esta es la respuesta personalizada cuanto ocurre un 'error' desde el modelo",
      );
      if(json_decode($_POST['opcion'])) 
        die(json_encode($respuesta));
      else 
        die(json_encode($error));
    }

    public function SelectServicios(){
        //if(json_decode($_POST['opcion']))
        try{
          $this->conectarDB();
          $consulta = "SELECT tservicios.nombre, tservicios.idServicio 
          FROM tservicios WHERE habilitado=1";
          $ejecucion=$this->con->prepare($consulta);
          $ejecucion->execute();
          $data=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
          //print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
          //json_encode($data);
          $this->desconectarDB();
          die(json_encode($data));
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      }

      public function SelectEstablecimiento(){
        //if(json_decode($_POST['opcion']))
        try{
          $this->conectarDB();
          $consulta = "SELECT testablecimientos.nombre, testablecimientos.idEstablecimientos 
          FROM testablecimientos WHERE habilitado=1";
          $ejecucion=$this->con->prepare($consulta);
          $ejecucion->execute();
          $data=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
          //print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
          //json_encode($data);
          $this->desconectarDB();
          die(json_encode($data));
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      }
      public function getAll(){
        $this->SelectAll();
      }
      private function SelectAll(){
            //if(json_decode($_POST['opcion']))
            try{
                $this->conectarDB();
                $consulta = "SELECT tprecioservicios.id, tservicios.nombre as Servicio,
                 testablecimientos.nombre as Establecimiento, tprecioservicios.precio, 
                 tprecioservicios.habilitado FROM tprecioservicios 
                 INNER JOIN tservicios ON tservicios.idServicio=tprecioservicios.servicio 
                 INNER JOIN testablecimientos 
                 ON testablecimientos.idEstablecimientos=tprecioservicios.establecimiento;";
                $ejecucion=$this->con->prepare($consulta);
                $ejecucion->execute();
                $data=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
                //print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
                //json_encode($data);
                $this->desconectarDB();
                die(json_encode($data));
              }catch (\PDOException $e) {       
                header('Content-Type: application/json');
                die(json_encode(array("error" => $e->getMessage())));
              }
      }

      private function comprobarInsert($Servicio, $Establecimiento) {
        $this->conectarDB();
        $consulta = "SELECT * FROM tprecioservicios WHERE servicio  = :servicio  AND establecimiento  = :establecimiento";
        $ejecucion = $this->con->prepare($consulta);
        $ejecucion->bindParam(':servicio', $Servicio);
        $ejecucion->bindParam(':establecimiento', $Establecimiento);
        $ejecucion->execute();
        $data = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
        $this->desconectarDB();
        return !empty($data);
      }
      public function getInsert($Establecimiento,$Precio,$Servicio){
        $this->Establecimiento=$Establecimiento;
        $this->precio=$Precio;
        $this->Servicio=$Servicio;
        $this->insert();
      }
      public function insert(){
        if($this->comprobarInsert($this->Servicio,$this->Establecimiento)){
          $respuesta = ["error" => "Este Registro ya existe."];
          die(json_encode($respuesta));
        }else{
          try{
            $this->conectarDB();
            $consulta="INSERT INTO tprecioservicios (servicio,establecimiento,precio,habilitado) VALUES (?,?,?,?)";
            $ejecucion=$this->con->prepare($consulta);
            $ejecucion->bindValue(1,$this->Servicio);
            $ejecucion->bindValue(2,$this->Establecimiento);
            $ejecucion->bindValue(3,$this->precio);
            $ejecucion->bindValue(4,1);
            $ejecucion->execute();
            $this->desconectarDB();
          }catch (\PDOException $error) {   
            $resultado = ['error' => $error->getMessage()];    
            die(json_encode($resultado));
          }
        }
        
      }
      public function getDelete($id,$habilitado){
        $this->id=$id;
        $habilitado=(int)$habilitado;
        $habilitado = $habilitado == 1 ? 0 : 1;
        $this->habilitado=$habilitado;
        $this->delete();
      }
      private function delete(){
        try{
          $this->conectarDB();
          $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
          $consulta = "UPDATE tprecioservicios SET habilitado = :habilitado WHERE id = :id";
          $ejecucion = $this->con->prepare($consulta);
          $ejecucion->bindParam(':habilitado',$this->habilitado);
          $ejecucion->bindParam(':id', $this->id);
          $ejecucion->execute();
          $this->desconectarDB();
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      }

      public function getUpdate($id,$precio){
        $this->precio=$precio;
        $this->id=$id;
        $this->update();
      }
      private function update(){
        try{
          $this->conectarDB();
          $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
          $consulta = "UPDATE tprecioservicios SET precio = :precio
           WHERE id = :id";
          $ejecucion = $this->con->prepare($consulta);
          $ejecucion->bindParam(':precio', $this->precio);
          $ejecucion->bindParam(':id', $this->id);
          $ejecucion->execute();
          $this->desconectarDB();
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      }
  }

?>