<?php

	use componentes\initComponents as initComponents;
	use modelo\orden as orden;

	
	$model = new orden();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$components = new initComponents($permisos);	
	require "vistas/ordenVista.php";	

?>