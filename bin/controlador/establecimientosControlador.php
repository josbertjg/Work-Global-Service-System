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
        $model->getAll();
    }
	if(isset($_POST['insert']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Crear'])){
		$model->getInsert($_POST['nombre'],$_POST['number'],$_POST['descripcion'], $_FILES['foto']);
		$model-> getAll();
	  }
	  if(isset($_POST['update1']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Modificar'])){
		$model->getUpdate($_POST['idEstablecimiento'],$_POST['nombre'],$_POST['number'],$_POST['descripcion'],$_FILES['foto'],$opcion=1);
		$model-> getAll();
	  }
	  if(isset($_POST['update']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Modificar'])){
		$model->getUpdate($_POST['idEstablecimiento'],$_POST['nombre'],$_POST['number'],$_POST['descripcion'],$_POST['fotoOriginal'],$opcion=2);
		$model-> getAll();
	}
	  if(isset($_POST['delete']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Eliminar'])){
		$model->getDelete($_POST['id'],$_POST['habilitado']);
		$model-> getAll(); 
	  }
   if (isset($_POST['prueba'])) {
     $model->funcionPrueba();
   } 

	$components = new initComponents();	
	if($_SESSION['idRol']=="SAWGS1" && isset($permiso['Consultar'])){
	require "vistas/establecimientosVista.php";	
	}else{
		die('<script> window.location = "/" </script>');
	}
?>