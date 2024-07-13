<?php 

  namespace modelo;
  use config\connect\DBConnect as DBConnect;
  use \PDO;
  use DateTime;
  class ordenes extends DBConnect{
    private $fumigadorID;
    private $clienteID;
    private $fechaServicio;
    private $ubicacionID;
    private $establecimientoID;
    private $serviciosArr;
    private $clienteEmail;
    private $idOrden;

    public function __construct(){
    	parent::__construct();
    } 

    public function prueba() {
      die("Función prueba ejecutada");
      header('Content-Type: application/json'); // Establece el tipo de contenido como JSON
      die(json_encode(["error" => "Mensaje de error"]));

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
      $fumigadorIdIsValid = $this->validarFumigadorID($cedula);
      if(!$fumigadorIdIsValid) die(json_encode(["error"=>"El id recibido no es un id de fumigador válido"]));
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
      $validarIDC=array($clienteID);
      $validador=$this->validarSTA($validarIDC,1);
      if(isset($validador['error'])){die(json_encode($respuesta=["error"=>"ID del cliente No valido."]));}
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

    public function createOrden($fumigador,$clienteID,$clienteEmail,$fechaServicio,$ubicacion,$establecimiento,$servicios){
      $fumigadorIdIsValid = $this->validarFumigadorID($fumigador);
      if(!$fumigadorIdIsValid) die(json_encode(["error"=>"El id recibido no es un id de fumigador válido"]));
      $validadorClientID=array($clienteID);
      $validaor1=$this->validarSTA($validadorClientID,1);
      if (isset($validaor1['error'])){die(json_encode($respuesta=["error" => "ID del cliente Invalido."]));}
      $validadorClientEmail=array($clienteEmail);
      $validador2=$this->validarSTA($validadorClientEmail,8);
      if (isset($validador2['error'])){die(json_encode($respuesta=["error" => "Email del Cliente Invalido."]));}
      $validadorFechaServicio=array($fechaServicio);
      $validador3=$this->validarSTA($validadorFechaServicio,9);
      if (isset($validador3['error'])){die(json_encode($respuesta=["error" => "Fecha Servicio NO VALIDA."]));}
      $validadorEstablecimiento=array($establecimiento);
      $validador4=$this->validarSTA($validadorEstablecimiento,10);
      if (isset($validador4['error'])){die(json_encode($respuesta=["error" => "ID del Establecimiento Invalido."]));}
      $validadorServicios=json_decode($servicios);
      $validador5=$this->validarSTA($validadorServicios,10);
      if (isset($validador5['error'])){die(json_encode($respuesta=["error" => "ID del servicio Invalido."]));}


      $this->fumigadorID = $fumigador;
      $this->clienteID = $clienteID;
      $this->clienteEmail = $clienteEmail;
      $this->fechaServicio = $fechaServicio;
      $this->ubicacionID = $ubicacion;
      $this->establecimientoID = $establecimiento;
      $this->serviciosArr = json_decode($servicios);
      $this->idOrden=$this->generarId($fechaServicio);
      $this->insertNewOrden();
    }

    private function insertNewOrden(){
      $this->conectarDB();
      $new = $this->con->prepare("
      INSERT INTO `tordenes`
      (`idOrdenes`,`fechaServicio`,`cliente`,`fumigador`,`ubicacion`, `establecimiento`,`status`)
       VALUES (?,?,?,?,?,?,?)"); 
      $new->bindValue(1 , $this->idOrden);
      $new->bindValue(2 , $this->fechaServicio);
      $new->bindValue(3 , $this->clienteID);
      $new->bindValue(4 , $this->fumigadorID);
      $new->bindValue(5 , $this->ubicacionID);
      $new->bindValue(6 , $this->establecimientoID);
      $new->bindValue(7 , "Agendada");
      $exito = $new->execute();
      $this->desconectarDB();

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




    /**
     * Funciones para validar datos
     */

     private function validarSTA($datoArray,$diff){
      $arrayLogico = array(0 => "/^[A-Za-z]{3,45}$/",
      1 => "/^[0-9]{1,45}$/", 
      2 => "/^[0-9A-Za-z- ]{0,45}$/", 
      3 => "/^[0-9:\/-]{1,45}$/", 
      4 => "/^[0-9A-Za-z ]{0,45}$/",
      5 => "/^.{0,200}$/",
      6=> "/^[A-Za-z\s]{3,45}$/",
      7=>"/^\d{6}-[1-9]\d*$/",//valida la orden
      8=>"/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",//validar email
      9=>"/^202[4-9]-|203[0-9]-|20[1-9][0-9]-|(21[0-9][0-9]|220[0-9])-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]) (0[0-9]|1[0-9]|2[0-3]):(0[0-9]|[1-5][0-9])$/",//validar DATETIME YYYY-MM-DD HH:MM:SS
      10=>"/^[SE].*WGS$/"
    );
      foreach ($datoArray as $key) {
        $validador = preg_match_all($arrayLogico[$diff], $key);
        if($validador!=1){
          $respuesta = ["error" => "Datos Incorrectos."];
          return $respuesta;
        }
      }
      return 0;
    }
  }
?>