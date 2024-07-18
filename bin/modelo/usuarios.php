<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class usuarios extends DBConnect{

    public function __construct(){
    	parent::__construct();
    } 
  }

?>