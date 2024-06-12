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

?>