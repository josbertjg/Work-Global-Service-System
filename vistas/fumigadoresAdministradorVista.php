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
                    <h2 class="text-center text-danger mb-3">Gestión de Fumigadores</h2>
                    <button id="btnNuevo" type="button" class="btn btn-danger " data-toggle="modal">
                        <i class="fa-solid fa-plus"></i>
                </div>  
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <select class="form-select" aria-label="Fumigadores" id="fumigadores" name="fumigadores">
                        <option selected value="default">Seleccion de fumigadores</option>
                        <option value="0">Solicitados</option>
                        <option value="1">Aceptados</option>
                        <option value="2">Rechazados</option>
                    </select>
                </div>  
            </div>     
        </div>    
        <br>  
        <?php  $components->Tables('fumigadores') ?>
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
                <div class="modal-body">
                    <section class="row mb-2">
                    <h4 class="text-center w-100">Datos del Fumigador</h4>
                    </section>
                    <section class="row">
                        <div class="col-6 text-center">
                            <label for="cedula" class="form-label">Cedula</label>
                        </div>
                        <div class="col-6 text-center">
                            <span id="cedula">XX.XXX.XXX</span>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-6 text-center">
                            <label for="nombre" class="form-label">Nombre</label>
                        </div>
                        <div class="col-6 text-center">
                            <span id="nombre">Nombre</span>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-6 text-center">
                            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                        </div>
                        <div class="col-6 text-center">
                            <span id="fechaN">02/05/2002</span>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-6 text-center">
                            <label for="telefono" class="form-label">Telefono</label>
                        </div>
                        <div class="col-6 text-center">
                            <span id="telefono">XX.XXX.XXX</span>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-6 text-center">
                            <label for="direccion" class="form-label">Direccion</label>
                        </div>
                        <div class="col-6 text-center">
                            <span id="direccion">
                                Carrera 13-A & Calle 62, Barquisimeto, Lara, Venezuela
                            </span>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-6 text-center">
                            <label for="fechaV" class="form-label">Fecha Validado</label>
                        </div>
                        <div class="col-6 text-center">
                            <span id="fechaV">
                                2024-02-24
                            </span>
                        </div>
                    </section>
                    <section class="row" style="display: flex; justify-content: center; align-items: center; height: 120px;">
                        <img id="image" src="assets/img/uploads/cedulas/josbertjg@gmail.com.jpg" alt="Vista previa de la imagen" style="max-width: 120px; max-height: 120px; margin: auto;" class="img-fluid w-100">
                        <div id="enlarged-image"></div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-danger">Guardar</button>
                </div>
        </div>
    </div>
</div>
    </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/fumigadoresAdministrador.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/r-3.0.2/datatables.min.js"></script>
  <script src="assets/js/common/tabledata.js"></script>

</body>

</html>