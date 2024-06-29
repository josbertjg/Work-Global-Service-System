<?php

	use componentes\initComponents as initComponents;
	use modelo\ordenes as orden;

	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	$model = new orden();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$permiso = $permisos['Permisos'];
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
	$components = new initComponents($permisos);
	if($_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar'])){
		require "vistas/ordenesAdministradorVista.php";
	}
	
	//if($_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar']) && isset($_POST['opcion'])){
		//$model->getOrdenesAdministrador();
	//}
	/* if(isset($_POST['opcion'])){
		$model->getTableData($_POST['opcion']);
	}
	if(isset($_POST['update'])){
		//$model->funcionPrueba();
		$model->getUpdate($_POST['Rol'],$_POST['Modulo'],$_POST['Permiso'],$_POST['habilitado']);
		$model->getTableData($_POST['Rol']);
	}
	if(isset($_POST['solicitarModulo'])){
		$model->getModulos();
	}
	if(	isset($_POST['insert'])	&&	isset($permiso['Crear'])){
		$model->getInsert($_POST['Rol'],$_POST['modulo'],$_POST['permisos']);
		$model->getTableData($_POST['Rol']);
		//$model->funcionPrueba();
	} */		
?>