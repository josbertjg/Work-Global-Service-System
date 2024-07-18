<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(true) ?>
 
  <main class="container-fluid calendario-main">
    <div class="container">
      <div class="row">
        <section class="col-1 d-flex justify-content-end align-items-start pt-5">
          <a href="configuracion">
            <i class="fa-solid fa-arrow-left goBack"></i>
          </a>
        </section>
        <form class="col-11 pt-5" id="calendario-form">
          <h1 class="page-title">Mi calendario de disponibilidad</h1>
          
          <section class="row px-3 mb-4">
          
            <div class="dias-laborables-container col-md-6 pe-md-3 p-0 me-2 row">
              <label class="col-12 fs-5 fw-bold">
                Dias laborables
                <i 
                  class="fa-solid fa-circle-info text-primary" 
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Este será tu calendario de disponibilidad, es decir tus días hábiles laborables en los que los clientes podrán solicitar tus servicios."
                ></i>
              </label>

              <div class="pe-0 col-md-6">
                <label for="calendarioDiaInicio">De:</label>
                <div class="form-floating position-relative mb-2 pe-0">
                  <select class="flex-fill" name="diaInicio" id="calendarioDiaInicio" style="height: 56px !important; width: 100% !important;" isValid="true"></select>
                  <div class="invalid-tooltip"></div>
                </div>
              </div>

              <div class="pe-0 col-md-6">
                <label for="calendarioDiaInicio">A:</label>
                <div class="form-floating position-relative mb-2 pe-0">
                  <select class="flex-fill" name="diaFin" id="calendarioDiaFin" style="height: 56px !important; width: 100% !important;" isValid="true"></select>
                  <div class="invalid-tooltip"></div>
                </div>
              </div>

            </div>

            <div class="col-md-6 p-0 ps-3 pb-2 row position-relative">
              <label class="col-12 p-0 fs-5 fw-bold">
                Horario disponible
                <i 
                  class="fa-solid fa-circle-info text-primary" 
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Este será tu horario disponible diariamente, es decir, las horas del día en que estarás disponible para trabajar y recibir solicitudes."
                ></i>
              </label>

              <div class="ps-0 col-6">
                <label for="calendarioHoraInicio">Desde:</label>
                <div class="form-floating position-relative ps-0">
                  <input type="time" class="form-control" id="calendarioHoraInicio" name="horaInicio" isValid="true">
                  <label for="calendarioHoraInicio">Hora Inicio:</label>
                  <div class="invalid-tooltip"></div>
                </div>
              </div>
              <div class="ps-0 col-6">
                <label for="calendarioHoraFin">Hasta:</label>
                <div class="form-floating position-relative p-0">
                  <input type="time" class="form-control" id="calendarioHoraFin" name="horaFin" isValid="true">
                  <label for="calendarioHoraFin">Hora Fin:</label>
                  <div class="invalid-tooltip"></div>
                </div>
              </div>
            </div>

          </section>

          <section>

            <label class="fs-5 fw-bold mb-2">
              Dias no laborables
              <i 
                class="fa-solid fa-circle-info text-primary" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top"
                data-bs-custom-class="custom-tooltip-dark"
                data-bs-title="Fechas en las que los clientes no podrán hacer citas contigo además de las que excluiste con el rango de días, Ej: Si ingresaste como días laborables Lunes a Viernes, entonces no podrás recibir citas los Sábados y Domingos así no aparezcan en la lista de abajo."
              ></i>
            </label>
            <!-- Tabs Ver dias no laborables-->
            <nav>
              <div class="nav nav-tabs" role="tablist">
                <button class="nav-link active" id="dias-recurrentes-tab" data-bs-toggle="tab" data-bs-target="#dias-recurrentes" type="button" role="tab" aria-controls="dias-recurrentes" aria-selected="true">
                  Días Recurrentes
                  <i 
                    class="fa-solid fa-circle-info text-primary" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip-dark"
                    data-bs-title="Estos son los días en los que nunca estarás disponible para un cliente."
                  ></i>
                </button>
                <button class="nav-link" id="dias-especificos-tab" data-bs-toggle="tab" data-bs-target="#dias-especificos" type="button" role="tab" aria-controls="dias-especificos" aria-selected="false">
                  Días Específicos
                  <i 
                    class="fa-solid fa-circle-info text-primary" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip-dark"
                    data-bs-title="Estas son las fechas especificas únicas en las que no estarás disponible para un cliente."
                  ></i>
                </button>
              </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
              <!-- Recurrentes Content -->
              <div class="tab-pane fade show active p-4" id="dias-recurrentes" role="tabpanel" aria-labelledby="dias-recurrentes-tab" tabindex="0">
                <ul id="dias-recurrentes-list" class="p-0"></ul>
              </div>
              <!-- Especificos Content -->
              <div class="tab-pane fade p-4" id="dias-especificos" role="tabpanel" aria-labelledby="dias-especificos-tab" tabindex="0">
                <ul id="dias-especificos-list" class="p-0"></ul>
              </div>
            </div>
            
          </section>

          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-nolaborable">
              Añadir un nuevo dia no laborable
              <i class="fa-solid fa-plus"></i>
            </button>
            <button class="btn btn-success btn-block">
              Guardar
              <i class="fa-regular fa-floppy-disk"></i>
            </button>
          </div>
        </form>
      </div>
    </div> 

    <!-- Modal Añadir dia no laborable -->
    <div class="modal fade" id="add-nolaborable" tabindex="-1" aria-labelledby="add-nolaborableLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-lg-down">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="add-nolaborableLabel">
              Añadir Días No laborables
              <i 
                class="fa-solid fa-circle-info" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top"
                data-bs-custom-class="custom-tooltip-dark"
                data-bs-title="Fechas en las que los clientes no podrán hacer citas contigo además de las que excluiste con el rango de días, Ej: Si ingresaste como días laborables Lunes a Viernes, entonces no podrás recibir citas los Sábados y Domingos así no aparezcan en la lista de abajo."
              ></i>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Tabs Añadir dias no laborables-->
            <nav>
              <div class="nav nav-tabs" role="tablist">
                <button class="nav-link active" id="add-dias-recurrentes-tab" data-bs-toggle="tab" data-bs-target="#add-dias-recurrentes" type="button" role="tab" aria-controls="add-dias-recurrentes" aria-selected="true">
                  Añadir Días Recurrentes
                  <i 
                    class="fa-solid fa-circle-info text-primary" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip-dark"
                    data-bs-title="Estos son los días en los que nunca estarás disponible para un cliente."
                  ></i>
                </button>
                <button class="nav-link" id="add-dias-especificos-tab" data-bs-toggle="tab" data-bs-target="#add-dias-especificos" type="button" role="tab" aria-controls="add-dias-especificos" aria-selected="false">
                  Añadir Días Específicos
                  <i 
                    class="fa-solid fa-circle-info text-primary" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip-dark"
                    data-bs-title="Estas son las fechas especificas únicas en las que no estarás disponible para un cliente."
                  ></i>
                </button>
              </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
              <!-- Añadir Recurrentes Content -->
              <div class="tab-pane fade show active pt-3" id="add-dias-recurrentes" role="tabpanel" aria-labelledby="add-dias-recurrentes-tab" tabindex="0">
                <section class="row">
                  <div class="col-md-6 p-0 ps-3 pb-2">
                    <label for="calendarioAddDiaRecurrente">Los días:</label>
                    <div class="form-floating position-relative mb-2 pe-0 d-flex">
                      <select id="calendarioAddDiaRecurrente" style="height: 56px !important; width: 100% !important;"></select>
                      <a class="add-dia-recurrente btn btn-success rounded rounded-start-0 d-flex align-items-center"><i class="fa-solid fa-plus"></i></a>
                      <div class="invalid-tooltip"></div>
                    </div>
                  </div>

                  <div class="col-md-6 p-0 ps-3 pb-2">
                    <label class="">Recurrentes añadidos:</label>
                    <ul id="recurrentes-added-list" class="ps-0 pe-4 pt-3"></ul>
                  </div>
                </section>
              </div>
              <!-- Añadir Especificos Content -->
              <div class="tab-pane fade pt-3" id="add-dias-especificos" role="tabpanel" aria-labelledby="add-dias-especificos-tab" tabindex="0">
                <section class="row">
                  <div class="col-md-6 p-0 ps-3 pb-2">
                    <label for="calendarioAddDiaEspecifico">Solo el día:</label>
                    <div class="form-floating position-relative mb-2 pe-0 d-flex">
                      <input type="date" class="form-control" id="calendarioAddDiaEspecifico"/>
                      <label for="calendarioAddDiaEspecifico">Fecha Específica:</label>
                      <a class="add-dia-especifico btn btn-success rounded rounded-start-0 d-flex align-items-center"><i class="fa-solid fa-plus"></i></a>
                      <div class="invalid-tooltip"></div>
                    </div>
                  </div>

                  <div class="col-md-6 p-0 ps-3 pb-2">
                    <label>Específicos añadidos:</label>
                    <ul id="especificos-added-list" class="ps-0 pe-4 pt-3"></ul>
                  </div>
                </section>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/calendario.js"></script>
</body>

</html>