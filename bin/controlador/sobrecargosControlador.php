<?php

	use componentes\initComponents as initComponents;
	use modelo\sobrecargos as sobrecargos;

	
	$model = new sobrecargos();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$permiso = $permisos['Sobrecargos'];
    if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
    if(isset($_POST['opcion']) && isset($permiso['Consultar']) && $_SESSION['idRol']!="CLWGS1"){
        $model->getSobrecargos();
    }
	if(isset($_POST['insert']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Crear'])){
		$model->getInsert($_POST['number'],$_POST['Descripcion']);
		$model->getSobrecargos();
	}
	if(isset($_POST['update']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Modificar'])){
		$model->getUpdate($_POST['idSobrecargo'],$_POST['number'],$_POST['Descripcion']);
		$model->getSobrecargos();
	}
	if(isset($_POST['delete']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Eliminar'])){
		$model->getDelete($_POST['id'],$_POST['habilitado']);
		$model->getSobrecargos();
	}

	$components = new initComponents($permisos);
	if($_SESSION['idRol']=="SAWGS1" && isset($permiso['Consultar'])){
		require "vistas/sobrecargosVista.php";
	}else{
		die('<script> window.location = "/" </script>');
	}
?>