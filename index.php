<?php  
 
  session_start();

  if(file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
  }else{
    return "Error: no se encontró el autoload.";
  }

  Use config\configSistema\configSistema as configSistema;

  $GlobalConfig = new configSistema();
  $GlobalConfig->_int();

  Use bin\controlador\frontControlador as frontControlador;

  $IndexSystem = new frontControlador($_SERVER['REQUEST_URI']);

?>