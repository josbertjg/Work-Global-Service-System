<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class misServicios extends DBConnect{

    private $idServicio;

    public function __construct(){
    	parent::__construct();
    } 

    public function getAllServicios(){
      $this->returnAllServicios();
    }

    private function returnAllServicios(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tservicios WHERE habilitado = 1");
        $new->execute();
        $servicios = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($servicios));

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function getAllServiciosFumigador(){
      if(empty($_SESSION["clientID"])) die(json_encode(["error"=>"Error al recuperar al usuario logueado, porfavor inicia sesion o intentalo mas tarde."]));
      $this->returnAllServiciosFumigador();
    }

    private function returnAllServiciosFumigador(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tserviciosfumigador WHERE cedula = ?");
        $new->bindValue(1, $_SESSION["clientID"]);
        $new->execute();
        $serviciosFumigador = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($serviciosFumigador));

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function deleteFumigadorService($idServicio){
      if(empty($_SESSION["clientID"])) die(json_encode(["error"=>"Error al recuperar al usuario logueado, porfavor inicia sesion o intentalo mas tarde."]));
      $this->idServicio = $idServicio;
      $this->setDeleteFumigadorService();
    }

    private function setDeleteFumigadorService(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("DELETE FROM tserviciosfumigador WHERE idServicio = ? AND cedula = ?");
        $new->bindValue(1, $this->idServicio);
        $new->bindValue(2, $_SESSION["clientID"]);
        $exito = $new->execute();

        if($exito) die(json_encode(["success"=>"Has eliminado este servicio de tu portafolio."]));
        else die(json_encode(["error"=>"Error al intentar eliminar este servicio de tu portafolio."]));

        parent::desconectarDB();
      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function createFumigadorService($idServicio){
      if(empty($_SESSION["clientID"])) die(json_encode(["error"=>"Error al recuperar al usuario logueado, porfavor inicia sesion o intentalo mas tarde."]));
      $this->idServicio = $idServicio;
      $this->insertNewFumigadorService();
    }

    private function insertNewFumigadorService(){
      try{
        $this->conectarDB();
        $new = $this->con->prepare("INSERT INTO `tserviciosfumigador` (`idServicio`,`cedula`) VALUES (?,?)"); 
        $new->bindValue(1 , $this->idServicio);
        $new->bindValue(2 , $_SESSION["clientID"]);
        $exito = $new->execute();
        $this->desconectarDB();

        if($exito) die(json_encode(["success"=>"Has añadido este servicio a tu portafolio."]));
        else die(json_encode(["error"=>"Error al intentar añadir este servicio a tu portafolio."]));

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

  }

?>