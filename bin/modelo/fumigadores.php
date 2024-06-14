<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class fumigadores extends DBConnect{

    private $servicios;

    public function __construct(){
    	parent::__construct();
    } 

    public function getFumigadoresByServicios($servicios){
      $this->servicios = explode(",", $servicios);
      $this->returnFumigadoresByServicios();
    }

    private function returnFumigadoresByServicios(){
      $query = "SELECT
                  DISTINCT u.email,
                  u.nombre,
                  u.apellido,
                  u.fotoPerfil,
                  f.fechaValidado,
                  f.cedula,
                  f.descripcion
                FROM tfumigadores f
                JOIN tusuarios u ON f.email = u.email
                JOIN tserviciosfumigador sf ON f.cedula = sf.cedula
                JOIN tservicios s ON s.idServicio = sf.idServicio
                WHERE f.activo = 1 AND (";

      foreach ($this->servicios as $index => $servicio) {
        if($index > 0) $query = $query." OR ";
        $query = $query." sf.idServicio = '".$servicio."' ";
      }

      $query = $query.")";

      try{
				parent::conectarDB();
        $new = $this->con->prepare($query);
        $new->execute();
        $fumigadores = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();


      }catch(exection $error){
        die(json_encode(["error" => $error]));
      }

      foreach ($fumigadores as $index => $fumigador) {
        try{
          parent::conectarDB();
          $new = $this->con->prepare("SELECT
                                        s.idServicio,
                                        s.fotoServicio,
                                        s.nombre
                                      FROM tserviciosfumigador sf
                                      JOIN tservicios s ON sf.idServicio = s.idServicio
                                      JOIN tfumigadores f ON f.cedula = sf.cedula
                                      WHERE f.cedula = '$fumigador->cedula'");
          $new->execute();
          $servicios = $new->fetchAll(\PDO::FETCH_OBJ);
          parent::desconectarDB();

          $fumigadores[$index]->servicios = $servicios;
  
        }catch(exection $error){
          die(json_encode(["error" => $error]));
        }
      }

      die(json_encode($fumigadores));
    }

  }

?>