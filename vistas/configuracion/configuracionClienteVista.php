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
                  <a href="Mis-Ordenes">
                    <button type="button" class="btn btn-light btnConfi">
                    <i class="fa-solid fa-calendar me-1"></i>Mis Ordenes
                    </button>
                  </a>              
                </section>
                <section class="col-sm-6 col-12 mb-2">
                  <a href="/">
                    <button type="button" class="btn btn-light btnConfi">
                    <i class="fa-solid fa-bell me-1"></i>Alertas
                    </button> 
                  </a>
                </section>
              </div>
              <!-- fin de dos cards -->
              <!-- inicio de dos cards -->
              <div class= "row">
                <section class="col-sm-6 col-12 mb-2">
                  <a href="ofrecerServicios">
                    <button type="button" class="btn btn-light btnConfi">
                    <i class="fa-solid fa-bug me-1"></i>Ofrecer Servicios
                    </button>
                  </a>              
                </section>
                <section class="col-sm-6 col-12 mb-2">
                  <a href="/">
                    <button type="button" class="btn btn-light btnConfi">
                    <i class="fa-solid fa-circle-info me-1"></i>Ayuda
                    </button> 
                  </a>
                </section>
              </div>
              <!-- fin de dos cards -->
              <!-- inicio de dos cards -->
              <div class= "row">
                <section class="col-sm-6 col-12 mb-2">
                  <a href="#">
                    <button type="button" class="btn btn-light btnConfi logout">
                      <i class="fa-solid fa-right-to-bracket me-1"></i>Cerrar Sesión
                    </button>
                  </a>              
                </section>
              </div>
              <!-- fin de dos cards -->
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