<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(false) ?>
 
  <main class="w-100"> 
    <div class="container">
      <div class="container-fluid row">
        <section class="col-1 d-flex justify-content-end align-items-start pt-5">
          <a href="configuracion">
            <i class="fa-solid fa-arrow-left goBack"></i>
          </a>
        </section>
        <section class="col-md-11 col-12 pt-5">
          <div class="row container-botones-servicios">
            <h1 class="col-12">
              Mis servicios ofrecidos
              <i 
                class="fa-solid fa-circle-info fs-3" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top"
                data-bs-custom-class="custom-tooltip-dark"
                data-bs-title="Estos son los servicios que ofreces a tus clientes, en verde aparecen los activos, en rojo los inactivos."
              ></i>
            </h1>
            <p><span class="badge text-bg-success">Habilitados</span> <span class="badge text-bg-danger">Deshabilitados</span></p>
          </div>
        </section>
      </div>
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/misServicios.js"></script>
</body>

</html>