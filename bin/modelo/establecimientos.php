<?php

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class establecimientos extends DBConnect{
    private $id;
    private $nombre;
    private $tamaño;
    private $descripcion;
    private $habilitado;


   private function validarSTA($datoArray,$diff){
    $arrayLogico = array(0 => "/^[A-Za-z]{3,45}$/", 
    1 => "/^[0-9]{1,45}$/", 
    2 => "/^[0-9A-Za-z- ]{0,45}$/", 
    3 => "/^[0-9:\/-]{1,45}$/", 
    4 => "/^[0-9A-Za-z ]{0,45}$/",
    5 => "/^[0-9A-Za-z ]{0,200}$/",
    6=> "/^[A-Za-z\s]{3,45}$/");
    foreach ($datoArray as $key) {
      $validador = preg_match_all($arrayLogico[$diff], $key);
      if($validador!=1){
        $respuesta = ["error" => "Datos Incorrectos."];
					die(json_encode($respuesta));
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
    public function getAll(){
      $this->SelectAll();
    }
    private function SelectAll(){
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
      public function getInsert($nombre,$tamaño,$descripcion){
        $letras=array($nombre);
        $this->validarSTA($letras,6);
        $validarDescr=array($descripcion);
        $this->validarSTA($validarDescr,5);
        $this->descripcion=$descripcion;
        $this->nombre=$nombre;
        $this->tamaño=$tamaño;
        $this->id=$this->separarCadena($this->nombre);
        $this->insert();
      }
      private function insert(){
        if($this->ComprobarId($this->id)){
          $respuesta = ["error" => "Este Registro ya existe."];
          die(json_encode($respuesta));
        }else{
          try{
            $this->conectarDB();
            $consulta="INSERT INTO testablecimientos (idEstablecimientos,nombre,descripcion,sizeE,habilitado) VALUES (?,?,?,?,?)";
            $ejecucion=$this->con->prepare($consulta);
            $ejecucion->bindValue(1,$this->id);
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
      public function getUpdate($id,$nombre,$tamaño,$descripcion){
        $letras=array($nombre);
        $this->validarSTA($letras,6);
        $validarId=array($id);
        $this->validarSTA($validarId,0);
        $validarDescr=array($descripcion);
        $this->validarSTA($validarDescr,5);
        $this->id=$id;
        $this->descripcion=$descripcion;
        $this->nombre=$nombre;
        $this->tamaño=$tamaño;
        $this->update();
      }
      private function update(){
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
      public function getDelete($id,$habilitado){
        $this->id=$id;
        $habilitado=(int)$habilitado;
        $habilitado = $habilitado == 1 ? 0 : 1;
        $this->habilitado=$habilitado;
      }
      private function delete(){
        try{
          $this->conectarDB();
          $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
          $consulta = "UPDATE testablecimientos SET habilitado = :habilitado WHERE idEstablecimientos = :id";
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
        $cadena = "";
        foreach ($partes as $palabra) {
            $cadena .= strtoupper($palabra);
        }
        $cadena = "E" . $cadena . "WGS";
        return $cadena;
    }
    
    

}

?>