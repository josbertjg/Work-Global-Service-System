<?php 

  namespace componentes;
   
  class initComponents{
    
    public static function header(){

    $varHeader = '
      <!-- Page Icon -->
      <link rel="icon" href="'._URL_.'assets/img/Logo_Medi.png">

      <!-- Imported CSS Files -->
      <link href="'._URL_.'assets/css/imports/sweetalert2.min.css" rel="stylesheet">
      <link href="'._URL_.'assets/css/imports/bootstrap.min.css" rel="stylesheet">
      <link href="'._URL_.'assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

      <!-- App Main CSS File -->
      <link href="'._URL_.'assets/css/appStyles.css" rel="stylesheet">';

    echo $varHeader;

    }

    public function footer(){
    $footer = '
      <footer class="py-0 pt-5 footer">
        este es el footer
      </footer>';

      echo $footer;
  }
  
    
    public static function js(){
     $varJs = '
      <!-- Imported JS Files -->
      <script src="'._URL_.'assets/js/imports/jquery-3.7.1.min.js"></script>  
      <script src="'._URL_.'assets/js/imports/sweetalert2.all.min.js"></script>
      <script src="'._URL_.'assets/js/imports/bootstrap.bundle.min.js"></script>
      <script src="'._URL_.'assets/js/imports/echarts.min.js"></script>

      <!-- Global Custom JS Files -->
      <script>const urlBase = "'. _URL_ .'"</script>
      <script src="'._URL_.'assets/js/common/service.js"></script>
      <script src="'._URL_.'assets/js/common/validaciones.js"></script> 
      <script src="'._URL_.'assets/js/common/notificaciones.js"></script>';

      echo $varJs;

    }
  }

?>