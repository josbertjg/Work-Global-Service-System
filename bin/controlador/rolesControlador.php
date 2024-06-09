<?php

	use componentes\initComponents as initComponents;
	use modelo\roles as roles;

  
  if(empty($_SESSION['idRol'])) {
    die('<script> window.location = "/" </script>');
	}
	
  $model = new roles();
	$permisos = $model->getPermisosRol($_SESSION['idRol']);
	$permiso = $permisos['Roles'];
	
	if(empty($permiso['Consultar'])) {
		die('<script> window.location = "/" </script>');
	}

  if (isset($_POST['getModulos'])) {
    $model->getModulos();
  }

  if (isset($_POST['getRoles'])) {
    $model->getRoles();
  }

  if (isset($_POST['getRolesPermisos'])) {
    $model->getRolesPermisos($_POST['rolID']);
  }

	$components = new initComponents();	
	require "vistas/configuracion/rolesVista.php";	

?>