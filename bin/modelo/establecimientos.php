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
    private $targetFile;
    private $rutaCarpeta="assets/img/establecimientos/";
    /**
     * Array para la validacion de Datos antes de la insercion 
     * a la Base de Datos
     * Orden de los Arrays:
     * 0: Solo letras sin espacios de 3 a 45 caracteres
     * 1: numeros de 1 a 35 digitos
     * 2: letras masyuculas y minisculas con
     */
    public function __construct(){
      parent::__construct();
    } 
    private function validarSTA($datoArray,$diff){
      $arrayLogico = array(0 => "/^[A-Za-z]{3,45}$/",
      1 => "/^[0-9]{1,45}$/", 
      2 => "/^[0-9A-Za-z- ]{0,45}$/", 
      3 => "/^[0-9:\/-]{1,45}$/", 
      4 => "/^[0-9A-Za-z ]{0,45}$/",
      5 => "/^.{0,200}$/",
      6=> "/^[A-Za-z\s]{3,45}$/",
      7=>"/^[\d]+(\.[\d]{1,2})?$/");
      foreach ($datoArray as $key) {
        $validador = preg_match_all($arrayLogico[$diff], $key);
        if($validador!=1){
          $respuesta = ["error" => "Datos Incorrectos."];
          die(json_encode($respuesta));
        }
      }
      return 0;
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
      public function getInsert($nombre,$tamaño,$descripcion,$foto){
        $letras=array($nombre);
        $this->validarSTA($letras,6);
        $validarDescr=array($descripcion);
        $this->validarSTA($validarDescr,5);
        $validarTamaño=array($tamaño);
        $this->validarSTA($validarTamaño,7);
        $this->descripcion=$descripcion;
        $this->nombre=$nombre;
        $this->tamaño=$tamaño;
        $this->id=$this->separarCadena($this->nombre);
        $this->foto=$foto;
        $this->validarFoto($this->foto);
        //$this->targetFile="assets/img/establecimientos/".basename($this->foto["name"]);
        //$Filetype = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
        //$this->targetFile = $this->targetFile . "." . $Filetype;
        $this->insert();
      }
      private function insert(){
        if($this->ComprobarId($this->id)){
          $respuesta = ["error" => "Este Registro ya existe."];
          die(json_encode($respuesta));
        }else{
          try{
            $this->conectarDB();
            $consulta="INSERT INTO testablecimientos (idEstablecimientos,nombre,descripcion,sizeE,icono,habilitado) VALUES (?,?,?,?,?,?)";
            $ejecucion=$this->con->prepare($consulta);
            $ejecucion->bindValue(1,$this->id);
            $ejecucion->bindValue(2,$this->nombre);
            $ejecucion->bindValue(3,$this->descripcion);
            $ejecucion->bindValue(4,$this->tamaño);
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
      public function getUpdate($id,$nombre,$tamaño,$descripcion,$foto,$opcion){
        $letras=array($nombre);
        $this->validarSTA($letras,6);
        $validarId=array($id);
        $this->validarSTA($validarId,0);
        $validarDescr=array($descripcion);
        $this->validarSTA($validarDescr,5);
        $validarNum=array($tamaño);
        $this->validarSTA($validarNum,7);
        $this->id=$id;
        $this->descripcion=$descripcion;
        $this->nombre=$nombre;
        $this->tamaño=$tamaño;
        $opcion=$opcion;
        if($opcion==2){
        $this->targetFile=$foto; 
        }else{
          $this->foto=$foto;
          $this->validarFoto($this->foto);
        //$this->targetFile="assets/img/establecimientos/".basename($this->foto["name"]);
        //$Filetype = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
        //$this->targetFile = $this->targetFile . "." . $Filetype;
        }
        $this->update($opcion);
      }
      private function update($opcion){
          try{
            $this->conectarDB();
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar errores de PDO
            $consulta = "UPDATE testablecimientos SET nombre = :nombre, descripcion = :descripcion, sizeE = :sizeE, icono=:icono WHERE idEstablecimientos = :id";
            $ejecucion = $this->con->prepare($consulta);
            $ejecucion->bindParam(':nombre', $this->nombre);
            $ejecucion->bindParam(':descripcion', $this->descripcion);
            $ejecucion->bindParam(':sizeE', $this->tamaño);
            $ejecucion->bindParam(':id', $this->id);
            $ejecucion->bindParam(':icono',$this->targetFile);
            $ejecucion->execute();
            $this->desconectarDB();
            if($opcion!=2){
              $this->SubirFoto($this->foto["tmp_name"],$this->targetFile);//linea 104
            }
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

    private function SubirFoto($temp,$targetFile){
      move_uploaded_file($temp,$targetFile);
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
            $this->targetFile = "assets/img/establecimientos/" . basename($this->foto['name']);
            $this->targetFile = $this->targetFile . "." . strtolower(pathinfo($this->foto['name'], PATHINFO_EXTENSION));
            //...
        }
      } else {
          // Error: No file uploaded
          $respuesta = ["error" => "No se ha seleccionado un archivo."];
          die(json_encode($respuesta));
      }
    }

}

?>