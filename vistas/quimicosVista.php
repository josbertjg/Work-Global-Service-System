<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>
  <?php $components->header(true) ?>
  <main class="w-100 pt-5"> 
    <div class="container">
      <div class="row">
        <div class="col-lg-12">   
          <h2 class="text-center text-danger mb-3">Gestión de Químicos</h2>         
          <button id="btnNuevo" type="button" class="btn btn-danger" data-toggle="modal">
          <i class="material-icons">add</i>
        </div>    
      </div>    
    </div>    
    <br>  
    <?php  $components->Tables('quimicos') ?>
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
            <form id="FormQuimico" novalidate enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreQuimico" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombreQuimico" name="nombre" placeholder="Nombre:" isValid="false">
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="mb-3">
                        <label for="rutaIcono" class="form-label">Icono:</label>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="rutaIcono" name="Icono" isValid="false">
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="mb-3">
                        <label for="Descripcion" class="form-label">Descripcion:</label>
                        <textarea id="Descripcion" name="Descripcion" rows="12" class="form-control" isValid="false"></textarea>
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="mb-3">
                        <img id="selectedImg" src="" class="img-fluid">
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
  <script src="assets/js/app/quimico.js"></script>
  <script src="assets/js/imports/datatables.min.js"></script>
  <script src="assets/js/common/tabledata.js"></script>

</body>

</html>