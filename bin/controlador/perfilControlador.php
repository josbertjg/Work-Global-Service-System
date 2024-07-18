<?php

	use componentes\initComponents as initComponents;
	use modelo\perfil as perfil;

	
	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	
	$model = new perfil();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");

	if (isset($_POST['prueba'])) {
    $model->funcionPrueba();
  }

	$components = new initComponents($permisos);
	require "vistas/perfilVista.php";	
	// if($_SESSION["idRol"]=="CLWGS1") require "vistas/perfilClienteVista.php";	
	// else if($_SESSION["idRol"]=="FGWGS1") require "vistas/perfilFumigadorVista.php";
	// else if($_SESSION["idRol"]=="SAWGS1") require "vistas/perfilAdministradorVista.php";
	// else die('<script> window.location = "/" </script>');
?>