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
	
	$components = new initComponents();	
	require "vistas/usuariosVista.php";	

?>