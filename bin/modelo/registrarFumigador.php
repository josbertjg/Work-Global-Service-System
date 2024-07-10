<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class registrarFumigador extends DBConnect{

    private $cedula;
    private $imgCedula;
    private $ubicacionInfo;
    private $descripcion;
    private $telefono;
    private $fechaNacimiento;
    private $userID;

    public function __construct(){
    	parent::__construct();
    } 

    public function getAllCiudades(){
      $this->returnAllCiudades();
    }

    private function returnAllCiudades(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tciudades");
        $new->execute();
        $ciudades = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($ciudades));

      }catch(exection $error){
        return $error;
        die(json_encode(["error"=>"Ocurrio un error al buscar las ciudades: ".$error]));
      }
    }

    public function getAllEstados(){
      $this->returnAllEstados();
    }

    private function returnAllEstados(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM testados");
        $new->execute();
        $estados = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($estados));

      }catch(exection $error){
        return $error;
        die(json_encode(["error"=>"Ocurrio un error al buscar las estados: ".$error]));
      }
    }

    public function registerNewFumigador ($cedula, $imgCedula, $ubicacionInfo,$descripcion,$telefono,$fechaNacimiento,$userID){
      
      $cedulaIsValid = $this->validarCedula($cedula);
      if(!$cedulaIsValid) {
        $error = array("error" => "La cedula debe contener solo numeros y una longitud de entre 5 a 8 caracteres.");
        die(json_encode($error));
      }
      
      $ubicacionIsValid = $this->validarUbicacion($ubicacionInfo);
      if(!$ubicacionIsValid) {
        $error = array("error" => "La contraseña no es valida, debe tener al menos un número, una letra minúscula, una letra mayúscula, un caracter especial y una longitud de 8 caracteres.");
        die(json_encode($error));
      }

      $descripcionIsValid = $this->validarDescripcion($descripcion);
      if(!$descripcionIsValid) {
        $error = array("error" => "La descripcion debe tener una longitud de entre 25 a 1255 caracteres.");
        die(json_encode($error));
      }

      $telefonoIsValid = $this->validarTelefono($telefono);
      if(!$telefonoIsValid) {
        $error = array("error" => "El numero de telefono debe contener solo numeros y una longitud de entre 10 a 12 caracteres.");
        die(json_encode($error));
      }

      $userIdIsValid = $this->validarUserID($userID);
      if(!$userIdIsValid) {
        $error = array("error" => "El id del usuario recibido no es un ID válido, inténtalo de nuevo mas tarde.");
        die(json_encode($error));
      }

      $fechaNacimientoIsValid = $this->validarFechaNacimiento($fechaNacimiento);
      if(!$fechaNacimientoIsValid) {
        $error = array("error" => "La fecha enviada no entra en el rango de fecha especificado, dicha fecha debe ser de hace 16 años.");
        die(json_encode($error));
      }
      
      $this->cedula = $cedula;
      $this->imgCedula = $imgCedula;
      $this->ubicacionInfo = $ubicacionInfo;
      $this->descripcion = $descripcion;
      $this->telefono = $telefono;
      $this->fechaNacimiento = $fechaNacimiento;
      $this->userID = $userID;

      $this->setNewFumigador();
    }

    private function setNewFumigador(){
      $this->setNewUbicacion();

      $this->conectarDB();
      $new = $this->con->prepare("INSERT INTO `tfumigadores` (`cedula`,`email`,`idUbicacion`,`fechaNacimiento`,`imagenCedula`, `descripcion`,`activo`,`fechaValidado`) VALUES (?,?,?,?,?,?,0,'0000-00-00')"); 
      $new->bindValue(1 , $this->cedula);
      $new->bindValue(2 , $this->userID);
      $new->bindValue(3 , $this->ubicacionInfo);
      $new->bindValue(4 , $this->fechaNacimiento);
      $new->bindValue(5 , $this->imgCedula);
      $new->bindValue(6 , $this->descripcion);
      $exito = $new->execute();
      $this->desconectarDB();

      $resultado = null;
      if($exito){}
    }

    private function setNewUbicacion(){

    }

    // Validaciones
    private function validarCedula($cedula){
      $expReg = '/^[0-9]{5,8}$/i';
      return preg_match($expReg,$cedula);
    }

    private function validarUbicacion($ubicacionObj){

    }

    private function validarDescripcion($descripcion){
      return strlen($descripcion) <= 1255 && strlen($descripcion) >= 25;
    }

    private function validarTelefono($telefono){
      $expReg = '/^[0-9]{10,12}$/i';
      return preg_match($expReg,$cedula);
    }

    private function validarFechaNacimiento($fechaNacimiento){
      $fechaActual = strtotime(date("Y-m-d"));
      $dieciseisAnosAtras = $fechaActual - (16 * 365 * 24 * 60 * 60);
      $fechaRecibida = strtotime($fechaNacimiento);
      
      return ($fechaRecibida <= $dieciseisAnosAtras);
    }

    private function validarEmail($email){
      $regExp = '/^(?:(?:[^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@(?:(?:\[(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i';
      return preg_match_all($regExp, $email);
    }
    
    private function validarUserID($userID){     
      return $this->validarEmail($userID);
    }


  }

?>