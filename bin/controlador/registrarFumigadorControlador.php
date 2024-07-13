<?php

	use componentes\initComponents as initComponents;
	use modelo\registrarFumigador as registrarFumigador;

	
	$model = new registrarFumigador();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");

	if(isset($_SESSION['idRol']) && $_SESSION['idRol'] != "CLWGS1") die("<script>window.location = '/'</script>");

	if (isset($_POST['getAllCiudades'])){
		$model->getAllCiudades();
	}

	if (isset($_POST['getAllEstados'])){
		$model->getAllEstados();
	}

	if (isset($_POST['validarUsuario'])){
		$model->validarUsuario();
	}
	
	if (isset($_POST['registerNewFumigador']) && 
			isset($_POST['cedula']) &&
			isset($_FILES['imgCedula']) &&
			isset($_POST['direccion']) &&
			isset($_POST['ciudad']) &&
			isset($_POST['estado']) &&
			isset($_POST['descripcion']) &&
			isset($_POST['telefono']) &&
			isset($_POST['fechaNacimiento']) &&
			isset($_POST['latitud']) &&
			isset($_POST['longitud'])
			){
			
    $model->registerNewFumigador($_POST['cedula'],
			$_FILES['imgCedula'],
			$_POST['direccion'],
			$_POST['ciudad'],
			$_POST['estado'],
			$_POST['descripcion'],
			$_POST['telefono'],
			$_POST['fechaNacimiento'],
			$_POST['latitud'],
			$_POST['longitud']);
	}


	$components = new initComponents($permisos);
	require "vistas/registrarFumigadorVista.php";

?>