<?php

	use componentes\initComponents as initComponents;
	use modelo\perfil as perfil;

	$model = new perfil();
  if (isset($_POST['prueba'])) {
    $model->funcionPrueba();
  }

	$components = new initComponents();	
	require "vistas/perfilVista.php";	

?>