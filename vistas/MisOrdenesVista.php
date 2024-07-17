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
            <span>Monto Total</span>
            <b class="monto"></b>
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