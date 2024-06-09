<?php

	use componentes\initComponents as initComponents;
	use modelo\inicio as inicio;

	$model = new inicio();
	$components = new initComponents();	
	require "vistas/inicio/inicioVista.php";	

?>