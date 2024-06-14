<?php

	use componentes\initComponents as initComponents;
	use modelo\ordenes as ordenes;

	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	
	$model = new ordenes();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$permiso = $permisos['Realizar Orden'];

	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}

	if(isset($_POST["getCurrentFumigador"]) && isset($_POST["fumigadorID"])){
		$model->getCurrentFumigador($_POST["fumigadorID"]);
	}

	if(isset($_POST["getAllServicios"])){
		$model->getAllServicios();
	}

	if(isset($_POST["getAllEstablecimientos"])){
		$model->getAllEstablecimientos();
	}

	if(isset($_POST["getAllPreciosServicios"])){
		$model->getAllPreciosServicios();
	}
	
	
	$components = new initComponents($permisos);	
	require "vistas/realizarordenVista.php";	

?>