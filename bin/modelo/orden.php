<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class orden extends DBConnect{

    public function __construct(){
    	parent::__construct();
    } 

  }

?>