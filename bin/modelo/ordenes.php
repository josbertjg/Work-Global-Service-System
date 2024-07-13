<?php 

  namespace modelo;
  use config\connect\DBConnect as DBConnect;
  use \PDO;
  use DateTime;
  class ordenes extends DBConnect{
    private $fumigadorID;
    private $clienteID;
    private $fechaServicio;
    private $direccion;
    private $ciudad_id;
    private $latitud;
    private $longitud;
    private $detalles_direccion;
    private $establecimientoID;
    private $serviciosArr;
    private $clienteEmail;
    private $idOrden;

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

    public function getOrdenesFumi($cedula){
      $this->clienteID=$cedula;
      $this->returnOrdenesFumi();
    }

    private function returnOrdenesFumi(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("SELECT * from tordenes where fumigador =:fumi");
        $new->bindParam(":fumi",$this->clienteID);
        $new->execute();
        $data=$new->fetchAll(PDO::FETCH_ASSOC);
        parent::desconectarDB();
        die(json_encode($data));
        }catch(\PDOException $e){
          eader('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
      }
    }

    public function getOrdenesClient($clienteID){
      $this->clienteID=$clienteID;
      $this->returnAllOrdenesClient();
    }

    private function returnAllOrdenesClient(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("SELECT * from tordenes where cliente=:id");
        $new->bindParam(":id",$this->clienteID);
        $new->execute();
        $data = $new->fetchAll(PDO::FETCH_ASSOC);
        parent::desconectarDB();
        die(json_encode($data));
      }catch (\PDOException $e) {       
        header('Content-Type: application/json');
        die(json_encode(array("error" => $e->getMessage())));
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

    public function createOrden($fumigador,$clienteID,$clienteEmail,$fechaServicio,$direccion,$ciudad,$latitud,$longitud,$detalles_direccion,$establecimiento,$servicios){
      $this->fumigadorID = $fumigador;
      $this->clienteID = $clienteID;
      $this->clienteEmail = $clienteEmail;
      $this->fechaServicio = $fechaServicio;
      $this->direccion = $direccion;
      $this->ciudad_id = $ciudad;
      $this->latitud = $latitud;
      $this->longitud = $longitud;
      $this->detalles_direccion = $detalles_direccion;
      $this->establecimientoID = $establecimiento;
      $this->serviciosArr = json_decode($servicios);
      $this->idOrden=$this->generarId($fechaServicio);
      $this->insertNewOrden();
    }

    private function insertNewOrden(){
      $id_ubicacion = $this->setNewUbicacion();

      try{
        $this->conectarDB();
        $new = $this->con->prepare("
        INSERT INTO `tordenes`
        (`idOrdenes`,`fechaServicio`,`cliente`,`fumigador`,`ubicacion`, `establecimiento`,`detalles`,`status`)
         VALUES (?,?,?,?,?,?,?,?)"); 
        $new->bindValue(1 , $this->idOrden);
        $new->bindValue(2 , $this->fechaServicio);
        $new->bindValue(3 , $this->clienteID);
        $new->bindValue(4 , $this->fumigadorID);
        $new->bindValue(5 , $id_ubicacion);
        $new->bindValue(6 , $this->establecimientoID);
        $new->bindValue(7 , $this->detalles_direccion);
        $new->bindValue(8 , "Enviada");
        $exito = $new->execute();
        $this->desconectarDB();
      }catch(exception $e){
        die(json_encode(["error"=>$e]));
      }

      $resultado = null;
      if($exito){
        $resultado = ['success' => "Orden creada exitosamente."];

        try{
          parent::conectarDB();

          foreach($this->serviciosArr as $servicio){
            $new = $this->con->prepare("INSERT INTO `tordenesservicios`(`orden`, `servicio`) VALUES (?,?)"); 
            $new->bindValue(1 , $this->idOrden);
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

    private function validarFumigadorID($fumigadorID){
      $regExp = '/^(\d{5,})$/';
      return preg_match_all($regExp, $fumigadorID);
    }

    private function generarId($fechaServicio){
        $this->conectarDB();
        $consulta = "SELECT COUNT(*)
        FROM tordenes
        WHERE DATE(fechaServicio) = DATE(:fechaServicio);";
        $ejecucion = $this->con->prepare($consulta);
        $ejecucion->bindParam(':fechaServicio', $fechaServicio);
        $ejecucion->execute();
        $data = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
        $this->desconectarDB();
        $count = $data[0]['COUNT(*)'];
        $count++; // Incrementar el conteo
        //$fechaServicioObj = new DateTime($fechaServicio);
        $fechaServicioObj = DateTime::createFromFormat('Y-m-d H:i', $fechaServicio);
        $formattedDate = $fechaServicioObj->format('Ymd');
        $finalID=$formattedDate ."-".  $count;
        return $finalID;
      }

      public function getFumigadorServicio($idOrden){
        $this->idOrden=$idOrden;
        $this->FumigadorOrden($this->idOrden);
      }
      
      private function FumigadorOrden($idOrden){
        try{
          $this->conectarDB();
          $consulta = "SELECT 
          CONCAT(u.nombre,' ',u.apellido) as fumigador
          FROM workglobalservice.tordenes o
          INNER JOIN workglobalservice.tfumigadores f on o.fumigador=f.cedula
          INNER JOIN swgs.tusuarios u on f.email=u.email
          WHERE o.idOrdenes=:idOrden;";
          $ejecucion = $this->con->prepare($consulta);
          $ejecucion->bindParam(':idOrden', $idOrden);
          $ejecucion->execute();
          $data = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
          $this->desconectarDB();
          die(json_encode($data));
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      }
    public function getPrecioServicio($idOrden){
      $this->idOrden=$idOrden;
      $this->PrecioServicio($this->idOrden);
    }

    private function PrecioServicio($idOrden){
      try{
        $this->conectarDB();
        $consulta = "SELECT
        s.nombre, s.fotoServicio,
        ps.precio, ps.id, e.nombre as Establecimiento, e.icono as IconoE
        FROM tordenes o
        JOIN tordenesservicios os ON o.idOrdenes = os.orden
        JOIN tservicios s ON os.servicio = s.idServicio
        JOIN tprecioservicios ps ON s.idServicio = ps.servicio
        JOIN testablecimientos e on o.establecimiento=e.idEstablecimientos
        WHERE o.idOrdenes=:idOrden
        AND ps.establecimiento = o.establecimiento;";
        $ejecucion = $this->con->prepare($consulta);
        $ejecucion->bindParam(':idOrden', $idOrden);
        $ejecucion->execute();
        $data = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
        $this->desconectarDB();
        die(json_encode($data));
      }catch (\PDOException $e) {       
        header('Content-Type: application/json');
        die(json_encode(array("error" => $e->getMessage())));
      }
    }

    public function getOrdenesAdministrador(){
      $this->OrdenesAdministrador();
    }

    private function OrdenesAdministrador(){
      try{
        $this->conectarDB();
        $consulta = "SELECT * FROM datosordenserviciocliente";
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
  }
?>