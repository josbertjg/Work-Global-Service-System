<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/r-3.0.2/datatables.min.css" rel="stylesheet">
<body>
  <?php $components->header(true) ?>

  <main class="w-100 pt-5"> 
    <div class="container">
      <div class="row">
        <div class="col-lg-12">   
          <h2 class="text-center text-danger mb-3">Gestión de Servicios</h2>         
          <button id="btnNuevo" type="button" class="btn btn-danger" data-toggle="modal">
          <i class="fa-solid fa-plus"></i>
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
                  <option selected value="default">Selecciona un Quimico</option>
                </select>
                <div class="invalid-tooltip"></div>
              </div>
              <div class="mb-3">
                <label for="imagenServicio" class="form-label">Imagen del Servicio:</label>
                <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="rutaIcono" name="Icono" isValid="false">
                <img id="selectedImg" src="" alt="Vista previa de la imagen" style="max-width: 120px; max-height: 120px;" class="img-fluid">
                <div class="invalid-tooltip"></div>
              </div>
              <div class="mb-3">
                <label for="descripcionServicio" class="form-label">Descripción del Servicio:</label>
                <textarea id="descripcionServicio" name="descripcion" rows="4" class="form-control" isValid="false"></textarea>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/r-3.0.2/datatables.min.js"></script>
  <!-- <script src="assets/js/imports/datatables.min.js"></script> -->
  <script src="assets/js/common/tabledata.js"></script>

</body>

</html>