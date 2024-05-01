<?php

	use modelo\oauth as oauth;

	$model = new oauth();

  if (isset($_POST['gmail_oauth'])) {
    $model->gmail_oauth($_POST['credentials']);
  }

  if(isset($_POST['account_password_login'])){
    $model->account_password_login($_POST['email'],$_POST['contraseña']);
  }

  if(isset($_POST['account_password_register'])){
    $model->account_password_register($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['contraseña'],$_POST['confirmContraseña']);
  }

  if (isset($_POST['logout'])) {
    session_destroy();
    die(json_encode(array("logout" => "Sesión cerrada exitosamente!")));
  }

  die('<script>window.location = "/"</script>');

?>