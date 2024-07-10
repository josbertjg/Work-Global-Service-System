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
	if(isset($_POST['getOrdenesByClient']) && !empty($permiso['Consultar']) && $_SESSION['idRol']=='CLWGS1'){
		$model->getOrdenesClient($_POST['ID']);
	}
	if(isset($_POST['getOrdenesFumi']) && !empty($permiso['Consultar']) && $_SESSION['idRol']=='FGWGS1'){
		$model->getOrdenesFumi($_POST['ID']);
	}
	if(isset($_POST['getPrecioServicio']) && $_SESSION['idRol']!="SAWGS1" && !empty($permiso['Consultar'])){
		$model->getPrecioServicio($_POST['idOrden']);
	}
	require "vistas/MisOrdenesVista.php";	

?>