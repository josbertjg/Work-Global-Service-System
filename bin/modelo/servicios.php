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


   private function validarSTA($datoArray,$diff){
    $arrayLogico = array(0 => "/^[A-Za-z]{3,30}$/", 
    1 => "/^[0-9]{1,30}$/", 
    2 => "/^[0-9A-Za-z- ]{0,30}$/", 3 => "/^[0-9:\/-]{1,30}$/", 4 => "/^[0-9A-Za-z ]{0,30}$/");
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
      if(json_decode($_POST['opcion'])) 
        die(json_encode($respuesta));
      else 
        die(json_encode($error));
    }
    public function getInsert(){
      
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
    public function update($id,$nombre,$quimico,$descripcion){//linea 75
      $this->id=$id;
      $this->descripcion=$descripcion;
      $this->nombre=$nombre;
      $this->quimico=$quimico;
      if($this->comprobarInsert($this->id,$this->quimico)){
        $respuesta = ["error" => "Este Registro ya existe."];
        die(json_encode($respuesta));
      }else{
        try{
          $this->conectarDB();
          $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
          $consulta = "UPDATE tservicios SET nombre = :nombre, quimico = :quimico, descripcion = :descripcion WHERE idServicio = :id";
          $ejecucion = $this->con->prepare($consulta);
          $ejecucion->bindParam(':nombre', $this->nombre);
          $ejecucion->bindParam(':quimico', $this->quimico); // Aquí usamos targetFile en lugar de foto
          $ejecucion->bindParam(':descripcion', $this->descripcion);
          $ejecucion->bindParam(':id', $this->id);
          /*  echo "Datos: ";
          var_dump($this->nombre, $this->targetFile, $this->Descripcion, $this->id); // Imprimir los datos
          echo "Consulta: $consulta"; // Imprimir la consulta */
          $ejecucion->execute();
          //echo "Filas afectadas: " . $ejecucion->rowCount(); // Imprimir el número de filas afectadas
          $this->desconectarDB();
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
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
    
    public function insert($nombre,$quimico,$descripcion){
      $this->descripcion=$descripcion;
      $this->nombre=$nombre;
      $this->quimico=$quimico;
      $identificador=$this->separarCadena($this->nombre);
      if($this->comprobarInsert($identificador,$this->quimico)){
        $respuesta = ["error" => "Este Registro ya existe."];
        die(json_encode($respuesta));
      }else{
        try{
          $this->conectarDB();
          $consulta="INSERT INTO tservicios (idServicio,nombre,quimico,descripcion,habilitado) VALUES (?,?,?,?,?)";
          $ejecucion=$this->con->prepare($consulta);
          $ejecucion->bindValue(1,$identificador);
          $ejecucion->bindValue(2,$this->nombre);
          $ejecucion->bindValue(3,$this->quimico);
          $ejecucion->bindValue(4,$this->descripcion);
          $ejecucion->bindValue(5,1);
          $ejecucion->execute();
          $this->desconectarDB();
        }catch (\PDOException $error) {   
          $resultado = ['error' => $error->getMessage()];    
          die(json_encode($resultado));
        }
      }
      
    }
    private function separarCadena($cadena) {
      // Reemplazar múltiples espacios en blanco con un solo espacio
      $cadena = preg_replace('/\s+/', ' ', $cadena);
      // Dividir la cadena en palabras si hay un espacio en blanco en medio
      $partes = explode(' ', $cadena);
      // Obtener las dos primeras letras de cada palabra
      $resultado = array();
      foreach ($partes as $parte) {
        $resultado[] = substr($parte, 0, 1);
      }
      $cadena="SERV";
      for($i=0;$i<count($resultado);$i++){
        $cadena=$cadena.$resultado[$i];
      }
/*       $variableAux=$this->ComprobarId($cadena);
      if($variableAux==null){
        return $cadena;
      }else{
        $timestamp = time(); // Obtiene el timestamp actual
        $dateString = date('Y-m-d H:i:s', $timestamp);
        $cadena=$cadena.$dateString;
        return $cadena;
      } */
      $cadena=strtoupper($cadena);
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
}

?>