<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class registrarFumigador extends DBConnect{

    private $cedula;
    private $imgCedula;
    private $direccion;
    private $ciudad_id;
    private $estado_id;
    private $descripcion;
    private $telefono;
    private $fechaNacimiento;
    private $latitud;
    private $longitud;
    private $diaInicio;
    private $diaFin;
    private $horaInicio;
    private $horaFin;

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

    public function validarUsuario(){
      if($this->userIsValid()) die(json_encode(["success"=>"El usuario no contiene ninguna solicitud previa para ser fumigador."]));
      else die(json_encode(["error"=>"Ya hiciste una solicitud para registrarte como fumigador, porfavor espera a que un administrador se contacte contigo, muchas gracias!"]));
    }

    private function userIsValid(){
      if(empty($_SESSION["email"])) die(json_encode(["error"=>"El usuario a validar aún no esta logueado."]));

      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tfumigadores WHERE email = ?");
        $new->bindValue(1, $_SESSION["email"]);
        $new->execute();
        $fumigador = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        if(empty($fumigador)) return true;
        else return false;

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function registerNewFumigador ($cedula, $imgCedula, $direccion,$ciudad_id,$estado_id,$descripcion,$telefono,$fechaNacimiento,$latitud,$longitud,$diaInicio,$diaFin,$horaInicio,$horaFin){
      
      $cedulaIsValid = $this->validarCedula($cedula);
      if(!$cedulaIsValid) {
        $error = array("error" => "Ya existe un fumigador que tiene esta cedula, porfavor intentalo de nuevo.");
        die(json_encode($error));
      }
      
      $direccionIsValid = $this->validarDireccion($direccion);
      if(!$direccionIsValid) {
        $error = array("error" => "La direccion debe tener entre 5 y 1255 caracteres.");
        die(json_encode($error));
      }

      $ciudadIsValid = $this->validarCiudad($ciudad_id);
      if(!$ciudadIsValid) {
        $error = array("error" => "La ciudad recibida es inválida o no existe, intentalo de nuevo.");
        die(json_encode($error));
      }

      $estadoIsValid = $this->validarEstado($estado_id);
      if(!$estadoIsValid) {
        $error = array("error" => "El estado recibido es inválido o no existe, intentalo de nuevo.");
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

      $fechaNacimientoIsValid = $this->validarFechaNacimiento($fechaNacimiento);
      if(!$fechaNacimientoIsValid) {
        $error = array("error" => "La fecha enviada no entra en el rango de fecha especificado, dicha fecha debe ser de hace 16 años.");
        die(json_encode($error));
      }

      $latitudIsValid = $this->validarLatitud($latitud);
      if(!$latitudIsValid) {
        $error = array("error" => "La coordenada latitud es inválida, intentalo mas tarde.");
        die(json_encode($error));
      }

      $longitudIsValid = $this->validarLongitud($longitud);
      if(!$longitudIsValid) {
        $error = array("error" => "La coordenada longitud es inválida, intentalo mas tarde.");
        die(json_encode($error));
      }

      $diaInicioIsValid = $this->validarDia($diaInicio);
      if(!$diaInicioIsValid) {
        $error = array("error" => "El dia de inicio es inválido, se debe recibir un número entre el 1 y el 7 como ID del día seleccionado.");
        die(json_encode($error));
      }

      $diaFinIsValid = $this->validarDia($diaFin);
      if(!$diaFinIsValid) {
        $error = array("error" => "El dia final es inválido, se debe recibir un número entre el 1 y el 7 como ID del día seleccionado.");
        die(json_encode($error));
      }

      $horasAreValid = $this->validarHoras($horaInicio,$horaFin);
      if(!$horasAreValid) {
        $error = array("error" => "La hora de inicio debe ser menor a la hora de finalización laboral.");
        die(json_encode($error));
      }
     
      $this->cedula = $cedula;
      $this->imgCedula = $imgCedula;
      $this->direccion = $direccion;
      $this->ciudad_id = $ciudad_id;
      $this->estado_id = $estado_id;
      $this->descripcion = $descripcion;
      $this->telefono = $telefono;
      $this->fechaNacimiento = $fechaNacimiento;
      $this->latitud = $latitud;
      $this->longitud = $longitud;
      $this->diaInicio = $diaInicio;
      $this->diaFin = $diaFin;
      $this->horaInicio = $horaInicio;
      $this->horaFin = $horaFin;

      $this->setNewFumigador();
    }

    private function setNewFumigador(){

      if(!$this->userIsValid()) die(["error"=>"Ya hiciste una solicitud para registrarte como fumigador, porfavor espera a que un administrador se ponga en contacto contigo, gracias!"]);
      $id_ubicacion = $this->setNewUbicacion();
      $this->imgCedula = $this->saveImagenCedula();

      try{
        $this->conectarDB();
        $new = $this->con->prepare("INSERT INTO `tfumigadores` (`cedula`,`email`,`idUbicacion`,`fechaNacimiento`,`imagenCedula`, `descripcion`,`activo`,`fechaValidado`) VALUES (?,?,?,?,?,?,0,'0000-00-00')"); 
        $new->bindValue(1 , $this->cedula);
        $new->bindValue(2 , $_SESSION["email"]);
        $new->bindValue(3 , $id_ubicacion);
        $new->bindValue(4 , $this->fechaNacimiento);
        $new->bindValue(5 , $this->imgCedula);
        $new->bindValue(6 , $this->descripcion);
        $exito = $new->execute();
        $this->desconectarDB();

        if($exito) $this->setNewCalnedario();
        else die(json_encode(["error"=>"Ocurrió un error al enviar tu registro, intentalo de nuevo mas tarde."]));

      }catch(exception $error){
        die(json_encode(["error"=>$error]));
      }

    }

    private function setNewUbicacion(){

      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tubicaciones WHERE idUbicacion = ?");
        $new->bindValue(1, $this->latitud.$this->longitud);
        $new->execute();
        $ubicacion = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }

      if(!empty($ubicacion)) return $this->latitud.$this->longitud;

      try{
        $this->conectarDB();
        $new = $this->con->prepare("INSERT INTO `tubicaciones` (`idUbicacion`,`latitud`,`longitud`,`direccion`, `ciudad`) VALUES (?,?,?,?,?)"); 
        $new->bindValue(1 , $this->latitud.$this->longitud);
        $new->bindValue(2 , $this->latitud);
        $new->bindValue(3 , $this->longitud);
        $new->bindValue(4 , $this->direccion);
        $new->bindValue(5 , $this->ciudad_id);
        $exito = $new->execute();
        $this->desconectarDB();

        if($exito) return $this->latitud.$this->longitud;
        else die(json_decode(["error"=>"Ocurrió un error al registrar tu ubicación, intentalo de nuevo porfavor"]));

      }catch(exception $error){
        die(json_encode(["error"=>$error]));
      }
    }

    private function saveImagenCedula(){
      $tmp_name = $this->imgCedula["tmp_name"];
      $rutaBase = "assets/img/uploads/cedulas/";
      $extension = ".".pathinfo($this->imgCedula['name'], PATHINFO_EXTENSION);
      $rutaCompleta = $rutaBase.$_SESSION["email"].$extension;

      if(move_uploaded_file($tmp_name,$rutaCompleta)) return $rutaCompleta;
      else die(json_encode(["error", "Error al tratar de guardar la cedula en el servidor, intentalo mas tarde."]));
      
    }

    private function setNewCalnedario(){
      try{
        $this->conectarDB();
        $new = $this->con->prepare("INSERT INTO `tcalendarios` (`cedula`,`inicioHora`,`finHora`,`diaInicio`, `diaFin`) VALUES (?,?,?,?,?)"); 
        $new->bindValue(1 , $this->cedula);
        $new->bindValue(2 , $this->horaInicio);
        $new->bindValue(3 , $this->horaFin);
        $new->bindValue(4 , $this->diaInicio);
        $new->bindValue(5 , $this->diaFin);
        $exito = $new->execute();
        $this->desconectarDB();

        if($exito) die(json_encode(["success"=>"Tu solicitud para registrarte como fumigador ha sido enviada."]));
        else die(json_decode(["error"=>"Ocurrió un error al registrar tu calendario de disponibilidad, intentalo de nuevo porfavor."]));

      }catch(exception $error){
        die(json_encode(["error"=>$error]));
      }
    }

    // Validaciones
    private function validarCedula($cedula){
      $expReg = '/^[0-9]{5,8}$/i';
      if(!preg_match($expReg,$cedula)) die(json_encode(["error"=>"La cedula debe contener solo numeros y una longitud de entre 5 a 8 caracteres."]));

      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tfumigadores WHERE cedula = ?");
        $new->bindValue(1, $cedula);
        $new->execute();
        $cedula = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return !!empty($cedula);

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }

    }

    private function validarDireccion($direccion){
      return strlen($direccion) <= 1255 && strlen($direccion) >= 5;
    }

    private function validarDescripcion($descripcion){
      return strlen($descripcion) <= 1255 && strlen($descripcion) >= 25;
    }

    private function validarCiudad($ciudad_id){
      $expReg = '/^[0-9]+$/';
      if(!preg_match($expReg,$ciudad_id)) die(json_encode(["error"=>"Ocurrió un error al recibir la ciudad, se esperaba un entero, refresca la página e intentalo más tarde."]));

      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tciudades WHERE id_ciudad = ?");
        $new->bindValue(1, $ciudad_id);
        $new->execute();
        $ciudad = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return isset($ciudad);

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }

    }

    private function validarEstado($estado_id){
      $expReg = '/^[0-9]+$/';
      if(!preg_match($expReg,$estado_id)) die(json_encode(["error"=>"Ocurrió un error al recibir el estado, se esperaba un entero, refresca la página e intentalo más tarde."]));

      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM testados WHERE id_estado = ?");
        $new->bindValue(1, $estado_id);
        $new->execute();
        $estado = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return isset($estado);

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
      
    }

    private function validarTelefono($telefono){
      $expReg = '/^[0-9]{10,12}$/i';
      return preg_match($expReg,$telefono);
    }

    private function validarFechaNacimiento($fechaNacimiento){
      $fechaActual = strtotime(date("Y-m-d"));
      $dieciseisAnosAtras = $fechaActual - (16 * 365 * 24 * 60 * 60);
      $fechaRecibida = strtotime($fechaNacimiento);
      
      return ($fechaRecibida <= $dieciseisAnosAtras);
    }

    private function validarLatitud($latitud){
      $expReg = '/^-?(?:[0-8]?\d|90)(\.[0-9]{1,30})?$/';
      return preg_match($expReg,$latitud);
    }

    private function validarLongitud($longitud){
      $expReg = '/^-?(?:[1-9]?\d|1[0-7]\d|180)(\.[0-9]{1,30})?$/';
      return preg_match($expReg,$longitud);
    }

    private function validarDia($dia){
      $expReg = '/^[1-7]$/';
      return preg_match($expReg,$dia);
    }

    private function validarHoras($horaInicio, $horaFin){
      $expReg = '/^([01]?[0-9]|2[0-3]):[0-5][0-9]$|^24:00$/';
      if(!preg_match($expReg,$horaInicio)) die(json_encode(["error"=>"La hora de inicio no es una hora con un formato válido"]));
      if(!preg_match($expReg,$horaFin)) die(json_encode(["error"=>"La hora de fin no es una hora con un formato válido"]));

      // Devolviendo si la hora de inicio es mayor que la hora de finalizacion
      $horaInicioTime = strtotime($horaInicio); 
      $horaFinTime    = strtotime($horaFin);

      return ($horaFinTime > $horaInicioTime);
    }
  }

?>