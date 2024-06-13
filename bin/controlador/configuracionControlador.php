<?php

	use componentes\initComponents as initComponents;
	use modelo\configuracion as configuracion;

	
	$model = new configuracion();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
    if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	$permiso = $permisos['Configuracion'];
	$components = new initComponents($permisos);	
	require "vistas/configuracionVista.php";	

?>