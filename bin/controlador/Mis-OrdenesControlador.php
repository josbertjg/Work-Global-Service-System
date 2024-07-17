<?php

	use componentes\initComponents as initComponents;
	use modelo\ordenes as orden;

	
	$model = new orden();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$components = new initComponents($permisos);
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$permiso = $permisos['MisOrdenes'];
	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}
	if(isset($_POST['opcion']) && !empty($permiso['Consultar']) && $_SESSION['idRol']=='CLWGS1'){
		$model->getOrdenesClient($_POST['opcion']);
	}
	if(isset($_POST['opcion']) && !empty($permiso['Consultar']) && $_SESSION['idRol']=='FGWGS1'){
		$model->getOrdenesFumi($_POST['opcion']);
	}
	if(isset($_POST['getPrecioServicio']) && $_SESSION['idRol']!="SAWGS1" && !empty($permiso['Consultar'])){
		$model->getPrecioServicio($_POST['idOrden']);
	}
	if(isset($_POST['getFumigadorServicio']) && $_SESSION['idRol']!="SAWGS1" && !empty($permiso['Consultar'])){
		$model->getFumigadorServicio($_POST['idOrden']);
	}
	if(isset($_POST['getDireccion']) && isset($permiso['Consultar'])){
		$model->getDireccion($_POST['idDir']);
	}
	if(isset($_POST['updateOrdenFumi']) && isset($permiso['Modificar'])){
		$model->updateOrdenFumi($_POST['newStatus'],$_POST['idOrden']);
		$model->getOrdenesFumi($_POST['IdF']);
	}
	require "vistas/MisOrdenesVista.php";	

?>