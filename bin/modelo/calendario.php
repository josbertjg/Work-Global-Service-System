<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class calendario extends DBConnect{

    private $cedula;
    private $id_calendario;
    private $diaInicio;
    private $diaFin;
    private $horaInicio;
    private $horaFin;
    private $diasRecurrentes;
    private $diasEspecificos;


    public function __construct(){
    	parent::__construct();
    } 

    public function getUserCalendar(){

      if(empty($_SESSION["clientID"])) die(json_encode(["error"=>"Ocurrió un error al recuperar la cedula del fumigador o el usuario no esta logueado."]));

      $this->cedula = $_SESSION["clientID"];
      $this->returnUserCalendar();
    }

    private function returnUserCalendar(){
      $calendario  = $this->getCalendar();
      $excepciones = $this->getExcepciones($calendario->id);

      die(json_encode(["calendario"=>$calendario,"excepciones"=>$excepciones]));
    }

    private function getCalendar(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tcalendarios WHERE cedula = ?");
        $new->bindValue(1, $this->cedula);
        $new->execute();
        $calendario = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        if(empty($calendario)) die(json_encode(["error"=>"Ocurrió un error al recuperar el calendario del fumigador, calendario no existente."]));
        else return $calendario;

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    private function getExcepciones($id_calendario){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM texcepciones WHERE id_calendario = ? AND orden = '0'");
        $new->bindValue(1, $id_calendario);
        $new->execute();
        $excepciones = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return $excepciones;

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function updateCalendario($diaInicio, $diaFin, $horaInicio, $horaFin, $diasRecurrentes, $diasEspecificos){

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

      if(empty($_SESSION["clientID"])) die(json_encode(["error"=>"Ocurrió un error al recuperar la cedula del fumigador o el usuario no esta logueado."]));

      $this->cedula = $_SESSION["clientID"];
      $this->diaInicio = $diaInicio;
      $this->diaFin = $diaFin;
      $this->horaInicio = $horaInicio;
      $this->horaFin = $horaFin;
      $this->diasRecurrentes = json_decode($diasRecurrentes);
      $this->diasEspecificos = json_decode($diasEspecificos);

      $this->setUpdateCalendario();
    }

    private function setUpdateCalendario(){
      $this->id_calendario = $this->getCalendar()->id;
      $this->setDiasRecurrentes();
      $this->setDiasEspecificos();

      try{
        $this->conectarDB();
        $new = $this->con->prepare("UPDATE `tcalendarios` SET inicioHora = ?, finHora = ?, diaInicio = ?, diaFin = ? WHERE id = ?"); 
        $new->bindValue(1 , $this->horaInicio);
        $new->bindValue(2 , $this->horaFin);
        $new->bindValue(3 , $this->diaInicio);
        $new->bindValue(4 , $this->diaFin);
        $new->bindValue(5 , $this->id_calendario);
        $exito = $new->execute();
        $this->desconectarDB();

        if($exito) die(json_encode(["success"=>"Actualización realizada con éxito."]));
        else die(json_encode(["error"=>"Ocurrió un error al modificar tu calendario, inténtalo de nuevo mas tarde."]));

      }catch(exception $error){
        die(json_encode(["error"=>$error]));
      }

    }

    private function setDiasRecurrentes(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM texcepciones WHERE id_calendario = ? AND recurrente = '1' AND orden = '0'");
        $new->bindValue(1, $this->id_calendario);
        $new->execute();
        $diasRecurrentes = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        $recurrentesToDelete = [];
        $recurrentesToSave   = [];

        // Buscando los dias para guardar
        foreach($this->diasRecurrentes as $diaEnviado){
          $saveDia = true;
          foreach($diasRecurrentes as $dia){
            if($dia->dia == $diaEnviado->dia) $saveDia = false;
          }
          if($saveDia) array_push($recurrentesToSave,$diaEnviado);
        }

        // Buscando los dias para eliminar
        foreach($diasRecurrentes as $dia){
          $deleteDia = true;
          foreach($this->diasRecurrentes as $diaEnviado){
            if($dia->dia == $diaEnviado->dia) $deleteDia = false;
          }
          if($deleteDia) array_push($recurrentesToDelete,$dia);
        }

        // Eliminando los dias recurrentes no enviados
        if(!empty($recurrentesToDelete)){
          try{
            parent::conectarDB();
            foreach($recurrentesToDelete as $recurrente){
              $new = $this->con->prepare("DELETE FROM texcepciones WHERE id_calendario = ? AND dia = ? AND recurrente = '1' AND orden = '0'");
              $new->bindValue(1, $this->id_calendario);
              $new->bindValue(2, $recurrente->dia);
              $new->execute();
            }
            parent::desconectarDB();
          }catch(exection $error){
            die(json_encode(["error"=>$error]));
          }
        }

        // Guardando los dias recurrentes enviados
        if(!empty($recurrentesToSave)){
          try{
            $this->conectarDB();
            foreach($recurrentesToSave as $recurrente){
              $new = $this->con->prepare("INSERT INTO `texcepciones` (`id`,`id_calendario`,`dia`,`recurrente`,`orden`) VALUES (UUID_SHORT(),?,?,1,0)"); 
              $new->bindValue(1 , $this->id_calendario);
              $new->bindValue(2 , $recurrente->dia);
              $new->execute();
            }
            $this->desconectarDB();
          }catch(exection $error){
            die(json_encode(["error"=>$error]));
          }
        }

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    private function setDiasEspecificos(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM texcepciones WHERE id_calendario = ? AND recurrente = '0' AND orden = '0'");
        $new->bindValue(1, $this->id_calendario);
        $new->execute();
        $diasEspecificos = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        $especificosToDelete = [];
        $especificosToSave   = [];

        // Buscando los dias para guardar
        foreach($this->diasEspecificos as $diaEnviado){
          $saveDia = true;
          foreach($diasEspecificos as $dia){
            if($dia->fecha == $diaEnviado->fecha) $saveDia = false;
          }
          if($saveDia) array_push($especificosToSave,$diaEnviado);
        }

        // Buscando los dias para eliminar
        foreach($diasEspecificos as $dia){
          $deleteDia = true;
          foreach($this->diasEspecificos as $diaEnviado){
            if($dia->fecha == $diaEnviado->fecha) $deleteDia = false;
          }
          if($deleteDia) array_push($especificosToDelete,$dia);
        }

        // Eliminando los dias especificos no enviados
        if(!empty($especificosToDelete)){
          try{
            parent::conectarDB();
            foreach($especificosToDelete as $especifico){
              $new = $this->con->prepare("DELETE FROM texcepciones WHERE id_calendario = ? AND fecha = ? AND recurrente = '0' ");
              $new->bindValue(1, $this->id_calendario);
              $new->bindValue(2, $especifico->fecha);
              $new->execute();
            }
            parent::desconectarDB();
          }catch(exection $error){
            die(json_encode(["error"=>$error]));
          }
        }

        // Guardando los dias especificos enviados
        if(!empty($especificosToSave)){
          try{
            $this->conectarDB();
            foreach($especificosToSave as $especifico){
              $new = $this->con->prepare("INSERT INTO `texcepciones` (`id`,`id_calendario`,`fecha`,`recurrente`,`orden`) VALUES (UUID_SHORT(),?,?,0,0)"); 
              $new->bindValue(1 , $this->id_calendario);
              $new->bindValue(2 , $especifico->fecha);
              $new->execute();
            }
            $this->desconectarDB();
          }catch(exection $error){
            die(json_encode(["error"=>$error]));
          }
        }

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    // Validaciones
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