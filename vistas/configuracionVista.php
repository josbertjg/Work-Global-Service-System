<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(true) ?>
 
  <main class="container-fluid height-adjustment d-flex justify-content-center">
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
      <!--  -->
      <section class="col-3">
        <div class="col-12">
          <div class="card">
            <img src="assets\img\user.svg" alt="" class="card-img-top " id="userIMG">
            <div class="card-body">
              <h5 class="card-title" id="ususario">Nombre del fumigador </h5>
              <a href="" class="btn btn-primary">Ir al Perfil</a>
            </div>
          </div>
        </div>
      </section>
        <section class="col-8">
          <!-- row de las opciones -->
          <div class="row">
            <!-- inicio de las cards -->
            <div class="col-12">
              <!-- inicio de dos cards -->
              <div class= "row mb-2">
                <section class="col-6">
                  <a href="servicios" class="aconfi">
                  <button type="button" class="btn btn-light btnConfi">
                  <i class="fa-solid fa-list"></i>
                  Servicios</button>   
                  </a>              
                </section>
                <section class="col-6">
                  <a href="establecimientos" >
                  <button type="button" class="btn btn-light btnConfi">
                  <i class="fa-solid fa-house-chimney-user"></i>
                  Establecimientos</button> 
                  </a>
                </section>
              </div>
              <!-- fin de dos cards -->
              <!-- inicio de dos cards -->
              <div class= "row mb-2">
                <section class="col-6">
                  <a href="precios" >
                  <button type="button" class="btn btn-light btnConfi">
                  <i class="fa-solid fa-dollar-sign"></i>
                  Precios</button>   
                  </a>              
                </section>
                <section class="col-6">
                  <a href="quimicos">
                  <button type="button" class="btn btn-light btnConfi">
                  <i class="fa-solid fa-flask-vial"></i>
                  Quimicos</button> 
                  </a>
                </section>
              </div>
              <!-- fin de dos cards -->
                 <!-- inicio de dos cards -->
                 <div class= "row mb-2">
                <section class="col-6">
                  <a href="permisos" >
                  <button type="button" class="btn btn-light btnConfi">
                  <i class="fa-solid fa-gear"></i>
                  Administrar Permisos</button>   
                  </a>              
                </section>
                <section class="col-6">
                  <a href="ordenes">
                  <button type="button" class="btn btn-light btnConfi">
                  <i class="fa-solid fa-clipboard-list"></i>
                  Ordenes de Servicio</button> 
                  </a>
                </section>
              </div>
              <!-- fin de dos cards -->
            </div>
          </div>
          <!-- fin del row de opciones -->
        </section>
        <!-- fin del secction -->
      </div>
      <!-- fin del container -->
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/configuracion.js"></script>
</body>

</html>