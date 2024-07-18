<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class perfil extends DBConnect{

    public function __construct(){
    	parent::__construct();
    } 
  }

?>