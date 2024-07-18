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
	if(isset($_POST['opcion']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Consultar'])){
		$model->getTableData($_POST['opcion']);
	}
	if(isset($_POST['update']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Modificar'])){
		$model->getUpdate($_POST['Rol'],$_POST['Modulo'],$_POST['Permiso'],$_POST['habilitado']);
		$model->getTableData($_POST['Rol']);
	}
	if(isset($_POST['solicitarModulo'])){
		$model->getModulos();
	}
	if(	isset($_POST['insert'])	&&	isset($permiso['Crear']) && $_SESSION['idRol']=="SAWGS1"){
		$model->getInsert($_POST['Rol'],$_POST['modulo'],$_POST['permisos']);
		$model->getTableData($_POST['Rol']);
	}
	$components = new initComponents($permisos);
	if($_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar'])){	
		require "vistas/permisosVista.php";	
	}else{
		die('<script> window.location = "/" </script>');
	}
?>