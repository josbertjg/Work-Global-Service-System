<?php

	use componentes\initComponents as initComponents;
	// use component\tienda as tienda;
	// use component\footerInicio as footerInicio;
	use modelo\inicio as inicio;

	$model = new inicio();
  if (isset($_POST['prueba'])) {
    $model->funcionPrueba();
  }

	$Components = new initComponents();	
	// $tiendaComp = new tienda();
	// $footer= new footerInicio(); 
	require "vistas/inicio/inicioVista.php";	

?>