<?php

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class servicios extends DBConnect{
   private $id;
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
      if(json_decode($_POST['prueba'])) 
        die(json_encode($respuesta));
      else 
        die(json_encode($error));
    }
    public function delete($id,$habilitado){
      $this->id=$id;
      $habilitado=(int)$habilitado;
      $habilitado = $habilitado == 1 ? 0 : 1;
      try{
        $this->conectarDB();
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
        $consulta = "UPDATE tservicios SET habilitado = :habilitado WHERE idServicio = :id";
        $ejecucion = $this->con->prepare($consulta);
        $ejecucion->bindParam(':habilitado',$habilitado);
        $ejecucion->bindParam(':id', $this->id);
        /* echo "Datos: ";
        var_dump($this->nombre, $this->targetFile, $this->Descripcion, $this->id); // Imprimir los datos
        echo "Consulta: $consulta"; // Imprimir la consulta */ 
        $ejecucion->execute();//linea 85
        /* echo "Filas afectadas: " . $ejecucion->rowCount(); // Imprimir el número de filas afectadas */
        $this->desconectarDB();
      }catch (\PDOException $e) {       
        header('Content-Type: application/json');
        die(json_encode(array("error" => $e->getMessage())));
      }
    }

    public function SelectAll(){
      //if(json_decode($_POST['opcion']))
      try{
        $this->conectarDB();
        $consulta = "SELECT tservicios.idServicio, tservicios.nombre, tquimicos.nombre
         as quimico, tservicios.descripcion, tservicios.habilitado 
        FROM tservicios 
        INNER JOIN tquimicos on tservicios.quimico=tquimicos.idQuimico
        ";
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


    public function SelectQuimicos(){
      //if(json_decode($_POST['opcion']))
      try{
        $this->conectarDB();
        $consulta = "SELECT tquimicos.nombre, tquimicos.idQuimico 
        FROM tquimicos";
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

    


}

?>