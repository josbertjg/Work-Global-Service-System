<?php

	use componentes\initComponents as initComponents;
	use modelo\usuarios as usuarios;
	
	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	
	$model = new usuarios();
	$permisos = $model->getPermisosRol($_SESSION['idRol']);
	$permiso = $permisos['Usuarios'];
	
	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}

	if(isset($_POST['getPermisos']) && isset($permiso['Consultar'])){
		die(json_encode($permiso));
	}
	
	$components = new initComponents($permisos);	
	require "vistas/usuariosVista.php";	

?>