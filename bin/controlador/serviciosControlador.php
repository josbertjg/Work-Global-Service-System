<?php

	use componentes\initComponents as initComponents;
	use modelo\inicio as inicio;

	$model = new inicio();
  if (isset($_POST['prueba'])) {
    $model->funcionPrueba();
  }

	$components = new initComponents();	
	require "vistas/servicios.php";	

?>