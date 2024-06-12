<?php

	use componentes\initComponents as initComponents;
	use modelo\servicios as servicio;

	$model = new servicio();
	$permisos = $model->getPermisosRol($_SESSION['idRol'] ?? "");
	$permiso = $permisos['Servicios'];
	
	if(isset($_POST['getAllServicios'])){
		$model->getAllServicios();
	}

	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}
	if(isset($_POST['getPermisos']) && isset($permiso['Consultar'])){
		die(json_encode($permiso));
	}
  if (isset($_POST['prueba'])) {
    $model->funcionPrueba();
  }

  if(isset($_POST['solicitarQuimico'])){
	$model->SelectQuimicos();
  }
  if(isset($_POST['opcion'])){
	$model-> getAll();
  }
  if(isset($_POST['insert'])){
	$model->getInsert($_POST['nombre'],$_POST['quimico'],$_POST['descripcion'],$_FILES['foto']);
	$model-> getAll();
  }
	if(isset($_POST['update1'])){
		$model->getUpdate($_POST['idServicio'],$_POST['nombre'],$_POST['quimico'],$_POST['descripcion'],
		$_POST['fotoOriginal'],$opcion=1);
		$model->getAll();
	}
	if(isset($_POST['update2'])){
		$model->getUpdate($_POST['idServicio'],$_POST['nombre'],$_POST['quimico'],$_POST['descripcion'],
		$_FILES['foto'],$opcion=2);
		$model->getAll();
	} 
	
   
  if(isset($_POST['delete'])){
	$model->getDelete($_POST['id'],$_POST['habilitado']);
	$model-> getAll();
  }
/* if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$datos = $model->SelectQuimicos();
	header('Content-Type: application/json');
    echo json_encode($datos);
} */
	$components = new initComponents($permisos);	
	require "vistas/serviciosVista.php";	

?>