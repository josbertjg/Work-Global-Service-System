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
          <h2 class="text-center text-danger mb-3">Ordenes de Servicio</h2>
          </div>  
        </div>
        <br>  
      </div>    
      <br>  
      <?php  $components->Tables('OrdenesServicio') ?>
      <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" id="contenidoModal">
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/ordenes.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/r-3.0.2/datatables.min.js"></script>
  <script src="assets/js/common/tabledata.js"></script>

</body>

</html>