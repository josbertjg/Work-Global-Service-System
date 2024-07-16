<?php

	use componentes\initComponents as initComponents;
	use modelo\facturas as factura;

	
	$model = new factura();
	$permisos = $model->getPermisosRol(!empty($_SESSION) ? $_SESSION['idRol'] : "");
    if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
    if(isset($_POST['opcion']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Consultar']) ){
        $model->getFacturas();
    }
	$permiso = $permisos['Facturas'];
	$components = new initComponents($permisos);	
	if($_SESSION['idRol']=="SAWGS1" && isset($permiso['Consultar'])){
		require "vistas/facturasVista.php";	
	}else{
		die('<script> window.location = "/" </script>');
	}

?>