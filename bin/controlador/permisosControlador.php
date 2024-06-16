<?php

	use componentes\initComponents as initComponents;
	use modelo\permisos as permiso;

	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	$model = new permiso();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$permiso = $permisos['Permisos'];
	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}
	if(isset($_POST['opcion'])){
		$model->getTableData($_POST['opcion']);
	}
	if(isset($_POST['update'])){
		//$model->funcionPrueba();
		$model->getUpdate($_POST['Rol'],$_POST['Modulo'],$_POST['Permiso'],$_POST['habilitado']);
		$model->getTableData($_POST['Rol']);
	}
	$components = new initComponents($permisos);	
	require "vistas/permisosVista.php";	
?>