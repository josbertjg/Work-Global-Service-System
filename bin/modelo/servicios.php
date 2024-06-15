<?php

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class servicios extends DBConnect{
   private $id;
   private $quimico;
   private $descripcion;
   private $habilitado;
   private $nombre;
   private $foto;
   private $targetFile;
   private $rutaCarpeta="assets/img/servicios/";


   private function validarSTA($datoArray,$diff){
    $arrayLogico = array(0 => "/^[A-Za-z]{3,45}$/", 
    1 => "/^[0-9]{1,45}$/", 
    2 => "/^[0-9A-Za-z- ]{0,45}$/", 3 => "/^[0-9:\/-]{1,45}$/", 4 => "/^[0-9A-Za-z ]{0,45}$/",
    5 => "/^[0-9A-Za-z ]{0,200}$/");
    foreach ($datoArray as $key) {
      $validador = preg_match_all($arrayLogico[$diff], $key);
      if($validador!=1){
        $respuesta = ["error" => "Datos Incorrectos."];
        die(json_encode($respuesta));
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
      if(json_decode($_POST['update'])) 
        die(json_encode($respuesta));
      else 
        die(json_encode($error));
    }
    public function getDelete($id,$habilitado){
      $this->delete();
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
        $consulta = "UPDATE tservicios SET habilitado = :habilitado WHERE idServicio = :id";
        $ejecucion = $this->con->prepare($consulta);
        $ejecucion->bindParam(':habilitado',$this->habilitado);
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
    public function getAll(){
      $this->SelectAll();
    }
    private function SelectAll(){
      //if(json_decode($_POST['opcion']))
      try{
        $this->conectarDB();
        $consulta = "SELECT tservicios.idServicio, tservicios.nombre, tquimicos.nombre
         as quimico, tservicios.descripcion,tservicios.fotoServicio, tservicios.habilitado 
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
        FROM tquimicos WHERE habilitado=1";
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
    public function getUpdate($id,$nombre,$quimico,$descripcion,$foto,$opcion){
      $letras= array($nombre);
      $this->validarSTA($letras,0);
      $this->nombre=$nombre;
      $letrasYnumeros=array($descripcion);
      $this->validarSTA($letrasYnumeros,5);
      $this->id=$id;
      $this->descripcion=$descripcion;
      $this->quimico=$quimico;
      $opcion=$opcion;
      if($opcion==1){
        $this->targetFile=$foto; 
      }else{
        $this->foto=$foto;
        $this->targetFile="assets/img/servicios/".basename($this->foto["name"]);
        $Filetype = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
        $this->targetFile = $this->targetFile . "." . $Filetype;
      }
      //$respuesta = ["error" => "Hola esta una prubea y no entiendo porque no esta garrando."];
      //json_encode($respuesta);
      //echo "Datos: ";
      //var_dump($this->nombre, $this->targetFile, $this->Descripcion, $this->id);
      $this->update($opcion);
    }
    private function update($opcion){
        try{
          $this->conectarDB();
          $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
          $consulta = "UPDATE tservicios SET nombre = :nombre, quimico = :quimico,
           descripcion = :descripcion, fotoServicio= :fotoServicio
           WHERE idServicio = :id";
          $ejecucion = $this->con->prepare($consulta);
          $ejecucion->bindParam(':nombre', $this->nombre);
          $ejecucion->bindParam(':quimico', $this->quimico); 
          $ejecucion->bindParam(':descripcion', $this->descripcion);
          $ejecucion->bindParam(':fotoServicio',$this->targetFile);
          $ejecucion->bindParam(':id', $this->id);
          //echo "Consulta: $consulta"; // Imprimir la consulta */
          $ejecucion->execute();
          //echo "Filas afectadas: " . $ejecucion->rowCount(); // Imprimir el número de filas afectadas
          $this->desconectarDB();
          if($opcion!=1){
            $this->SubirFoto($this->foto["tmp_name"],$this->targetFile);//linea 104
          }
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      
    }
    
    public function getAllServicios(){
      $this->returnAllServicios();
    }

    private function returnAllServicios(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tservicios");
        $new->execute();
        $servicios = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($servicios));

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }
    public function getInsert($nombre,$quimico,$descripcion, $foto){
      $letras= array($nombre);
      $this->validarSTA($letras,0);
      $this->nombre=$nombre;
      $letrasYnumeros=array($descripcion);
      $this->validarSTA($letrasYnumeros,5);
      $this->foto=$foto;
      $this->targetFile="assets/img/servicios/".basename($this->foto["name"]);
      $Filetype = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
      $this->targetFile = $this->targetFile . "." . $Filetype;
      $this->descripcion=$descripcion;
      $this->quimico=$quimico;
      $this->id=$this->separarCadena($this->nombre);
      $this->insert();
    }
    private function insert(){
      if($this->comprobarInsert($this->id,$this->quimico)){
        $respuesta = ["error" => "Este Registro ya existe."];
        die(json_encode($respuesta));
      }else{
        try{
          $this->conectarDB();
          $consulta="INSERT INTO tservicios (idServicio,nombre,quimico,descripcion,fotoServicio,habilitado) VALUES (?,?,?,?,?,?)";
          $ejecucion=$this->con->prepare($consulta);
          $ejecucion->bindValue(1,$this->id);
          $ejecucion->bindValue(2,$this->nombre);
          $ejecucion->bindValue(3,$this->quimico);
          $ejecucion->bindValue(4,$this->descripcion);
          $ejecucion->bindValue(5,$this->targetFile);
          $ejecucion->bindValue(6,1);
          $ejecucion->execute();
          $this->desconectarDB();
          $this->SubirFoto($this->foto["tmp_name"],$this->targetFile);
        }catch (\PDOException $error) {   
          $resultado = ['error' => $error->getMessage()];    
          die(json_encode($resultado));
        }
      }
      
    }
    private function separarCadena($cadena) {
      $partes = preg_split('/[\s,]+/', $cadena);
      $primeraPalabra = $partes[0];
      $cadena = "S" . strtoupper($primeraPalabra) . "WGS";
      return $cadena;
  }

    private function ComprobarId($id){
      try {
        $this->conectarDB();
        $consulta = "SELECT idServicio FROM tservicios WHERE idServicio= :id";
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

    private function comprobarInsert($id, $quimico) {
      $this->conectarDB();
      $consulta = "SELECT * FROM tservicios WHERE idServicio = :id AND quimico = :quimico";
      $ejecucion = $this->con->prepare($consulta);
      $ejecucion->bindParam(':id', $id);
      $ejecucion->bindParam(':quimico', $quimico);
      $ejecucion->execute();
      $data = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
      $this->desconectarDB();
      return !empty($data);
    }
    private function SubirFoto($temp,$targetFile){
      move_uploaded_file($temp,$targetFile);
    }
}
?>