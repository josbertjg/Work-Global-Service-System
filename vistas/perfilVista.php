<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(true) ?>
 
  <main class="container-fluid"> 
    <div class="container">
      <div class="row">
        <section class="col-1 d-flex justify-content-end align-items-start pt-5">
          <a href="configuracion">
            <i class="fa-solid fa-arrow-left goBack"></i>
          </a>
        </section>
        <section class="col-11 pt-5">
          <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-center mb-2">
              <img src="" alt="usuario work global service" class="img-perfil-user rounded rounded-pill">
            </div>
            <div class="col-md-6 col-12">
              <div class="form-floating position-relative mb-2 pe-0">
                <input type="text" class="form-control" name="nombre" id="nombre" disabled/>
                <label for="nombre">Nombre:</label>
                <div class="invalid-tooltip"></div>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-floating position-relative mb-2 pe-0">
                <input type="text" class="form-control" name="apellido" id="apellido" disabled/>
                <label for="apellido">Apellido:</label>
                <div class="invalid-tooltip"></div>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-floating position-relative mb-2 pe-0">
                <input type="text" class="form-control" name="email" id="email" disabled/>
                <label for="email">Email:</label>
                <div class="invalid-tooltip"></div>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-floating position-relative mb-2 pe-0">
                <input type="password" class="form-control" name="contraseña" id="contraseña" disabled/>
                <label for="contraseña">Contraseña:</label>
                <div class="invalid-tooltip"></div>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-floating position-relative mb-2 pe-0">
                <input type="text" class="form-control" name="telefono" id="telefono" disabled/>
                <label for="telefono">Telefono:</label>
                <div class="invalid-tooltip"></div>
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-floating position-relative mb-2 pe-0">
                <input type="text" class="form-control" name="idRol" id="rol" disabled/>
                <label for="rol">Rol:</label>
                <div class="invalid-tooltip"></div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/perfil.js"></script>
</body>

</html>