<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class configuracion extends DBConnect{

    public function __construct(){
    	parent::__construct();
    } 
    public function prueba()
    {
        $respuesta = ["error" => "Datos Incorrectos."];
        die(json_encode($respuesta));
    }
    public function funcionPrueba(){
      $this->getPermisosRol();
    }

  }

?>