<?php 

  namespace componentes;
   
  class initComponents{
    
    public function head($withGoogleMaps = false){

      // Condicionando el uso del script de google
      $varGMaps = $withGoogleMaps ? 
      '<!-- Google Maps -->
      <script src="https://maps.googleapis.com/maps/api/js?&key='.GOOGLE_MAPS_API_KEY.'&libraries=places&loading=async"></script>'
      :
      "";

      $varHead = '

        <head>
          <title>Work Global Service C.A</title>
          <meta charset="utf-8">
          <meta content="width=device-width, initial-scale=1.0" name="viewport">
          <!-- Page Icon -->
          <link rel="icon" href="'._URL_.'assets/img/logo.ico">

          <!-- Imported CSS Files -->
          <link href="'._URL_.'assets/css/imports/sweetalert2.min.css" rel="stylesheet">
          <link href="'._URL_.'assets/css/imports/bootstrap.min.css" rel="stylesheet">
          <link href="'._URL_.'assets/css/imports/jquery-ui.css" rel="stylesheet">

          '.$varGMaps.'

          <!-- App Main CSS File -->
          <link href="'._URL_.'assets/css/index.css" rel="stylesheet">
        </head>';

      echo $varHead;

    }

    public function header($withGoogleMaps = false){

      $GoogleMaps = $withGoogleMaps ? '
        <div class="dropdown dropstart w-30 autocomplete-container">
          <a class="dropdown-toggle w-100" type="button" id="services-toggle" data-toggle="dropdown" >
            <div class="form-floating w-100">
              <input type="text" class="form-control" id="servicios" placeholder="Servicios">
              <label for="servicios">
                <span class="position-relative">
                  <span>Servicios</span> 
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger badge-services-count">
                    <span class="badge-count-number"></span>
                    <span class="visually-hidden">Servicios seleccionados</span>
                  </span>
                </span>
              </label>
            </div>
          </a>
          <form class="dropdown-menu services-dropdown-menu" aria-labelledby="services-toggle">
            <li><h6 class="dropdown-header">Servicios Seleccionados</h6></li>
            <li><hr class="dropdown-divider"></li>
            <div class="services-dropdown-body px-3">
              <span class="no-services">Sin servicios seleccionados</span>
            </div>
          </form>
        </div>

        <div class="dropdown w-100">
          <a class="dropdown-toggle w-100" type="button" id="map-toggle" data-toggle="dropdown" >
            <div class="form-floating w-100">
              <input type="text" class="form-control" id="searchHeaderPlaceField" placeholder="Direccion:">
              <label for="searchHeaderPlaceField">Dirección</label>
              <button type="button" href="#" class="btn-buscar">
                <span class="d-flex">
                  <i class="fa-solid fa-magnifying-glass me-lg-2 me-0"></i>
                  <span class="d-lg-block d-none">Buscar</span>
                </span>
              </button>
            </div>
          </a>
          <form class="dropdown-menu map-dropdown-menu" aria-labelledby="map-toggle">
            <div class="map-dropdown-body">
              <a href="#" class="back-map-btn map-btn">
                <i class="fa-solid fa-chevron-left"></i>
              </a>
              <a href="#" class="close-map-btn map-btn">
                <i class="fa-solid fa-x"></i>
              </a>
              <a href="#" class="user-location-btn useUserLocation map-btn">
                <i class="fa-solid fa-location-crosshairs"></i>
              </a>
              <div id="header-map" class="header-map"></div>
              <div class="aditional-options">
                <span class="aditional-title">Detalles adicionales</span>
                <div class="d-flex align-items-center my-3">
                  <i class="fa-solid fa-sheet-plastic"></i>
                  <div class="form-floating w-100">
                    <input type="text" class="form-control" id="aditional-info" placeholder="name@example.com">
                    <label for="aditional-info">Indicaciones (opcional)</label>
                  </div>
                </div>
                <div class="d-flex">
                  <a href="#" class="confirm-address">
                    Confirmar Dirección
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>
      '
      :
      '';

      $varHead = '
      <header class="app-header">
        <nav class="row header-menu mx-sm-5 mx-1 px-xl-5">
          <section class="col-lg-2 col-3 p-0 d-flex justify-content-center align-items-center">
            <a href="/">
              <img class="header-logo" src="assets\img\logo.jpg" alt="work global service">
            </a>
          </section>

          <section class="col-lg-6 col-9 p-0 d-flex align-items-center">
            '.$GoogleMaps.'  
          </section>

          <section class="col-4 d-lg-flex d-none p-0 ps-xl-5 ps-lg-4 header-actions-container">

            <div class="d-flex justify-content-center align-items-center header-buttons">
              <a 
                href="servicios" 
                class="action-btn navigation-link me-2" 
                data-bs-toggle="tooltip" 
                data-bs-placement="bottom"
                data-bs-custom-class="custom-tooltip-dark"
                data-bs-title="Servicios"
              >
                <i class="fa-solid fa-calendar"></i>
              </a>
              
              <div class="dropdown-center">
                <button 
                  class="dropdown-toggle action-btn me-4" 
                  id="alerts-toggle" 
                  type="button" 
                  data-toggle="dropdown" 
                  aria-expanded="false" 
                  data-bs-toggle="tooltip" 
                  data-bs-placement="bottom"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Alertas"
                >
                  <i class="fa-solid fa-bell"></i>
                </button>

                <ul class="dropdown-menu alerts-dropdown-menu">
                  <div class="alerts-dropdown-header dropdown-header">
                    <h1 class="alerts-title">Alertas</h1>
                    <i class="fa-solid fa-x close-alerts"></i>
                  </div>
                  <div class="alerts-dropdown-body">
                    <li class="alert-item">
                      <img src="assets/img/404.jpg" alt="404 work global service">
                      <div class="alert-item-content">
                        <div class="alert-item-title">
                          <span class="title">Tu servicio espera</span>
                          <span class="date">11/04</span>
                        </div>
                        <p class="alert-item-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius, numquam quia sed illum nostrum rem nam asperiores.</p>
                      </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="alert-item">
                      <img src="assets/img/404.jpg" alt="404 work global service">
                      <div class="alert-item-content">
                        <div class="alert-item-title">
                          <span class="title">Pago realizado</span>
                          <span class="date">09/04</span>
                        </div>
                        <p class="alert-item-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius, numquam quia sed illum nostrum rem nam asperiores.</p>
                      </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="alert-item">
                      <img src="assets/img/404.jpg" alt="404 work global service">
                      <div class="alert-item-content">
                        <div class="alert-item-title">
                          <span class="title">Pago realizado</span>
                          <span class="date">09/04</span>
                        </div>
                        <p class="alert-item-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius, numquam quia sed illum nostrum rem nam asperiores.</p>
                      </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="alert-item">
                      <img src="assets/img/404.jpg" alt="404 work global service">
                      <div class="alert-item-content">
                        <div class="alert-item-title">
                          <span class="title">Pago realizado</span>
                          <span class="date">09/04</span>
                        </div>
                        <p class="alert-item-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius, numquam quia sed illum nostrum rem nam asperiores.</p>
                      </div>
                    </li>
                  </div>
                </ul>
              </div>
            </div>

            <div class="dropdown d-flex align-items-center">
              <button class="dropdown-toggle p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex justify-content-center align-items-center header-profile-container">
                  <a class="header-profile">
                    <img class="header-avatar me-1" src="assets/img/user.png" alt="user work global service">
                    <span class="header-user-name">Josbert G.</span>
                  </a>
                </div>
              </button>
              <ul class="dropdown-menu profile-dropdown-menu">
                <li><a class="dropdown-item navigation-link" href="perfil">Perfil</a></li>
                <li><a class="dropdown-item navigation-link" href="servicios">Servicios</a></li>
                <li><a class="dropdown-item navigation-link" href="alertas">Alertas</a></li>
                <li><hr class="dropdown-divider m-0 p-0"></li>
                <li><a class="dropdown-item navigation-link" href="ayuda"><i class="fa-solid fa-circle-info me-1"></i> Ayuda</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-right-from-bracket me-1"></i> Cerrar Sesión</a></li>
              </ul>
            </div>
          </section>
        </nav>
      </header>';

      echo $varHead;
    }

    public function footer(){
      $footer = '
        <nav class="footer-tabs container-fluid d-lg-none d-flex">
          <a href="/" class="tab-item navigation-link">
            <i class="fa-solid fa-home"></i>
            <span>Home</span>
          </a>
          <a href="servicios" class="tab-item navigation-link">
            <i class="fa-solid fa-calendar"></i>
            <span>Servicios</span>
          </a>
          <a href="alertas" class="tab-item navigation-link">
            <i class="fa-solid fa-bell"></i>
            <span>Alertas</span>
          </a>
          <a href="perfil" class="tab-item navigation-link">
            <i class="fa-solid fa-user"></i>
            <span>Perfil</span>
          </a>
        </nav>
        <footer class="">
          este es el footer
        </footer>';

      echo $footer;
    }
    
    public function js(){
     $varJs = '
      <!-- Imported JS Files -->
      <script src="'._URL_.'assets/js/imports/jquery-3.7.1.min.js"></script> 
      <script src="'._URL_.'assets/js/imports/jquery-ui.js"></script> 
      <script src="'._URL_.'assets/js/imports/sweetalert2.all.min.js"></script>
      <script src="'._URL_.'assets/js/imports/bootstrap.bundle.min.js"></script>
      <script src="'._URL_.'assets/js/imports/echarts.min.js"></script>
      <script src="'._URL_.'assets/js/imports/lodash.min.js"></script>
      <script src="https://kit.fontawesome.com/c529ff0643.js" crossorigin="anonymous"></script>

      <!-- Global Custom JS Files -->
      <script>const urlBase = "'. _URL_ .'"</script>
      <script src="'._URL_.'assets/js/common/service.js"></script>
      <script src="'._URL_.'assets/js/common/validaciones.js"></script> 
      <script src="'._URL_.'assets/js/common/notificaciones.js"></script>
      <script src="'._URL_.'assets/js/common/googleMaps.js"></script>
      <script src="'._URL_.'assets/js/common/global.js"></script>
      <script src="'._URL_.'assets/js/app/header.js"></script>';

      echo $varJs;

    }
  }

?>