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
          <h2 class="text-center text-danger mb-3">Gestión de Establecimientos</h2>         
          <button id="btnNuevo" type="button" class="btn btn-danger" data-toggle="modal">
          <i class="fa-solid fa-plus"></i>
        </div>    
      </div>    
    </div>    
    <br>  
    <?php  $components->Tables('establecimientos') ?>
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
          <form id="FormEstablecimiento" novalidate>
            <div class="modal-body">
              <div class="mb-3">
                <label for="nombreEstablecimiento" class="form-label">Establecimiento:</label>
                <input type="text" class="form-control" id="nombreEstablecimiento" name="nombre" placeholder="Establecimiento:" isValid="false">
                <div class="invalid-tooltip"></div>
              </div>
              <div class="mb-3">
                <label for="number" class="form-label">Tamaño aproximado (metro cuadrado):</label>
                <input type="number" id="number" name="number" min="1" max="1500">
                <div class="invalid-tooltip"></div>
              </div>
              <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción del Establecimiento:</label>
                <textarea id="descripcion" name="descripcion" rows="5" class="form-control" isValid="false"></textarea>
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
  <script src="assets/js/app/establecimientos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/r-3.0.2/datatables.min.js"></script>
  <!-- <script src="assets/js/imports/datatables.min.js"></script> -->
  <script src="assets/js/common/tabledata.js"></script>

</body>

</html>