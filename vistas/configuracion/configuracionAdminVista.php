<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(true) ?>
 
  <main class="container-fluid height-adjustment d-flex justify-content-center configuracion-main">
    <!-- Inicio del container -->
    <div class="container"> 
      <!-- inicio del row principial -->
      <div class="row pt-3 px-0">
        <!-- Boton para echar patras -->
        <section class="col-1 d-flex justify-content-end align-items-start pt-5">
          <a href="/">
            <i class="fa-solid fa-arrow-left goBack"></i>
          </a>
          <!-- El resto -->
        </section>
        <!--Columna del Card del perfil-->
        <section class="col-md-3 col-11 mb-3 pt-5">
          <div class="col-12">
            <div class="card pt-2">
              <img src="assets\img\user.svg" alt="" class="card-img-top " id="userIMG">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title" id="ususario"></h5>
                <a href="perfil" class="btn btn-danger btn-block">Ver mis Datos</a>
              </div>
            </div>
          </div>
        </section>
        <!-- Columna para las opciones -->
        <section class="col-md-8 col-12 pt-5">
          <!-- row de las opciones -->
          <div class="row">
            <!-- inicio de las cards -->
            <div class="col-12">
              <!-- inicio de dos cards -->
              <div class= "row">
                <section class="col-sm-6 col-12 mb-2">
                  <a href="servicios" class="aconfi">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-list"></i>Servicios
                    </button>
                  </a>              
                </section>
                <section class="col-sm-6 col-12 mb-2">
                  <a href="establecimientos" >
                  <button type="button" class="btn btn-light btnConfi">
                  <i class="fa-solid fa-house-chimney-user"></i>
                  Establecimientos</button> 
                  </a>
                </section>
              </div>
              <!-- fin de dos cards -->
              <!-- inicio de dos cards -->
              <div class= "row">
                <section class="col-sm-6 col-12 mb-2">
                  <a href="precios" >
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-dollar-sign"></i>Precios
                    </button>   
                  </a>              
                </section>
                <section class="col-sm-6 col-12 mb-2">
                  <a href="quimicos">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-flask-vial"></i>Quimicos
                    </button> 
                  </a>
                </section>
              </div>
              <!-- fin de dos cards -->
              <!-- inicio de dos cards -->
              <div class= "row">
                <section class="col-sm-6 col-12 mb-2">
                  <a href="permisos" >
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-gear"></i>Administrar Permisos
                    </button>   
                  </a>              
                </section>
                <section class="col-sm-6 col-12 mb-2">
                  <a href="ordenes">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-clipboard-list"></i>Ordenes de Servicio
                    </button> 
                  </a>
                </section>
              </div> <!-- Fin de dos cards -->
              <!-- Inicio de Dos cards -->
              <div class="row">
                <section class="col-sm-6 col-12 mb-2">
                  <a href="facturas">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-file-invoice-dollar"></i>Facturas
                    </button>
                  </a>
                </section>
                <section class="col-sm-6 col-12 mb-2">
                  <a href="pagos">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-money-bill-1"></i>Pagos
                    </button>
                  </a>
                </section>
              </div><!--  fin de las cards-->
              <!-- Inicio de Dos cards -->
              <div class="row">
                <section class="col-sm-6 col-12 mb-2">
                  <a href="sobrecargos">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-file-invoice-dollar"></i>Sobrecargos
                    </button>
                  </a>
                </section>
                <section class="col-sm-6 col-12 mb-2">
                  <a href="reportes">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-file-lines"></i>Reportes
                    </button>
                  </a>
                </section>
              </div><!--  fin de las cards-->
               <!-- Inicio de Dos cards -->
               <div class="row mb-2">
                <section class="col-6">
                  <a href="fumigadoresAdministrador">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-file-invoice-dollar"></i>fumigadores
                    </button>
                  </a>
                </section>
                <section class="col-6">
                  <a href="reportes">
                    <button type="button" class="btn btn-light btnConfi">
                      <i class="fa-solid fa-file-lines"></i>Reportes
                    </button>
                  </a>
                </section>
                <section class="col-sm-6 col-12 my-2">
                  <a href="#">
                    <button type="button" class="btn btn-light btnConfi logout">
                      <i class="fa-solid fa-right-to-bracket me-1"></i>Cerrar Sesión
                    </button> 
                  </a>
                </section>
              </div><!--  fin de las cards-->
            </div><!-- fin de las columnas -->
          </div><!-- fin del row de opciones -->
        </section><!-- fin del secction -->
      </div>
    <!-- fin del container -->
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/configuracion.js"></script>
</body>

</html>