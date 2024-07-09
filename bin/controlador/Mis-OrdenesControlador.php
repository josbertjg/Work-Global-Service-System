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
	if(isset($_POST['getOrdenesByClient']) && !empty($permiso['Consultar'])){
		$model->getOrdenesClient($_POST['ID']);
	}
	if(isset($_POST['getOrdenesFumi']) && !empty($permiso['Consultar'])){
		$model->getOrdenesFumi($_POST['ID']);
	}
	require "vistas/MisOrdenesVista.php";	

?>