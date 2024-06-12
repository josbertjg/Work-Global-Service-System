<?php

	use componentes\initComponents as initComponents;
	use modelo\inicio as inicio;

	
	$model = new inicio();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
	$components = new initComponents($permisos);	
	require "vistas/inicio/inicioVista.php";	

?>