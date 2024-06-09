<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class inicio extends DBConnect{

    public function __construct(){
    	parent::__construct();
    } 

    public function funcionPrueba(){
      $this->getPermisosRol();
    }

  }

?>