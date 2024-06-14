<?php

	use componentes\initComponents as initComponents;
	use modelo\fumigadores as fumigadores;

	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}

	$model = new fumigadores();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");

	if (isset($_POST['getFumigadoresByServices']) && isset($_POST['servicios'])) {
    $model->getFumigadoresByServicios($_POST['servicios']);
  }

	$components = new initComponents($permisos);	
	require "vistas/fumigadoresVista.php";	

?>