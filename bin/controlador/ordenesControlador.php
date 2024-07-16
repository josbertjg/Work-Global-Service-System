<?php

	use componentes\initComponents as initComponents;
	use modelo\ordenes as orden;

	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	$model = new orden();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$permiso = $permisos['Ordenes'];
	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}
	/*if(isset($_POST['getOrdenes'])){
		$model->getOrdenesAdministrador();
	}*/
	if(isset($_POST['opcion']) && $_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar'])){
		$model->getOrdenesAdministrador();
	}
	if(isset($_POST['getPrecioServicio']) && $_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar'])){
		$model->getPrecioServicio($_POST['idOrden']);
	}
	if(isset($_POST['getFumigadorServicio']) && $_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar'])){
		$model->getFumigadorServicio($_POST['idOrden']);
	}
	$components = new initComponents($permisos);
	if($_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar'])){
		require "vistas/ordenesAdministradorVista.php";
	}else{
		die('<script> window.location = "/" </script>');
	}
?>