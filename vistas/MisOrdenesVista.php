<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/r-3.0.2/datatables.min.css" rel="stylesheet">
<body>

  <?php $components->header(true) ?>
 
  <main class="w-100 pt-5">
    <div class="container">
      <!--  Row del Header -->
      <div class="row">
        <div class="col-lg-12">
          <h2 class="text-center text-danger mb-3">Mis Ordenes</h2>
        </div>
      </div>    
      <br>
      <!-- Fin del row del Header -->
      <div class="borderless-table">
      <?php $components->tables("MisOrdenes");?>
      <input type="hidden" id="gclient-key" value="<?php echo $components->GClient();?>">
      </div>
    </div>
  
    <!-- ORDEN DETAILS MODAL -->
    <div class="modal fade" id="ordenDetailsModal" tabindex="-1" aria-labelledby="ordenDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-lg-down">
        <div class="modal-content">
          <div class="modal-header" id="modalHead">
            
          </div>
          <div class="modal-body p-0">
            <div class="accordion accordion-flush" id="ordenDetailsAccordion"></div>
          </div>
          <div class="orden-details-monto-total">
            <span>Monto Total + Sobrecargos</span>
            <b class="monto"></b>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add-sobrecargo" tabindex="-1" aria-labelledby="add-sobrecargoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="add-sobrecargoLabel">Añadir un Sobre Cargo a esta Orden</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add-sobrecargo-form">

              <label for="addSobrecargoPrecio">
                Precio del SobreCargo
                <i 
                  class="fa-solid fa-circle-info" 
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Este será el monto en dólares que será sumado al total de la nota de entrega de la orden."
                ></i>
              </label>
              <div class="form-floating position-relative mb-4">
                <input type="text" class="form-control" id="addSobrecargoPrecio" name="precio" isValid="false">
                <label for="addSobrecargoPrecio">Precio $:</label>
                <div class="invalid-tooltip"></div>
              </div>

              <label for="addSobrecargoDescripcion">
                Motivo del SobreCargo
                <i 
                  class="fa-solid fa-circle-info" 
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Este es el motivo por el cual estas aplicando un sobrecargo a la orden."
                ></i>
              </label>
              <div class="form-floating position-relative mb-2">
                <input type="text" class="form-control" id="addSobrecargoDescripcion" name="descripcion" isValid="false">
                <label for="addSobrecargoDescripcion">Descripción:</label>
                <div class="invalid-tooltip"></div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a id="close-sobrecargo-modal" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</a>
            <button type="button" class="btn btn-success add-sobrecargo-submit">Añadir SobreCargo</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/MisOrdenes.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/r-3.0.2/datatables.min.js"></script>
  <script src="assets/js/common/tabledata.js"></script>
</body>

</html>