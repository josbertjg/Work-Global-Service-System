<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class quimicos extends DBConnect{
    private $id;
    private $Descripcion;
    private $foto;
    private $nombre;
    private $targetFile;
    private $rutaCarpeta="assets/img/uploads/";

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
      $prueba1 = array(
        "exito" => "si esta entrando cuando de le manda un File",
      );
      $prueba2 = array(
        "exito" => "si esta entrando en la opcion 2 y aqui deberia deberia hacer un update",
      );
      if(json_decode($_POST['fotoOriginal'])){die(json_encode($prueba2));}
      if(json_decode($_FILES['foto'])){die(json_encode($prueba1));}
      if(json_decode($_POST['insert'])) 
        die(json_encode($respuesta));
      else 
        die(json_encode($error));
    }
    
    public function SelectAll(){
      //if(json_decode($_POST['opcion']))
      try{
        $this->conectarDB();
        $consulta = "SELECT * FROM tquimicos";
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
    public function update($id,$Descripcion,$foto,$nombre,$opcion){//linea 75
      $this->id=$id;
      $this->Descripcion=$Descripcion;
      $this->nombre=$nombre;
      $opcion=$opcion;
      if($opcion==1){
        $this->targetFile=$foto; 
      }else{
        $this->foto=$foto;
        $this->targetFile="assets/img/uploads/".basename($this->foto["name"]);
        $Filetype = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
        $this->targetFile = $this->targetFile . "." . $Filetype;
      }
      try{
        $this->conectarDB();
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
        $consulta = "UPDATE tquimicos SET nombre = :nombre, foto = :foto, descripcion = :descripcion WHERE idQuimico = :id";
        $ejecucion = $this->con->prepare($consulta);
        $ejecucion->bindParam(':nombre', $this->nombre);
        $ejecucion->bindParam(':foto', $this->targetFile); // Aquí usamos targetFile en lugar de foto
        $ejecucion->bindParam(':descripcion', $this->Descripcion);
        $ejecucion->bindParam(':id', $this->id);
        /*  echo "Datos: ";
        var_dump($this->nombre, $this->targetFile, $this->Descripcion, $this->id); // Imprimir los datos
        echo "Consulta: $consulta"; // Imprimir la consulta */
        $ejecucion->execute();//linea 85
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

    public function delete($id,$habilitado){
      $this->id=$id;
      $habilitado=(int)$habilitado;
      $habilitado = $habilitado == 1 ? 0 : 1;
      try{
        $this->conectarDB();
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
        $consulta = "UPDATE tquimicos SET habilitado = :habilitado WHERE idQuimico = :id";
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
    public function insert($id,$Descripcion,$foto,$nombre){
      $this->id=$id;
      $this->Descripcion=$Descripcion;
      $this->foto=$foto;
      $this->nombre=$nombre;
      $identificador=$this->separarCadena($this->nombre);
      $identificador=strtoupper($identificador);
      $this->targetFile="assets/img/uploads/".basename($this->foto["name"]);
      $Filetype = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
      $this->targetFile = $this->targetFile . "." . $Filetype;
      if($this->ComprobarId($identificador)){
        $respuesta = ["error" => "Este Registro ya existe."];
        die(json_encode($respuesta));
      }else{
        try{
          $this->conectarDB();
          $consulta="INSERT INTO tquimicos (idQuimico,nombre,foto,descripcion,habilitado) VALUES (?,?,?,?,?)";
          $ejecucion=$this->con->prepare($consulta);
          
          $ejecucion->bindValue(1,$identificador);
          $ejecucion->bindValue(2,$this->nombre);
          $ejecucion->bindValue(3,$this->targetFile);
          $ejecucion->bindValue(4,$this->Descripcion);
          $ejecucion->bindValue(5,1);
          $ejecucion->execute();
          $this->desconectarDB();
          $this->SubirFoto($this->foto["tmp_name"],$this->targetFile);
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
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
        $resultado[] = substr($parte, 0, 2);
      }
      $cadena="";
      for($i=0;$i<count($resultado);$i++){
        $cadena=$cadena.$resultado[$i];
      }
      return $cadena;
    }


    private function ComprobarId($id){
      try {
        $this->conectarDB();
        $consulta = "SELECT idQuimico FROM tquimicos WHERE idQuimico= :id";
        $ejecucion=$this->con->prepare($consulta);
        $ejecucion->bindParam(':id', $this->id);
        $ejecucion->execute();
        $data=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
        $this->desconectarDB();
        if($data){
        return !empty($data);
        }
      } catch (\PDOException $e) {
        header('Content-Type: application/json');
        die(json_encode(array("error" => $e->getMessage())));
      }
    }




    private function SubirFoto($temp,$targetFile){
      move_uploaded_file($temp,$targetFile);
    }
}


?>