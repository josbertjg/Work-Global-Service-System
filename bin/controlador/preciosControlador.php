<?php
	use componentes\initComponents as initComponents;
	use modelo\precios as precio;
	
	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	
	$model = new precio();
	$permisos = $model->getPermisosRol($_SESSION['idRol']);
 	$permiso = $permisos['Precios'];
	
	 if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}
	if(isset($_POST['getPermisos']) && isset($permiso['Consultar'])){
		die(json_encode($permiso));
	}
    if(isset($_POST['solicitarServicio'])){
        $model->SelectServicios();
    }
    if(isset($_POST['solicitarEstablecimiento'])){
        $model->SelectEstablecimiento();
    }
    if(isset($_POST['opcion'])){
        $model->getAll();
    }
	if(isset($_POST['insert'])){
		$model->getInsert($_POST['establecimientos'],$_POST['number'],$_POST['servicios']);
		$model->getAll();
	}
	if(isset($_POST['delete'])){
		$model->getDelete($_POST['id'],$_POST['habilitado']);
		$model-> getAll();
	}
	if(isset($_POST['update'])){
		$model->getUpdate($_POST['id'],$_POST['number']);
		$model->getAll();
	}
    /*
   if (isset($_POST['prueba'])) {
     $model->funcionPrueba();
   } 

   if(isset($_POST['opcion'])){
	$model->SelectAll();
   }

   if(isset($_POST['insert'])){
	$model->insert($_POST['idQuimico'],$_POST['Descripcion'],$_FILES['foto'],$_POST['nombre']);
	$model->SelectAll();
   } 

   if(isset($_POST['update'])){
	if(isset($_POST['fotoOriginal'])){
		$model->update($_POST['idQuimico'],$_POST['Descripcion'],$_POST['fotoOriginal'],$_POST['nombre'],$opcion=1);
	}
	if(isset($_FILES['foto'])){
		$model->update($_POST['idQuimico'],$_POST['Descripcion'],$_FILES['foto'],$_POST['nombre'],$opcion=2);
	}
	$model->SelectAll();
   }

   if(isset($_POST['delete'])){
	$model->delete($_POST['idQuimico'],$_POST['habilitado']);
	$model->SelectAll();
   } */
 
//$model->CRUD($_POST['opcion'],$_POST['idQuimico'],$_POST['Descripcion'],$_FILES['rutaIcono'],$_POST['nombreQuimico']);
	

	$components = new initComponents($permisos);	
	require "vistas/preciosVista.php";	
?>