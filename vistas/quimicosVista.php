<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>
  <?php $components->header(true) ?>
  <main class="w-100 pt-5"> 
    <div class="container">
      <div class="row">
        <div class="col-lg-12">            
          <button id="btnNuevo" type="button" class="btn btn-danger" data-toggle="modal">
          <i class="material-icons">add</i>
        </div>    
      </div>    
    </div>    
    <br>  
    <?php  $components->Tables('quimicos') ?>
    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- inicio del form -->
            <form id="FormQuimico" novalidate enctype="multipart/form-data">
              <!-- inicio del modal Body -->
              <div class="Modal-body">
                <!-- row -->
                <div class="row mb-8">
                  <div  class="form-floating position-relative col-md-12">
                    <input type="text" class="form-control" id="nombreQuimico" name="nombre" placeholder="Nombre:" isValid="false">
                    <label for="nombreQuimico">Nombre:</label>
                    <div class="invalid-tooltip"></div>
                  </div>
                </div>
                <!-- fin del row -->
                <!-- row -->
                <div class="row mb-8">
                  <div  class="form-floating position-relative col-md-12">
                    <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="rutaIcono" name="Icono" isValid="false">
                    <div class="invalid-tooltip"></div>
                  </div>
                </div>
                <!-- fin del row -->
                <!-- row -->
                <div class="row mb-9">
                  <div  class="form-floating position-relative col-md-12">
                  <textarea id="Descripcion" name="Descripcion" rows="12" class="form-control" isValid="false" style="height: 200px;"></textarea>
                  <label for="Descripcion">Descripcion:</label>
                  <div class="invalid-tooltip"></div>
                  </div>
                </div>
                <!-- fin del row -->

                <!-- row -->
                <div class="row mb-4">
                  <div  class="form-floating position-relative col-md-12">
                  <img id="selectedImg" src="" 
                  style=" 
                  max-width: 100%; 
                  height: auto; 
                  padding-top: 6px;">
                  </div>
                </div>
                <!-- fin del row -->

              </div>
              <!-- fin del modal body -->
              <!-- inicio del modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
              </div>
              <!--modal footer fin -->
            </form>
 
        </div>
      </div>
    </div>  
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/quimico.js"></script>
  <script src="assets/js/imports/datatables.min.js"></script>
  <script src="assets/js/common/tabledata.js"></script>

</body>

</html>