<?php
	use componentes\initComponents as initComponents;
	use modelo\establecimientos as establecimiento;
	
	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	
	$model = new establecimiento();
	$permisos = $model->getPermisosRol($_SESSION['idRol']);
	$permiso = $permisos['Establecimientos'];
	
	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}
	if(isset($_POST['getPermisos']) && isset($permiso['Consultar'])){
		die(json_encode($permiso));
	}
    if(isset($_POST['opcion'])){
        $model->SelectAll();
    }
	if(isset($_POST['insert'])){
		$model->insert($_POST['nombre'],$_POST['number'],$_POST['descripcion']);
		$model-> SelectAll();
	  }
	  if(isset($_POST['update'])){
		$model->update($_POST['idEstablecimiento'],$_POST['nombre'],$_POST['number'],$_POST['descripcion']);
		$model-> SelectAll();
	  }
	  if(isset($_POST['delete'])){
		$model->delete($_POST['id'],$_POST['habilitado']);
		$model-> SelectAll(); 
	  }
   if (isset($_POST['prueba'])) {
     $model->funcionPrueba();
   } 

//$model->CRUD($_POST['opcion'],$_POST['idQuimico'],$_POST['Descripcion'],$_FILES['rutaIcono'],$_POST['nombreQuimico']);
	

	$components = new initComponents();	
	require "vistas/establecimientosVista.php";	
?>