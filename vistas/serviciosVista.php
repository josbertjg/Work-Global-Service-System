<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>
  <?php $components->header(true) ?>
  <main class="w-100 pt-5"> 
    <div class="container">
      <div class="row">
        <div class="col-lg-12">   
          <h2 class="text-center text-danger mb-3">Gestión de Servicios</h2>         
          <button id="btnNuevo" type="button" class="btn btn-danger" data-toggle="modal">
          <i class="material-icons">add</i>
        </div>    
      </div>    
    </div>    
    <br>  
    <?php  $components->Tables('servicio') ?>
    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form id="FormServicio" novalidate>
            <div class="modal-body">
              <div class="mb-3">
                <label for="nombreServicio" class="form-label">Nombre del Servicio:</label>
                <input type="text" class="form-control" id="nombreServicio" name="nombre" placeholder="Nombre del Servicio:" isValid="false">
                <div class="invalid-tooltip"></div>
              </div>
              <div class="mb-3">
                <label for="quimico" class="form-label">Químico:</label>
                <select class="form-select" id="quimico" name="quimico" isValid="false">
                  <!-- Aquí van las opciones de químicos desde la base de datos -->
                  <option selected>Selecciona un Quimico</option>
                </select>
                <div class="invalid-tooltip"></div>
              </div>
              <div class="mb-3">
                <label for="descripcionServicio" class="form-label">Descripción del Servicio:</label>
                <textarea id="descripcionServicio" name="descripcion" rows="12" class="form-control" isValid="false"></textarea>
                <div class="invalid-tooltip"></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="btnGuardar" class="btn btn-danger">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/servicios.js"></script>
  <script src="assets/js/imports/datatables.min.js"></script>
  <script src="assets/js/common/tabledata.js"></script>

</body>

</html>