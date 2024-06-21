<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class permisos extends DBConnect{
    private $opcion;
    private $modulo;
    private $permiso;
    private $habilitado;
    private $rol;

    public function __construct(){
    	parent::__construct();
    } 

    public function funcionPrueba(){
      $mensaje=array("Hola"=>"Esta entrado a la funcion");
      json_encode($mensaje);
    }
    public function getTableData($opcion){
      $this->opcion=$opcion;
      $this->DatosTabla();
    }
    private function DatosTabla(){
      $vista="";
      if($this->opcion==1){$vista="vistapermisoscliente";}
      if($this->opcion==3){$vista="vistapermisosadministrador";} 
      if($this->opcion==2){$vista="vistapermisosfumigador";} 
      try{
        $this->conectarDBS();
        $consulta = "SELECT * FROM ".$vista;
        //error_log(print_r($vista, true));
        //error_log(print_r($consulta, true));

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
    public function getModulos(){
      $this->Modulos();
    }
    private function Modulos(){
      try{
        $this->conectarDBS();
        $consulta = "SELECT tmodulos.nombre, tmodulos.idModulo 
        FROM tmodulos WHERE tmodulos.status=1";
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
    public function getUpdate($opcion,$modulo,$permiso,$habilitado){
      $this->opcion=$opcion;
      $habilitado = $habilitado == 1 ? 0 : 1;
      $this->habilitado=$habilitado;
      $modulo =str_replace(' ', '', $modulo);
      $this->modulo="M". strtoupper ($modulo) . "WGS";
      if($permiso=="Crear"){$this->permiso="CREATEWGS";}else{
        $this->permiso=strtoupper($permiso)."WGS";
      }
      $this->habilitado=$habilitado;
      //var_dump($this->modulo, $this->habilitado, $this->permiso);
      $this->setUpdate();
    }
    public function setUpdate(){
      $vista="";
      if($this->opcion==1){$vista="vistapermisoscliente"; $this->rol="CLWGS1";}
      if($this->opcion==3){$vista="vistapermisosadministrador";$this->rol="SAWGS1";} 
      if($this->opcion==2){$vista="vistapermisosfumigador";$this->rol="FGWGS1";} 
      try{
        $this->conectarDBS();
        $consulta = "UPDATE taccesos SET taccesos.status = :habilitado 
        WHERE taccesos.modulo = :modulo AND taccesos.permiso = :permiso AND taccesos.rol = :rol";
        $ejecucion=$this->con->prepare($consulta);
        $ejecucion->bindParam(':habilitado', $this->habilitado);
        $ejecucion->bindParam(':modulo', $this->modulo);
        $ejecucion->bindParam(':permiso', $this->permiso);
        $ejecucion->bindParam(':rol', $this->rol);
        //var_dump($this->rol);
        //echo "Consulta: $consulta";
        //echo "Filas afectadas: " . $ejecucion->rowCount();
        $ejecucion->execute();
        $this->desconectarDB();
      }catch (\PDOException $e) {       
        header('Content-Type: application/json');
        die(json_encode(array("error" => $e->getMessage())));
      }
    }
    public function getInsert($opcion,$modulo,$permiso){
      $this->opcion=$opcion;
      $this->modulo=$modulo;
      $this->permiso=$permiso;
      $this->insert();
    }
    private function insert(){
      if($this->opcion==1){$this->rol="CLWGS1";}
      if($this->opcion==3){$this->rol="SAWGS1";} 
      if($this->opcion==2){$this->rol="FGWGS1";} 
      switch($this->permiso){
        case 1:
          $this->permiso="CREATEWGS";
          break;
        case 2:
          $this->permiso="CONSULTARWGS";
          break;
        case 3:
          $this->permiso="MODIFICARWGS";
          break;
        case 4:
          $this->permiso="ELIMINARWGS";
      }
      if($this->comprobarInsert($this->rol,$this->permiso,$this->modulo)){
        $respuesta = ["error" => "Este Registro ya existe."];
          die(json_encode($respuesta));
      }else{
        try{
          $this->conectarDBS();
          $consulta = "INSERT INTO taccesos (idAcceso,rol,permiso,modulo,taccesos.status) VALUES(UUID_SHORT(),
          ?,?,?,1)";
          $ejecucion=$this->con->prepare($consulta);
          $ejecucion->bindValue(1, $this->rol);
          $ejecucion->bindValue(2, $this->permiso);
          $ejecucion->bindValue(3, $this->modulo);
          //var_dump($this->rol);
          //echo "Consulta: $consulta";
          //echo "Filas afectadas: " . $ejecucion->rowCount();
          $ejecucion->execute();
          $this->desconectarDB();
        }catch (\PDOException $e) {       
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
      }
     
    }
    private function comprobarInsert($rol, $permiso,$modulo) {
      $this->conectarDBS();
      $consulta = "SELECT * FROM taccesos WHERE rol  = :rol  AND modulo  = :modulo AND permiso =:permiso";
      $ejecucion = $this->con->prepare($consulta);
      $ejecucion->bindParam(':rol', $rol);
      $ejecucion->bindParam(':modulo', $modulo);
      $ejecucion->bindParam(':permiso',$permiso);
      $ejecucion->execute();
      $data = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
      $this->desconectarDB();
      return !empty($data);
    }
  }

?>