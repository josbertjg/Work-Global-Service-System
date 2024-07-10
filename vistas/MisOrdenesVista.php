<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
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
      <!-- Inicio Row para las listas -->
      <div class="row">
        <div class="col-md-12">
          <div class="list-group list-group-flush">
            <!-- Add more list group items dynamically using JS -->
          </div>
        </div>
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
</body>

</html>