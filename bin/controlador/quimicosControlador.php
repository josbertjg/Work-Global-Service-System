<?php
	use componentes\initComponents as initComponents;
	use modelo\quimicos as quimicos;
	
	if(empty($_SESSION['idRol'])) {
		die('<script> window.location = "/" </script>');
	}
	
	$model = new quimicos();
	$permisos = $model->getPermisosRol($_SESSION['idRol']);
	$permiso = $permisos['Quimicos'];
	
	 if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	} 
	if(isset($_POST['getPermisos']) && isset($permiso['Consultar'])){
		die(json_encode($permiso));
	}

   if (isset($_POST['prueba'])) {
     $model->funcionPrueba();
   } 

   if(isset($_POST['opcion']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Consultar'])){
	$model->getAll();
   }

   if(isset($_POST['insert']) && $_SESSION['idRol']=="SAWGS1" && isset($permiso['Crear'])){
	$model->getInsert($_POST['Descripcion'],$_FILES['foto'],$_POST['nombre']);
	$model->getAll();
   } 
   if(isset($_POST['update1'])&& $_SESSION['idRol']=="SAWGS1" && isset($permiso['Modificar'])){
	$model->getUpdate($_POST['idQuimico'],$_POST['Descripcion'],$_POST['fotoOriginal'],$_POST['nombre'],$opcion=1);
	$model->getAll();
   }

   if(isset($_POST['update2'])&& $_SESSION['idRol']=="SAWGS1" && isset($permiso['Modificar'])){
	$model->getUpdate($_POST['idQuimico'],$_POST['Descripcion'],$_FILES['foto'],$_POST['nombre'],$opcion=2);
	$model->getAll();
   }

   if(isset($_POST['delete'])&& $_SESSION['idRol']=="SAWGS1" && isset($permiso['Eliminar'])){
	$model->getDelete($_POST['id'],$_POST['habilitado']);
	$model->getAll();
   }
 	
	$components = new initComponents($permisos);
	if($_SESSION['idRol']=="SAWGS1" && !empty($permiso['Consultar'])){	
		require "vistas/quimicosVista.php";
	}else{
		die('<script> window.location = "/" </script>');
	}	
?>