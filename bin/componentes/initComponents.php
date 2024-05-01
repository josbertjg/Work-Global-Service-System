<?php 

  namespace componentes;
   
  class initComponents{
    
    public function head($withGoogleMaps = false){

      // Condicionando el uso del script de google
      $GoogleMaps = $withGoogleMaps ? 
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
          <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

          <!-- Google Libraries -->
          <script src="https://accounts.google.com/gsi/client" async defer></script>
          '.$GoogleMaps.'

          <!-- App Main CSS File -->
          <link href="'._URL_.'assets/css/index.css" rel="stylesheet">
        </head>';

      echo $varHead;

    }

    public function header($withGoogleMaps = false){

      $user = !empty($_SESSION["user"]) ? json_decode($_SESSION["user"]) : null;
      $userIsLogged = !empty($user);

      $fotoPerfil = "";
      if(empty($user)) $fotoPerfil = "assets/img/user.svg";
      else{
        if(empty($user->fotoPerfil)) $fotoPerfil = "assets/img/user.svg";
        else $fotoPerfil = $user->fotoPerfil;
      }

      $nombre = empty($user) ? "Acceder" : $user->nombre;
      $apellido = empty($user) ? "" : $user->apellido;
      $apellidoFirstLetter = $apellido ? strtoupper(substr($apellido,0,1))."." : "";

      $showActionButtons = $userIsLogged ? 'd-inline-block' : 'd-none';
      $showOfferServicesBtn = $userIsLogged ? 'd-none' : 'd-inline-block';

      $profileMenu = $userIsLogged ? 
        '
          <li><a class="dropdown-item navigation-link" href="perfil">Perfil</a></li>
          <li><a class="dropdown-item navigation-link" href="servicios">Servicios</a></li>
          <li><a class="dropdown-item navigation-link" href="alertas">Alertas</a></li>
          <li><hr class="dropdown-divider m-0 p-0"></li>
          <li><a class="dropdown-item navigation-link" href="ayuda"><i class="material-symbols-outlined me-1">help</i> Ayuda</a></li>
          <li><a class="dropdown-item logout" href="#"><i class="material-symbols-outlined me-1">logout</i> Cerrar Sesión</a></li>
        '
      :
        '
          <li>
            <a type="button" class="iniciarSesion-btn" data-bs-toggle="modal" data-bs-target="#acceder-modal">
              <i class="material-symbols-outlined me-1">login</i>
              Iniciar Sesión
            </a>
          </li>
          <li>
            <a type="button" class="crearCuenta-btn" data-bs-toggle="modal" data-bs-target="#acceder-modal">
              <i class="material-symbols-outlined me-1">how_to_reg</i>
              Crear Cuenta
            </a>
          </li>
        ';

        
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
                  <i class="material-symbols-outlined me-lg-1">search</i>
                  <span class="d-lg-block d-none">Buscar</span>
                </span>
              </button>
            </div>
          </a>
          <form class="dropdown-menu map-dropdown-menu" aria-labelledby="map-toggle">
            <div class="map-dropdown-body">
              <a href="#" class="back-map-btn map-btn">
                <i class="material-symbols-outlined">chevron_left</i>
              </a>
              <a href="#" class="close-map-btn map-btn">
                <i class="material-symbols-outlined">close</i>
              </a>
              <a href="#" class="user-location-btn useUserLocation map-btn">
                <i class="material-symbols-outlined">my_location</i>
              </a>
              <div id="header-map" class="header-map"></div>
              <div class="aditional-options">
                <span class="aditional-title">Detalles adicionales</span>
                <div class="d-flex align-items-center my-3">
                  <i class="material-symbols-outlined aditional-sheet">description</i>
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
        </div>'
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
                class="action-btn servicios-header-btn navigation-link me-2 '.$showActionButtons.'" 
                data-bs-toggle="tooltip" 
                data-bs-placement="bottom"
                data-bs-custom-class="custom-tooltip-dark"
                data-bs-title="Servicios"
              >
                <i class="material-symbols-outlined">calendar_month</i>
              </a>
              
              <div class="dropdown-center alertas-header-dropdown '.$showActionButtons.'">
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
                  <i class="material-symbols-outlined">notifications</i>
                </button>
      
                <ul class="dropdown-menu alerts-dropdown-menu">
                  <div class="alerts-dropdown-header dropdown-header">
                    <h1 class="alerts-title">Alertas</h1>
                    <i class="material-symbols-outlined close-alerts">close</i>
                  </div>
                  <div class="alerts-dropdown-body">
                    <li class="alert-item">
                      <img src="assets/custom_icons/WGS_Truck.svg" alt="404 work global service">
                      <div class="alert-item-content">
                        <div class="alert-item-title">
                          <span class="title">Tu servicio espera</span>
                          <span class="date">11/04</span>
                        </div>
                        <p class="alert-item-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius, numquam quia sed illum nostrum rem nam asperiores.</p>
                      </div>
                    </li>
                  </div>
                </ul>
              </div>
              <a href="registroFumigador" class="ofrecerServicios-header-btn '.$showOfferServicesBtn.'">Ofrecer Servicios</a>
            </div>

            <div class="dropdown d-flex align-items-center">
              <button class="dropdown-toggle p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex justify-content-center align-items-center header-profile-container">
                  <a class="header-profile">
                    <img class="header-avatar me-1" src="'.$fotoPerfil.'" alt="user work global service">
                    <span class="header-user-name">'.$nombre.' '.$apellidoFirstLetter.'</span>
                  </a>
                </div>
              </button>
              <ul class="dropdown-menu profile-dropdown-menu">
                '.$profileMenu.'
              </ul>
            </div>
          </section>
        </nav>
        </header>
        
        <!-- Modal de inicio de sesion -->
        <div class="modal fade" id="acceder-modal" tabindex="-1" aria-labelledby="acceder-modal-Label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">

                <ul class="d-none" id="acceder-tabs" role="tablist">
                  <li><button class="active" id="iniciar-sesion-tab" data-bs-toggle="pill" data-bs-target="#iniciar-sesion" aria-selected="true"></button></li>
                  <li><button id="select-user-type-tab" data-bs-toggle="pill" data-bs-target="#select-user-type" aria-selected="false"></button></li>
                  <li><button id="crear-cuenta-tab" data-bs-toggle="pill" data-bs-target="#crear-cuenta" aria-selected="false"></button></li>
                </ul>
                
                <div class="tab-content" id="acceder-tabsContent">

                  <!-- INICIAR SESION -->
                  <div class="tab-pane fade show active" id="iniciar-sesion" role="tabpanel" aria-labelledby="iniciar-sesion-tab" tabindex="0">
                    <div>
                      <span>Iniciar Sesión</span>
                      <button type="button" class="btn-close close-acceder-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="iniciarSesion-form" novalidate>
                      <div class="form-floating position-relative mb-4">
                        <input type="text" class="form-control" id="iniciarSesionUserEmail" name="email" placeholder="email@ejemplo.com" isValid="false">
                        <label for="iniciarSesionUserEmail">E-Mail:</label>
                        <div class="invalid-tooltip"></div>
                      </div>
                      <div class="form-floating position-relative mb-2">
                        <input type="password" class="form-control" id="iniciarSesionUserPassword" name="contraseña" placeholder="Password" isValid="false">
                        <label for="iniciarSesionUserPassword">Contraseña:</label>
                        <div class="invalid-tooltip"></div>
                      </div>
                      <button id="iniciarSesion-btn">
                        Iniciar Sesión
                        <i class="material-symbols-outlined">login</i>
                      </button>
                    </form>

                    <div class="or">O</div>

                    <div id="google-btn-wrapper">
                      <div id="g_id_onload"
                          data-client_id="'.GOOGLE_CLIENT_ID.'"
                          data-auto_prompt="false"
                          data-callback="googleCredentialResponse"
                          >
                      </div>
                      <div class="g_id_signin"
                          data-type="standard"
                          data-size="large"
                          data-theme="outline"
                          data-text="sign_in_with"
                          data-shape="rectangular"
                          data-logo_alignment="left">
                      </div>
                    </div>

                    <div class="footer">
                      <span>¿Aún no tienes una cuenta? <a class="goToSeleccionarUser">Crear Cuenta</a></span>
                    </div>
                  </div>

                  <!-- SELECCIONAR QUE HACER -->
                  <div class="tab-pane fade" id="select-user-type" role="tabpanel" aria-labelledby="select-user-type-tab" tabindex="0">
                    <div>
                      <span>Que quieres hacer en Work Global Service?</span>
                      <button type="button" class="btn-close close-acceder-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <a href="registroFumigador">Trabajar como fumigador</a>
                    |
                    <a href="#" class="goToCrearCuenta">Solicitar servicio de fumigacion</a>

                  </div>

                  <!-- CREAR CUENTA -->
                  <div class="tab-pane fade" id="crear-cuenta" role="tabpanel" aria-labelledby="crear-cuenta-tab" tabindex="0">

                    <div>
                      <span>Crear Cuenta</span>
                      <button type="button" class="btn-close close-acceder-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="crearCuenta-form" novalidate>
                      <div class="row mb-4">
                        <div class="form-floating position-relative col-md-6">
                          <input type="text" class="form-control" id="crearCuentaUserNombre" name="nombre" placeholder="Nombre:" isValid="false">
                          <label for="crearCuentaUserEmail">Nombre:</label>
                          <div class="invalid-tooltip"></div>
                        </div>
                        <div class="form-floating position-relative col-md-6 ps-0">
                          <input type="text" class="form-control" id="crearCuentaUserApellido" name="apellido" placeholder="Apellido:" isValid="false">
                          <label for="crearCuentaUserPassword">Apellido:</label>
                          <div class="invalid-tooltip"></div>
                        </div>    
                      </div>
                      <div class="form-floating position-relative mb-4">
                        <input type="email" class="form-control" id="crearCuentaUserEmail" name="email" placeholder="email@ejemplo.com" isValid="false">
                        <label for="crearCuentaUserEmail">E-Mail:</label>
                        <div class="invalid-tooltip"></div>
                      </div>
                      <div class="form-floating position-relative mb-4">
                        <input type="password" class="form-control" id="crearCuentaUserPassword" name="contraseña" placeholder="Password" isValid="false">
                        <label for="crearCuentaUserPassword">Contraseña:</label>
                        <div class="invalid-tooltip"></div>
                      </div>
                      <div class="form-floating position-relative mb-2">
                        <input type="password" class="form-control" id="crearCuentaUserConfirmPassword" name="confirmContraseña" placeholder="Confirm Password" isValid="false">
                        <label for="crearCuentaUserConfirmPassword">Confirmar Contraseña:</label>
                        <div class="invalid-tooltip"></div>
                      </div>
                      <button id="crearCuenta-btn">
                        Crear Cuenta
                        <i class="material-symbols-outlined">how_to_reg</i>
                      </button>
                    </form>

                    <div class="or">O</div>

                    <div id="google-btn-wrapper">
                      <div id="g_id_onload"
                          data-client_id="<?php echo GOOGLE_CLIENT_ID ?>"
                          data-auto_prompt="false"
                          data-callback="googleCredentialResponse"
                          >
                      </div>
                      <div class="g_id_signin"
                          data-type="standard"
                          data-size="large"
                          data-theme="outline"
                          data-text="sign_in_with"
                          data-shape="rectangular"
                          data-logo_alignment="left">
                      </div>
                    </div>

                    <div class="footer">
                      <span>¿Ya tienes una cuenta? <a class="goToIniciarSesion">Iniciar Sesion</a></span>
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        ';

      echo $varHead;
    }

    public function footer(){
      $user = !empty($_SESSION["user"]) ? json_decode($_SESSION["user"]) : null;
      $userIsLogged = !empty($user);
  
      $footerTabs   = $userIsLogged ?
        '<a href="servicios" class="tab-item navigation-link">
          <i class="material-symbols-outlined">calendar_month</i>
          <span>Servicios</span>
        </a>
        <a href="alertas" class="tab-item navigation-link">
          <i class="material-symbols-outlined">notifications</i>
          <span>Alertas</span>
        </a>
        <a href="perfil" class="tab-item navigation-link">
          <i class="material-symbols-outlined">person</i>
          <span>Perfil</span>
        </a>'
      :
        '<a href="#" class="tab-item crearCuenta-footer-btn">
          <i class="material-symbols-outlined">how_to_reg</i>
          <span>Crear Cuenta</span>
        </a>
        <a href="#" class="tab-item  iniciarSesion-footer-btn">
          <i class="material-symbols-outlined">login</i>
          <span>Iniciar Sesión</span>
        </a>';

      $footer = '
        <nav class="footer-tabs container-fluid d-lg-none d-flex">
          
          <a href="/" class="tab-item navigation-link">
            <i class="material-symbols-outlined">home</i>
            <span>Home</span>
          </a>
          '.$footerTabs.'
        </nav>
        <footer>
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

      <!-- Global Custom JS Files -->
      <script>const urlBase = "'. _URL_ .'"</script>
      <script src="'._URL_.'assets/js/common/validaciones.js"></script> 
      <script src="'._URL_.'assets/js/common/service.js"></script>
      <script src="'._URL_.'assets/js/common/notificaciones.js"></script>
      <script src="'._URL_.'assets/js/common/googleOAUTH.js"></script>
      <script src="'._URL_.'assets/js/common/googleMaps.js"></script>
      <script src="'._URL_.'assets/js/common/oauth.js"></script>
      <script src="'._URL_.'assets/js/common/global.js"></script>
      <script src="'._URL_.'assets/js/app/header.js"></script>';

      echo $varJs;

    }
  }

?>