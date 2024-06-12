<?php

	use componentes\initComponents as initComponents;
	use modelo\servicios as servicio;

	$model = new servicio();
	$permisos = $model->getPermisosRol($_SESSION['idRol'] ?? "");
	$permiso = $permisos['Servicios'];
	
	if(isset($_POST['getAllServicios'])){
		$model->getAllServicios();
	}

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
	// $components = new initComponents($permisos);	
	require "vistas/serviciosVista.php";	

?>