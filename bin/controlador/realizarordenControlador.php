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

	if(isset($_POST["getAllServicios"]) && !empty($permiso['Consultar'])){
		$model->getAllServicios();
	}

	if(isset($_POST["getAllEstablecimientos"]) && !empty($permiso['Consultar'])){
		$model->getAllEstablecimientos();
	}

	if(isset($_POST["getAllPreciosServicios"]) && !empty($permiso['Consultar'])){
		$model->getAllPreciosServicios();
	}

	
	if(isset($_POST["createOrden"])    && 
		isset($_POST['fumigador'])       && 
		isset($_POST['clienteID'])       && 
		isset($_POST['clienteEmail'])    && 
		isset($_POST['fechaServicio'])   && 
		isset($_POST['ubicacion'])       && 
		isset($_POST['establecimiento']) && 
		isset($_POST['servicios'])       && 
		isset($permiso['Crear'])){
			$model->createOrden($_POST['fumigador'],$_POST['clienteID'],$_POST['clienteEmail'],$_POST['fechaServicio'],$_POST['ubicacion'],$_POST['establecimiento'],$_POST['servicios']);
	}
	
	
	$components = new initComponents($permisos);	
	require "vistas/realizarordenVista.php";	

?>