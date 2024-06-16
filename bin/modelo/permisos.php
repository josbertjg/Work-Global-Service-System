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
        error_log(print_r($vista, true));
        error_log(print_r($consulta, true));

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

    public function getUpdate($opcion,$modulo,$permiso,$habilitado){
      $this->opcion=$opcion;
      $habilitado = $habilitado == 1 ? 0 : 1;
      $this->habilitado=$habilitado;
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

?>