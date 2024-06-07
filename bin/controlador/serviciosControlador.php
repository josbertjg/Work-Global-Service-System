<?php

	use componentes\initComponents as initComponents;
	use modelo\servicios as servicio;

	$model = new servicio();
  if (isset($_POST['prueba'])) {
    $model->funcionPrueba();
  }

  if(isset($_POST['solicitarQuimico'])){
	$model->SelectQuimicos();
  }
/* if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$datos = $model->SelectQuimicos();
	header('Content-Type: application/json');
    echo json_encode($datos);
} */
	$components = new initComponents();	
	require "vistas/serviciosVista.php";	

?>