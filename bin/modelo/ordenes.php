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
    private $EstadoOden;
    private $precio;
    private $descripcion;

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

      }catch(exection $error){
        die(json_encode(["error" => $error]));
      }

      $calendario  = $this->getCalendar();
      $excepciones = $this->getExcepciones($calendario->id);

      $disponibilidad = ["calendario"=>$calendario,"excepciones"=>$excepciones];

      $fumigador->disponibilidad = $disponibilidad;

      die(json_encode($fumigador));
    }

    private function getCalendar(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tcalendarios WHERE cedula = ?");
        $new->bindValue(1, $this->fumigadorID);
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
        $new = $this->con->prepare("SELECT * FROM texcepciones WHERE id_calendario = ?");
        $new->bindValue(1, $id_calendario);
        $new->execute();
        $excepciones = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return $excepciones;

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
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
    public function updateOrdenFumi($actualizacion,$orden,$fechaServicio,$fumigadorID){
      $validarIDC=array($orden);
      $validador=$this->validarSTA($validarIDC,7);
      if(isset($validador['error'])){die(json_encode($respuesta=["error"=>"ID de la orden no Valida."]));}
      if($actualizacion=="agendar"){$this->EstadoOrden="Agendada";}
      if($actualizacion=="cancelar"){$this->EstadoOrden="Cancelada";}
      if($actualizacion=="finalizar"){$this->EstadoOrden="Finalizada";}
      $this->idOrden=$orden;
      $this->fechaServicio = $fechaServicio;
      $this->fumigadorID = $fumigadorID;
      $this->updateOrdenF();
    }
    private function updateOrdenF(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("UPDATE tordenes SET tordenes.status=:estado where idOrdenes =:id");
        $new->bindParam(":estado",$this->EstadoOrden);
        $new->bindParam(":id",$this->idOrden);
        $new->execute();
        parent::desconectarDB();
      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
      
      if($this->EstadoOrden == "Cancelada" || $this->EstadoOden == "Finalizada"){
        $calendario = null;

        try{
          parent::conectarDB();
          $new = $this->con->prepare("SELECT * FROM tcalendarios WHERE cedula = ?");
          $new->bindValue(1, $this->fumigadorID);
          $new->execute();
          $calendario = $new->fetch(\PDO::FETCH_OBJ);
          parent::desconectarDB();
        }catch(exection $error){
          die(json_encode(["error"=>$error]));
        }

        try{
          parent::conectarDB();
          $new = $this->con->prepare("DELETE FROM texcepciones WHERE id_calendario = ? AND fecha = ? AND orden = '1'");
          $new->bindValue(1, $calendario->id);
          $new->bindValue(2, $this->fechaServicio);
          $new->execute();
          parent::desconectarDB();
        }catch(exection $error){
          die(json_encode(["error"=>$error]));
        }
      }
      die(json_encode(["success"=>"Orden Actualizada."]));
    }
    public function getOrdenesFumi($cedula){
      $fumigadorIdIsValid = $this->validarFumigadorID($cedula);
      if(!$fumigadorIdIsValid) die(json_encode(["error"=>"El id recibido no es un id de fumigador válido"]));
      $this->clienteID=$cedula;
      $this->returnOrdenesFumi();
    }

    public function getDireccion($orden){
      $validarIDC=array($orden);
      $validador=$this->validarSTA($validarIDC,7);
      if(isset($validador['error'])){die(json_encode($respuesta=["error"=>"ID de la orden no Valida."]));}
      $this->idOrden=$orden;
      $this->DirrecionDetail();
    }

    private function DirrecionDetail(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("SELECT u.* 
        FROM tubicaciones u 
        INNER JOIN tordenes o ON o.ubicacion=u.idUbicacion 
        WHERE o.idOrdenes=:idOrden;");
        $new->bindParam(":idOrden",$this->idOrden);
        $new->execute();
        $result = $new->fetchAll(PDO::FETCH_ASSOC);
        parent::desconectarDB();
        die(json_encode($result));
        }catch(exection $error){
          die(json_encode(["error"=>$error]));
          }

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

    public function createOrden($fumigador,$clienteID,$clienteEmail,$fechaServicio,$direccion,$ciudad,$latitud,$longitud,$detalles_direccion,$establecimiento,$servicios){
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

      $direccionIsValid = $this->validarDireccion($direccion);
      if(!$direccionIsValid) {
        $error = array("error" => "La direccion debe tener entre 5 y 1255 caracteres.");
        die(json_encode($error));
      }

      $ciudadIsValid = $this->validarCiudad($ciudad);
      if(!$ciudadIsValid) {
        $error = array("error" => "La ciudad recibida es inválida o no existe, intentalo de nuevo.");
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
    
      $this->fumigadorID = $fumigador;

      $this->validarFechaServicio($fechaServicio);

      if(!empty($detalles_direccion)){
        $detallesIsValid = $this->validarDetallesDireccion($detalles_direccion);
        if(!$detallesIsValid) {
          $error = array("error" => "El detalle adicional de la direccion debe tener una longitud menor o igual a 255 caracteres.");
          die(json_encode($error));
        }
      }
      
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

        $this->insertDiaNoLaborable();

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

    private function insertDiaNoLaborable(){
      $id_calendario = $this->getCalendar()->id;

      try{
        $this->conectarDB();
        $new = $this->con->prepare("INSERT INTO `texcepciones` (`id`,`id_calendario`,`fecha`,`recurrente`,`orden`) VALUES (UUID_SHORT(),?,?,0,1)"); 
        $new->bindValue(1 , $id_calendario);
        $new->bindValue(2 , $this->fechaServicio);
        $new->execute();
        $this->desconectarDB();
      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function addSobrecargo($precio,$descripcion,$idOrden){

      $precioIsValid = $this->validarPrecio($precio);
      if(empty($precioIsValid)) die(json_encode(["error"=>"El precio debe contener solo numeros y una longitud maxima de 3 caracteres."]));

      $descripcionIsValid = $this->validarDescripcion($descripcion);
      if(!$descripcionIsValid) die(json_encode(["error"=>"La descripcion debe tener entre 15 y 1255 caracteres de longitud."]));

      $ordenExist = $this->findOrden($idOrden);
      if(empty($ordenExist)) die(json_encode(["error"=>"La orden que intentas modificar no existe, intentalo de nuevo."]));

      $this->precio = $precio;
      $this->descripcion = $descripcion;
      $this->idOrden = $idOrden;

      $this->insertNewSobrecargo();
    }

    private function insertNewSobrecargo(){
      $factura = $this->findFactura($this->idOrden);
      if(empty($factura)) die(json_encode(["error"=>"Esta orden no tiene ninguna factura disponible, intentalo de nuevo mas tarde."]));

      $id_sobrecargo = parent::uniqueID();

      // Ingresando el sobrecargo
      try{
        parent::conectarDB();
        $new = $this->con->prepare("INSERT INTO `tsobrecargos`(`idSobrecargo`, `precio`, `descripcion`) VALUES (?,?,?)"); 
        $new->bindValue(1 , $id_sobrecargo);
        $new->bindValue(2 , $this->precio);
        $new->bindValue(3 , $this->descripcion);
        $new->execute(); 
        parent::desconectarDB();
      }catch(exection $error){
        $resultado = ['error' => "Error al registrar el nuevo sobrecargo, intentalo de nuevo. ".$error];
        die($resultado);
      }

      // Ingresando la facturasobrecargo
      try{
        parent::conectarDB();
        $new = $this->con->prepare("INSERT INTO `tfacturasobrecargos`(`factura`, `sobrecargo`) VALUES (?,?)"); 
        $new->bindValue(1 , $factura->idFactura);
        $new->bindValue(2 , $id_sobrecargo);
        $new->execute(); 
        parent::desconectarDB();
      }catch(exection $error){
        $resultado = ['error' => "Error al relacionar el sobrecargo con la factura, intentalo de nuevo. ".$error];
        die($resultado);
      }

      // Modificando la factura con el nuevo sobrecargo añadido
      try{
        $this->conectarDB();
        $new = $this->con->prepare("UPDATE `tfacturas` SET Sobrecargo = ?, precioFinal = ? WHERE idFactura = ?"); 
        $new->bindValue(1 , floatval($factura->Sobrecargo) + floatval($this->precio));
        $new->bindValue(2 , floatval($factura->precioFinal) + floatval($this->precio));
        $new->bindValue(3 , $factura->idFactura);
        $exito = $new->execute();
        $this->desconectarDB();

        if($exito) die(json_encode(["success"=>"Sobrecargo añadido con éxito."]));
        else die(json_encode(["error"=>"Ocurrió un error al ingresar el sobrecargo en la nota de entrega de la orden, inténtalo de nuevo mas tarde."]));

      }catch(exception $error){
        die(json_encode(["error"=>$error]));
      }

    }

    private function validarPrecio($precio){
      $expReg = '/^[0-9]{1,3}$/';
      return preg_match($expReg,$precio);
    }

    private function validarDescripcion($descripcion){
      return strlen($descripcion) <= 1255 && strlen($descripcion) >= 15;
    }

    private function findOrden($idOrden){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tordenes WHERE idOrdenes = ?");
        $new->bindValue(1, $idOrden);
        $new->execute();
        $orden = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return $orden;

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    private function findFactura($idOrden){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tfacturas WHERE orden = ?");
        $new->bindValue(1, $idOrden);
        $new->execute();
        $factura = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return $factura;

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    public function getFacturaInfo($idOrden){
      $this->idOrden = $idOrden;
      $this->returnFacturaInfo();
    }

    private function returnFacturaInfo(){
      $factura = $this->findFactura($this->idOrden);
      if(empty($factura)) die(json_encode(["error"=>"La nota de entrega de esta orden no existe."]));

      $sobrecargos = $this->returnFacturaSobrecargos($factura->idFactura);

      $facturaInfo = ["factura"=>$factura, "sobrecargos" => $sobrecargos];

      die(json_encode($facturaInfo));
    }

    private function returnFacturaSobrecargos($idFactura){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT s.*
        FROM tfacturas AS f
        JOIN tfacturasobrecargos AS fs ON f.idFactura = fs.factura
        JOIN tsobrecargos AS s ON fs.sobrecargo = s.idSobrecargo
        WHERE f.idFactura = ?");
        $new->bindValue(1, $idFactura);
        $new->execute();
        $sobrecargos = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return $sobrecargos;

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
    }

    private function validarFechaServicio($fechaServicio){
      $calendario = $this->getCalendar();
      
      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM texcepciones WHERE id_calendario = ? AND fecha = ?");
        $new->bindValue(1, $calendario->id);
        $new->bindValue(2, $fechaServicio);
        $new->execute();
        $fechaEncontrada = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        if(!empty($fechaEncontrada)) die(json_encode(["error"=>"El fumigador ya tiene una cita asignada para este día"]));

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }

      // Obtener el timestamp de la fecha
      $fechaTimestamp = strtotime($fechaServicio);
      // Obtener el día de la semana como número (0 = domingo, 6 = sábado)
      $diaNumero = date('w', $fechaTimestamp);

      try{
				parent::conectarDB();
        $new = $this->con->prepare("SELECT dia FROM texcepciones WHERE id_calendario = ? AND recurrente = '1'");
        $new->bindValue(1, $calendario->id);
        $new->execute();
        $diasRecurrentes = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        
        if(($diaNumero < $calendario->diaInicio) || ($diaNumero > $calendario->diaFin)) die(json_encode(["error"=>"Esta fecha se sale del rango laboral seleccionado por el fumigador ".$diaNumero]));
        if(in_array($diaNumero, $diasRecurrentes)) die(json_encode(["error"=>"El fumigador a seleccionado esta fecha como no laborable."]));

      }catch(exection $error){
        die(json_encode(["error"=>$error]));
      }
      
    }

    private function validarDireccion($direccion){
      return strlen($direccion) <= 1255 && strlen($direccion) >= 5;
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

    private function validarLatitud($latitud){
      $expReg = '/^-?(?:[0-8]?\d|90)(\.[0-9]{1,30})?$/';
      return preg_match($expReg,$latitud);
    }

    private function validarLongitud($longitud){
      $expReg = '/^-?(?:[1-9]?\d|1[0-7]\d|180)(\.[0-9]{1,30})?$/';
      return preg_match($expReg,$longitud);
    }

    private function validarDetallesDireccion($detalles_direccion){
      return strlen($detalles_direccion) <= 255;
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
      7=>"/^\d{8}-[1-9]\d*$/",//valida la orden
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