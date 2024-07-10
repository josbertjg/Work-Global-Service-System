<?php

	use componentes\initComponents as initComponents;
	use modelo\registrarFumigador as registrarFumigador;

	
	$model = new registrarFumigador();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");

	if (isset($_POST['getAllCiudades'])){
		$model->getAllCiudades();
	}

	if (isset($_POST['getAllEstados'])){
		$model->getAllEstados();
	}
	
	if (isset($_POST['registerNewFumigador']) && isset($_POST['cedula']) &&
			isset($_POST['imgCedula']) &&
			isset($_POST['ubicacionInfo']) &&
			isset($_POST['descripcion']) &&
			isset($_POST['telefono']) &&
			isset($_POST['fechaNacimiento']) &&
			isset($_POST['userID'])
			){
    $model->registerNewFumigador($_POST['cedula'],	$_POST['imgCedula'], $_POST['ubicacionInfo'],	$_POST['descripcion'], $_POST['telefono'], $_POST['fechaNacimiento'],	$_POST['userID']);
	}


	$components = new initComponents($permisos);
	require "vistas/registrarFumigadorVista.php";

?>