<?php

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class establecimientos extends DBConnect{
    private $id;
    private $nombre;
    private $tamaño;
    private $descripcion;



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
    return 0;}
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


    public function SelectAll(){
        try{
          $this->conectarDB();
          $consulta = "SELECT * FROM testablecimientos";
          $ejecucion=$this->con->prepare($consulta); 
          $ejecucion->execute();
          $data=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
          $this->desconectarDB();
          die(json_encode($data));
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        } 
      }


      public function insert($nombre,$tamaño,$descripcion){
        $this->descripcion=$descripcion;
        $this->nombre=$nombre;
        $this->tamaño=$tamaño;
        $identificador=$this->separarCadena($this->nombre);
        if($this->ComprobarId($identificador)){
          $respuesta = ["error" => "Este Registro ya existe."];
          die(json_encode($respuesta));
        }else{
          try{
            $this->conectarDB();
            $consulta="INSERT INTO testablecimientos (idEstablecimientos,nombre,descripcion,sizeE,habilitado) VALUES (?,?,?,?,?)";
            $ejecucion=$this->con->prepare($consulta);
            $ejecucion->bindValue(1,$identificador);
            $ejecucion->bindValue(2,$this->nombre);
            $ejecucion->bindValue(3,$this->descripcion);
            $ejecucion->bindValue(4,$this->tamaño);
            $ejecucion->bindValue(5,1);
            $ejecucion->execute();
            $this->desconectarDB();
          }catch (\PDOException $error) {   
            $resultado = ['error' => $error->getMessage()];    
            die(json_encode($resultado));
          }
        }
        
      }


      public function update($id,$nombre,$tamaño,$descripcion){
        $this->id=$id;
        $this->descripcion=$descripcion;
        $this->nombre=$nombre;
        $this->tamaño=$tamaño;
          try{
            $this->conectarDB();
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
            $consulta = "UPDATE testablecimientos SET nombre = :nombre, descripcion = :descripcion, sizeE = :sizeE WHERE idEstablecimientos = :id";
            $ejecucion = $this->con->prepare($consulta);
            $ejecucion->bindParam(':nombre', $this->nombre);
            $ejecucion->bindParam(':descripcion', $this->descripcion);
            $ejecucion->bindParam(':sizeE', $this->tamaño);
            $ejecucion->bindParam(':id', $this->id);
            $ejecucion->execute();
            $this->desconectarDB();
          }catch (\PDOException $e) {       
            header('Content-Type: application/json');
            die(json_encode(array("error" => $e->getMessage())));
          }
      }

      public function delete($id,$habilitado){
        $this->id=$id;
        $habilitado=(int)$habilitado;
        $habilitado = $habilitado == 1 ? 0 : 1;
        try{
          $this->conectarDB();
          $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
          $consulta = "UPDATE testablecimientos SET habilitado = :habilitado WHERE idEstablecimientos = :id";
          $ejecucion = $this->con->prepare($consulta);
          $ejecucion->bindParam(':habilitado',$habilitado);
          $ejecucion->bindParam(':id', $this->id);
          $ejecucion->execute();
          $this->desconectarDB();
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      }


      private function ComprobarId($id){
        try {
          $this->conectarDB();
          $consulta = "SELECT idEstablecimientos FROM testablecimientos WHERE idEstablecimientos= :id";
          $ejecucion=$this->con->prepare($consulta);
          $ejecucion->bindParam(':id', $this->id);
          $ejecucion->execute();
          $data=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
          $this->desconectarDB();
          if($data){
          return $data;
          }
        } catch (\PDOException $e) {
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      }

      private function separarCadena($cadena) {
        $partes = preg_split('/[\s,]+/', $cadena);
        $primeraPalabra = $partes[0];
        $cadena = "E" . strtoupper($primeraPalabra) . "WGS";
        return $cadena;
    }
    
    

}

?>