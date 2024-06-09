<?php

	use componentes\initComponents as initComponents;
	use modelo\servicios as servicio;

	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	
	$model = new servicio();
	$permisos = $model->getPermisosRol($_SESSION['idRol']);
	$permiso = $permisos['Servicios'];
	
	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}

  if (isset($_POST['prueba'])) {
    $model->funcionPrueba();
  }

  if(isset($_POST['solicitarQuimico'])){
	$model->SelectQuimicos();
  }
/* if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$datos = $model->SelectQuimicos();
	header('Content-Type: application/json');
    echo json_encode($datos);
} */
	$components = new initComponents();	
	require "vistas/serviciosVista.php";	

?>