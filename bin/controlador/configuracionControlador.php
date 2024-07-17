<?php

	use componentes\initComponents as initComponents;
	use modelo\configuracion as configuracion;

	
	$model = new configuracion();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
    if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}

	$components = new initComponents($permisos);
	if($_SESSION['idRol']=="SAWGS1") require "vistas/configuracion/configuracionAdminVista.php";
	else if($_SESSION['idRol']=="FGWGS1") require "vistas/configuracion/configuracionFumigadorVista.php";
	else if($_SESSION['idRol']=="CLWGS1") require "vistas/configuracion/configuracionClienteVista.php";
	else die('<script> window.location = "/" </script>');
	
?>