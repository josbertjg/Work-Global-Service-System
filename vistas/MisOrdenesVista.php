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
            <!-- List group item 1 -->
            <a href="#" class="list-group-item list-group-item-action">
              Item 1
              <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal1">
                Show Modal
              </button>
            </a>
            <!-- List group item 2 -->
            <a href="#" class="list-group-item list-group-item-action">
              Item 2
              <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal2">
                Show Modal
              </button>
            </a>
            <!-- List gourp Item  -->
 
          <!-- Add more list group items dynamically using JS -->
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 1 -->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal1Label">Modal 1</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Modal content here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 2 -->
  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal2Label">Modal 2</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Modal content here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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