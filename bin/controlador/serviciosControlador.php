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
  if(isset($_POST['opcion'])){
	$model-> SelectAll();
  }
  if(isset($_POST['insert'])){
	$model->insert($_POST['nombre'],$_POST['quimico'],$_POST['descripcion']);
	$model-> SelectAll();
  }
  if(isset($_POST['update'])){
	$model->update($_POST['idServicio'],$_POST['nombre'],$_POST['quimico'],$_POST['descripcion']);
	$model-> SelectAll();
  }
  if(isset($_POST['delete'])){
	$model->delete($_POST['idServicio'],$_POST['habilitado']);
	$model-> SelectAll();
  }
/* if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$datos = $model->SelectQuimicos();
	header('Content-Type: application/json');
    echo json_encode($datos);
} */
	$components = new initComponents();	
	require "vistas/serviciosVista.php";	

?>