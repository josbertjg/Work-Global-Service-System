<?php

	use componentes\initComponents as initComponents;
	use modelo\permisos as permiso;

	
	$model = new permiso();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$components = new initComponents($permisos);	
	require "vistas/permisosVista.php";	

?>