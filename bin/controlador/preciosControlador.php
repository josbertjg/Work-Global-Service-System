<?php
	use componentes\initComponents as initComponents;
	use modelo\precios as precio;
	
	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	
	$model = new precio();
	$permisos = $model->getPermisosRol($_SESSION['idRol']);
 	$permiso = $permisos['Precios'];
	
	 if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}
	if(isset($_POST['getPermisos']) && isset($permiso['Consultar'])){
		die(json_encode($permiso));
	}
    if(isset($_POST['solicitarServicio'])){
        $model->SelectServicios();
    }
    if(isset($_POST['solicitarEstablecimiento'])){
        $model->SelectEstablecimiento();
    }
    if(isset($_POST['opcion'])){
        $model->getAll();
    }
	if(isset($_POST['insert']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Crear'])){
		$model->getInsert($_POST['establecimientos'],$_POST['number'],$_POST['servicios']);
		$model->getAll();
	}
	if(isset($_POST['delete']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Eliminar'])){
		$model->getDelete($_POST['id'],$_POST['habilitado']);
		$model-> getAll();
	}
	if(isset($_POST['update']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Modificar'])){
		$model->getUpdate($_POST['id'],$_POST['number']);
		$model->getAll();
	}

	$components = new initComponents($permisos);	
	if($_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar'])){
		require "vistas/preciosVista.php";	
	}else{
		die('<script> window.location = "/" </script>');
	}
?>