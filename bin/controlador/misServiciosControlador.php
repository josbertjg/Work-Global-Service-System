<?php

	use componentes\initComponents as initComponents;
	use modelo\misServicios as misServicios;

	$model = new misServicios();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
  $permiso = $permisos['Mis Servicios'];
  if(empty($_SESSION['idRol']) || empty($permiso["Consultar"])) {
		die('<script> window.location = "/" </script>');
	}
  
  if(isset($_POST["getAllServicios"]) && isset($permiso["Consultar"])) {
		$model->getAllServicios();
	}

  if(isset($_POST["getAllServiciosFumigador"]) && isset($permiso["Consultar"])) {
		$model->getAllServiciosFumigador();
	}

  if(isset($_POST["deleteFumigadorService"]) && isset($permiso["Eliminar"])) {
		$model->deleteFumigadorService($_POST["idServicio"]);
	}

  if(isset($_POST["createFumigadorService"]) && isset($permiso["Crear"])) {
		$model->createFumigadorService($_POST["idServicio"]);
	}

	$components = new initComponents($permisos);	
	require "vistas/configuracion/misServiciosVista.php";	
?>