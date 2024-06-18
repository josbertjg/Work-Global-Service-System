<!DOCTYPE html>
<html lang="en">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(true) ?>
 
  <main class="container-fluid d-flex justify-content-center px-0"> 
    <div class="container">
      <div class="row pt-3 px-0">

        <!-- Informacion del fumigador -->
        <section class="col-lg-7 col-12 info-fumigador-container">
          <div class="presentation-card">
            <div class="header mb-5">
              <img class="fotoPerfil me-md-3 me-none" src="assets/img/perfil/josbertjg@gmail.com.jpg" alt="fumigador imagen">
              <section>
                <div class="nombre-container">
                  <h1 class="nombre"></h1>
                  <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="aditional-info">
                  <span class="servicios-count"></span>
                  <span class="tiempo"></span>
                </div>
              </section>
            </div>
            <div class="body">
              <div class="fumigador-info-section">
                <h1>Sobre mí</h1>
                <p class="descripcion"></p>
              </div>
            </div>
          </div>
          <div class="fumigador-info-section">
            <h1>Perfil Verificado <i class="fa-solid fa-circle-check"></i></h1>
            <p>Este perfil a sido validado y verificado por el equipo de Work Global Service.</p>
          </div>
          <div class="fumigador-info-section">
            <h1>Servicios ofrecidos por el fumigador</h1>
            <div class="accordion accordion-flush" id="accordionServiciosFumigador"></div>
          </div>
        </section>

        <!-- CARD DE LA ORDEN -->
        <section class="col-lg-5 col-12 px-0 realizar-orden-card">

          <div class="orden-card-wrapper">
            <ul class="nav nav-pills mb-3" id="orden-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-choose-servicios-tab" data-bs-toggle="pill" data-bs-target="#pills-choose-servicios" type="button" role="tab" aria-controls="pills-choose-servicios" aria-selected="true" disabled>Servicios</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-choose-disponibilidad-tab" data-bs-toggle="pill" data-bs-target="#pills-choose-disponibilidad" type="button" role="tab" aria-controls="pills-choose-disponibilidad" aria-selected="false" disabled>Disponibilidad</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-validar-orden-tab" data-bs-toggle="pill" data-bs-target="#pills-validar-orden" type="button" role="tab" aria-controls="pills-validar-orden" aria-selected="false" disabled>Ordenar</button>
              </li>
            </ul>
            <div class="tab-content" id="orden-tabsContent">

              <!-- SERVICIOS CONTENT -->
              <div class="tab-pane fade show active" id="pills-choose-servicios" role="tabpanel" aria-labelledby="pills-choose-servicios-tab" tabindex="0">
                <p>Elige el tipo de Vivienda / Establecimiento el cual se ajusta más al lugar en donde se realizará la fumigación:</p>
                <div class="d-flex">
                  <div class="flex-fill d-flex flex-column w-100 mb-3">
                    <label class="servicio-label" for="ordenEstablecimientosAutocomplete">Tipo de Establecimiento:</label>
                    <select class="flex-fill" id="ordenEstablecimientosAutocomplete" style="height: 56px !important;"></select>
                  </div>
                </div>

                <label class="available-services-label">Servicios disponibles:</label>
                <ul class="available-services-list mb-3"></ul>
               
                <div class="footer-card">
                  <button class="change-tab verOrdenDisponibilidad">Siguiente <i class="fa-solid fa-arrow-right"></i></button>
                </div>
              </div>

              <!-- DISPONIBILIDAD CONTENT -->
              <div class="tab-pane fade" id="pills-choose-disponibilidad" role="tabpanel" aria-labelledby="pills-choose-disponibilidad-tab" tabindex="0">
                <p>Selecciona el día y la hora en el que deseas contratar al fumigador, este será el dia y la hora en que el fumigador asistirá a tu ubicación y ejecutará el servicio.</p>
                <form id="formOrdenDisponibilidad" novalidate>
                  <div class="form-floating mb-3 datetimepicker-container">
                    <input type="date" class="form-control" id="choose-date" placeholder="Selecciona el día" isValid="false">
                    <label for="choose-date">Selecciona el día</label>
                    <div class="invalid-tooltip"></div>
                    <i class="fa-solid fa-calendar-days"></i>
                  </div>
                  <div class="form-floating mb-4 datetimepicker-container">
                    <input type="date" class="form-control" id="choose-time" placeholder="Selecciona la hora" isValid="false">
                    <label for="choose-date">Selecciona la hora</label>
                    <div class="invalid-tooltip"></div>
                    <i class="fa-solid fa-clock"></i>
                  </div>
                  <div class="footer-card">
                    <a class="change-tab volver-serviciosTab"><i class="fa-solid fa-arrow-left"></i> Volver</a>
                    <button class="change-tab verOrdenDetalle">Detalles de la Orden <i class="fa-solid fa-arrow-right"></i></button>
                  </div>
                </form>

              </div>

              <!-- ORDENAR CONTENT -->
              <div class="tab-pane fade" id="pills-validar-orden" role="tabpanel" aria-labelledby="pills-validar-orden-tab" tabindex="0">
                <div class="date-orden-selected-container mb-2">Fecha: <span class="date-orden-selected"></span></div>
                <ul class="servicios-seleccionados-container details"></ul>
                <div class="total-container d-flex justify-content-between mb-3">
                  <span class="total">Total:</span>
                  <span class="monto"></span>
                </div>
                <div class="footer-card">
                  <a class="change-tab volver-disponibilidadTab"><i class="fa-solid fa-arrow-left"></i> Volver</a>
                  <a class="change-tab pagarOrden">Ir a Pagar <i class="fa-solid fa-arrow-right"></i></a>
                </div>
              </div>
            </div>

          </div>

        </section>

      </div>
    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/realizarorden.js"></script>
</body>

</html>
