<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class perfil extends DBConnect{

    public function __construct(){
    	parent::__construct();
    } 

    public function funcionPrueba(){
      $respuesta = array(
        "nombre" => "Juan Pérez",
        "correo" => "juan.perez@correo.com",
        "edad" => 30
      );

      $error = array(
        "error" => "esta es la respuesta personalizada cuanto ocurre un 'error' desde el modelo",
      );

      if(json_decode($_POST['prueba'])) 
        die(json_encode($respuesta));
      else 
        die(json_encode($error));
    }

  }

?>