<?php

	use componentes\initComponents as initComponents;
	use modelo\fumigadores as fumigadores;

	
	$model = new fumigadores();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
    if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	$permiso = $permisos['Usuarios'];
	$components = new initComponents($permisos);
	if($_SESSION['idRol']=="SAWGS1" && isset($permiso['Consultar'])){
		require "vistas/fumigadoresAdministradorVista.php";
	}else{
		die('<script> window.location = "/" </script>');
	}

?>