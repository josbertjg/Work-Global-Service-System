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
    private $habilitado;

    public function __construct(){
    	parent::__construct();
    } 
    private function validarSTA($datoArray,$diff){
			$arrayLogico = array(0 => "/^[A-Za-z]{3,45}$/",
       1 => "/^[0-9]{1,45}$/",
        2 => "/^[0-9A-Za-z- ]{0,45}$/",
         3 => "/^[0-9:\/-]{1,45}$/", 
         4 => "/^[0-9A-Za-z ]{0,45}$/",
         5 => '/^[0-9A-Za-záéíóúÁÉÍÓÚñÑüÜ,.!@#$%^&*()_+=\[\]{}|;:\'"<>\/\\\\? ]{0,200}$/');
			foreach ($datoArray as $key) {
				$validador = preg_match_all($arrayLogico[$diff], $key);
				if($validador!=1){
          $respuesta = ["error" => "Datos Incorrectos."];
					die(json_encode($respuesta));
				}
			}
			return 0;
		}
    public function getInsert($Descripcion,$foto,$nombre){
      $letrasYnumeros= array($nombre);
      $this->validarSTA($letrasYnumeros,4);
      $ValidarDescrip=array($Descripcion);
      $this->validarSTA($ValidarDescrip,5);
      $this->nombre=$nombre;
      $this->Descripcion=$Descripcion;
      $identificador=$this->separarCadena($this->nombre);
      $identificador=strtoupper($identificador);
      $this->id=$identificador;
      $this->foto=$foto;
      $this->validarFoto();
      //$this->targetFile="assets/img/uploads/".basename($this->foto["name"]);
     // $Filetype = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
      //$this->targetFile = $this->targetFile . "." . $Filetype;
      $this->insert();
    }

    public function getUpdate($id,$Descripcion,$foto,$nombre,$opcion){
      $letrasYnumeros= array($nombre);
      $this->validarSTA($letrasYnumeros,2);
      $validarDescrip=array($Descripcion);
      $this->validarSTA($validarDescrip,5);
      $this->id=$id;
      $this->Descripcion=$Descripcion;
      $this->nombre=$nombre;
      $opcion=$opcion;
      if($opcion==1){
        $this->targetFile=$foto; 
      }else{
        $this->foto=$foto;
        $this->validarFoto();
        //$this->targetFile="assets/img/uploads/".basename($this->foto["name"]);
        //$Filetype = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
        //$this->targetFile = $this->targetFile . "." . $Filetype;
      }
      $this->update($opcion);
    }
    public function getAll(){
      $this->SelectAll();
    }
    private function SelectAll(){
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
    private function update($opcion){//linea 75
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
        var_dump($this->nombre, $this->targetFile, $this->Descripcion, $this->id); // Imprimir los datos*/
        //echo "Consulta: $consulta"; // Imprimir la consulta 
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
    public function getDelete($id,$habilitado){
      $letras=array($id);
      $numeros=array($habilitado);
      //$this->validarSTA($letras,0);
      //$this->validarSTA($numeros,1);
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
        $consulta = "UPDATE tquimicos SET habilitado = :habilitado WHERE idQuimico = :id";
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
    private function insert(){
      if($this->ComprobarId($this->id)){
        $respuesta = ["error" => "Este Registro ya existe."];
        die(json_encode($respuesta));
      }else{
        try{
          $this->conectarDB();
          $consulta="INSERT INTO tquimicos (idQuimico,nombre,foto,descripcion,habilitado) VALUES (?,?,?,?,?)";
          $ejecucion=$this->con->prepare($consulta);
          
          $ejecucion->bindValue(1,$this->id);
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
    private function validarFoto(){
      if (isset($this->foto)) {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']; // adjust to your needs
        $maxFileSize = 1024 * 1024 * 2; // 2MB, adjust to your needs
        if ($this->foto['error'] !== UPLOAD_ERR_OK) {
          // Error: File upload failed
          switch ($this->foto['error']) {
            case UPLOAD_ERR_INI_SIZE:
              $respuesta = ["error" => "Archivo supera el limite de subida."];
              die(json_encode($respuesta));
              break;
            case UPLOAD_ERR_FORM_SIZE:
              $respuesta = ["error" => "Archivo supera el limite de subida."];
              die(json_encode($respuesta));
              break;
            case UPLOAD_ERR_PARTIAL:
              $respuesta = ["error" => "Archivo no se pudo subir."];
              die(json_encode($respuesta));
              break;
            case UPLOAD_ERR_NO_FILE:
              $respuesta = ["error" => "No se ha seleccionado un archivo."];
              die(json_encode($respuesta));
              break;
            case UPLOAD_ERR_NO_TMP_DIR:
              $respuesta = ["error" => "No se ha encontrado el directorio temporal."];
              die(json_encode($respuesta));
              break;
            case UPLOAD_ERR_CANT_WRITE:
              $respuesta = ["error" => "No se ha podido escribir en el disco."];
              die(json_encode($respuesta));
              break;
            case UPLOAD_ERR_EXTENSION:
              $respuesta = ["error" => "Error de extensión."];
              die(json_encode($respuesta));
              break;
            default:
              $respuesta = ["error" => "Error de subida."];
              die(json_encode($respuesta));
              break;
            }
          } elseif (!in_array(strtolower(pathinfo($this->foto['name'], PATHINFO_EXTENSION)), $allowedTypes)) {
            // Error: Invalid file type
            $respuesta = ["error" => "Tipo de archivo no permitido."];
            die(json_encode($respuesta));
        } elseif ($this->foto['size'] > $maxFileSize) {
            // Error: File too large
            $respuesta = ["error" => "Archivo supera el limite de subida el limite es 2MB."];
            die(json_encode($respuesta));
        } else {
            // File is valid, proceed with processing
            $this->targetFile = "assets/img/uploads/" . basename($this->foto['name']);
            $this->targetFile = $this->targetFile . "." . strtolower(pathinfo($this->foto['name'], PATHINFO_EXTENSION));
            //...
        }
      } else {
          // Error: No file uploaded
          $respuesta = ["error" => "No se ha seleccionado un archivo."];
          die(json_encode($respuesta));
      }
    }


    private function SubirFoto($temp,$targetFile){
      move_uploaded_file($temp,$targetFile);
    }
}


?>