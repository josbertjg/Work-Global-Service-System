<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class ordenes extends DBConnect{
    private $fumigadorID;
    private $clienteID;
    private $fechaServicio;
    private $ubicacionID;
    private $establecimientoID;
    private $serviciosArr;
    private $clienteEmail;

    public function __construct(){
    	parent::__construct();
    } 

    public function getCurrentFumigador($fumigadorID){
      $fumigadorIdIsValid = $this->validarFumigadorID($fumigadorID);
      if(!$fumigadorIdIsValid) die(json_encode(["error"=>"El id recibido no es un id de fumigador válido"]));

      $this->fumigadorID = $fumigadorID;
      $this->returnCurrentFumigador();
    }

    private function returnCurrentFumigador(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT
          u.email,
          u.nombre,
          u.apellido,
          u.telefono,
          u.fotoPerfil,
          f.cedula,
          f.fechaNacimiento,
          f.fechaValidado,
          f.descripcion
        FROM workglobalservice.tfumigadores f
        JOIN swgs.tusuarios u ON u.email = f.email
        WHERE f.activo = 1 AND f.cedula = ?");
        $new->bindValue(1, $this->fumigadorID);
        $new->execute();
        $fumigador = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }

      try{
        parent::conectarDB();
        $new = $this->con->prepare("SELECT
          s.idServicio,
          s.fotoServicio,
          s.nombre,
          s.descripcion
        FROM tserviciosfumigador sf
        JOIN tservicios s ON sf.idServicio = s.idServicio
        JOIN tfumigadores f ON f.cedula = sf.cedula
        WHERE f.cedula = '$fumigador->cedula'");
        $new->execute();
        $servicios = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        $fumigador->servicios = $servicios;
        die(json_encode($fumigador));

      }catch(exection $error){
        die(json_encode(["error" => $error]));
      }
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

    public function getAllEstablecimientos(){
      $this->returnAllEstablecimientos();
    }

    private function returnAllEstablecimientos(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM testablecimientos WHERE habilitado = 1");
        $new->execute();
        $establecimientos = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($establecimientos));

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function getAllPreciosServicios(){
      $this->returnAllPreciosServicios();
    }

    private function returnAllPreciosServicios(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tprecioservicios WHERE habilitado = 1");
        $new->execute();
        $precioservicios = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($precioservicios));

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function createOrden($fumigador,$clienteID,$clienteEmail,$fechaServicio,$ubicacion,$establecimiento,$servicios){
      $this->fumigadorID = $fumigador;
      $this->clienteID = $clienteID;
      $this->clienteEmail = $clienteEmail;
      $this->fechaServicio = $fechaServicio;
      $this->ubicacionID = $ubicacion;
      $this->establecimientoID = $establecimiento;
      $this->serviciosArr = json_decode($servicios);
      $this->insertNewOrden();
    }

    private function insertNewOrden(){
      $this->conectarDB();
      $idOrden = parent::uniqueID();
      $new = $this->con->prepare("INSERT INTO `tordenes`(`fumigador`, `cliente`, `fechaServicio`, `ubicacion`, `establecimiento`, `idOrdenes`) VALUES (?,?,?,?,?,?)"); 
      $new->bindValue(1 , $this->fumigadorID);
      $new->bindValue(2 , $this->clienteID);
      $new->bindValue(3 , $this->fechaServicio);
      $new->bindValue(4 , $this->ubicacionID);
      $new->bindValue(5 , $this->establecimientoID);
      $new->bindValue(6 , $idOrden);
      $exito = $new->execute();
      $this->desconectarDB();

      $resultado = null;
      if($exito){
        $resultado = ['success' => "Orden creada exitosamente."];

        try{
          parent::conectarDB();

          foreach($this->serviciosArr as $servicio){
            $new = $this->con->prepare("INSERT INTO `tordenesservicios`(`orden`, `servicio`) VALUES (?,?)"); 
            $new->bindValue(1 , $idOrden);
            $new->bindValue(2 , $servicio);
            $exito = $new->execute();
          }
          
          parent::desconectarDB();
          
  
        }catch(exection $error){
          $resultado = ['error' => "Error al registrar los servicios de la orden, inténtalo de nuevo. ".$error];
          die($resultado);
        }
        
        $this->registrarBitacora("Realizar Orden", $this->clienteEmail, "Ha realizado una nueva orden de servicio al fumigador de cedula: ".$this->fumigadorID);
      }else{
        $resultado = ['error' => 'Ocurrió un error al registrar la nueva orden, inténtalo de nuevo mas tarde.'];
      }

      die(json_encode($resultado));
    }

    private function validarFumigadorID($fumigadorID){
      $regExp = '/^(\d{5,})$/';
      return preg_match_all($regExp, $fumigadorID);
    }
  }

?>