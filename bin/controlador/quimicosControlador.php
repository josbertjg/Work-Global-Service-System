<?php
	use componentes\initComponents as initComponents;
	use modelo\quimicos as quimicos;
 	$model = new quimicos();
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
   }
 
//$model->CRUD($_POST['opcion'],$_POST['idQuimico'],$_POST['Descripcion'],$_FILES['rutaIcono'],$_POST['nombreQuimico']);
	

	$components = new initComponents();	
	require "vistas/quimicosVista.php";	
?>