<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class facturas extends DBConnect{

    public function __construct(){
    	parent::__construct();
    } 

    public function funcionPrueba(){
      $this->getPermisosRol();
    }
    
    public function getFacturas(){
        $this->facturas();
    }

    private function facturas(){
        try{
            $consulta="SELECT f.idFactura, f.orden, f.fecha, f.precioFinal, f.precioInicial, f.Sobrecargo, 
                        f.pagado, concat(u.nombre,' ',u.apellido) as Cliente
                        FROM workglobalservice.tfacturas f
                        INNER JOIN workglobalservice.tordenes o ON
                                   f.orden = o.idOrdenes
                        INNER JOIN workglobalservice.tclientes c ON
                                   o.cliente = c.id
                        INNER JOIN swgs.tusuarios u on 
                                   c.email = u.email;";
            $this->conectarDB();
            $ejecucion=$this->con->prepare($consulta);
            $ejecucion->execute();//line 34
            $data=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
            $this->desconectarDB();
            die(json_encode($data));
        }catch(\PDOException $e){
            header('Content-Type: application/json');
            die(json_encode(array("error" => $e->getMessage())));
        }
    }
  }

?>