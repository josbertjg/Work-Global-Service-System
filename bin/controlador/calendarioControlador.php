<?php

	use componentes\initComponents as initComponents;
	use modelo\calendario as calendario;
	
  if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}

	$model = new calendario();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$permiso = $permisos['Calendario'];

  if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}

  if(!empty($permiso['Consultar']) &&
    isset($_POST["getUserCalendar"])
  ){
    $model->getUserCalendar();
  }

  if(!empty($permiso['Modificar']) &&
    isset($_POST["updateCalendario"]) &&
    isset($_POST["diaInicio"]) &&
    isset($_POST["diaFin"]) &&
    isset($_POST["horaInicio"]) &&
    isset($_POST["horaFin"]) 
  ){
    $model->updateCalendario($_POST["diaInicio"], $_POST["diaFin"], $_POST["horaInicio"], $_POST["horaFin"], $_POST["diasRecurrentes"], $_POST["diasEspecificos"]);
  }

  


	$components = new initComponents($permisos);	
	require "vistas/configuracion/calendarioVista.php";	

?>