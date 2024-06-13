<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class configuracion extends DBConnect{

    public function __construct(){
    	parent::__construct();
    } 

    public function funcionPrueba(){
      $this->getPermisosRol();
    }

  }

?>