<!DOCTYPE html>
<html lang="es">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(false) ?>
 
  <main class=" container-fluid pt-5"> 
    <div class="container">

      
      <!-- TABS ESCONDIDAS -->
      <div class="nav nav-tabs d-none">
        <button class="nav-link active" id="registrarfumig-identificate-tab" data-bs-toggle="tab" data-bs-target="#registrarfumig-identificate" type="button" role="tab" aria-controls="registrarfumig-identificate" aria-selected="true">homw</button>
        <button class="nav-link" id="registrarfumig-registrarse-tab" data-bs-toggle="tab" data-bs-target="#registrarfumig-registrarse" type="button" role="tab" aria-controls="registrarfumig-registrarse" aria-selected="false">asdad</button>
      </div>
      
      <div class="tab-content" id="nav-tabContent">
        
        <!-- IDENTIFICATE CONTENT -->
        <div class="tab-pane fade show active" id="registrarfumig-identificate" role="tabpanel" aria-labelledby="registrarfumig-identificate-tab" tabindex="0">
          <h1>¡Empieza a trabajar con nosotros!</h1>
          <p>Primero debes iniciar sesión en la app, o si no crear una cuenta desde cero, gracias a esto podremos seguir con el siguiente paso, <b>¡Que esperas!</b> necesitamos de tu apoyo para exterminar a toda plaga que aparezca!</p>

          <div class="d-flex">
            <button class="regFumig-login-btn">Iniciar sesión con mi cuenta</button>
            <button class="regFumig-crearCuenta-btn">Crear una cuenta</button>
          </div>
        </div>

        <!-- FORMULARIO REGISTRAR FUMIGADOR CONTENT -->
        <div class="tab-pane fade" id="registrarfumig-registrarse" role="tabpanel" aria-labelledby="registrarfumig-registrarse-tab" tabindex="0">
          <h1>¡A un solo paso de lograrlo!</h1>
          <p>Rellena los datos en el formulario de manera clara, honesta y precisa, al finalizar, uno de nuestros administradores validara tus datos y corroborara si eres un candidato apto para comenzar a trabajar con nosotros.</p>
          <form id="registrarFumigador-form" novalidate>
      
            <section class="row px-3 mb-4">
              <div class="col-md-6 ps-0 pe-md-3 pe-0">
                <label for="registrarFumigadorCedula">
                  Cedula 
                  <i 
                    class="fa-solid fa-circle-info añadir-servicio" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip-dark"
                    data-bs-title="Ingresa solo los digitos de tu cedula, necesitamos esto para verificar tu identidad."
                  ></i>
                </label>
                <div class="form-floating position-relative">
                  <input type="text" class="form-control" id="registrarFumigadorCedula" name="cedula" placeholder="Ej: 28150010" isValid="false">
                  <label for="registrarFumigadorCedula">Ej: 28150010</label>
                  <div class="invalid-tooltip"></div>
                </div>
              </div>
      
              <div class="col-md-6 p-0">
                <label for="registrarFumigadorImagenCedula">
                  Imagen/Foto de la cedula
                  <i 
                    class="fa-solid fa-circle-info añadir-servicio" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip-dark"
                    data-bs-title="Esta imagen es completamente confidencial, y la usaremos solo con el fin de validar tu identidad y tu edad."
                  ></i>
                </label>
                <div class="form-floating position-relative">
                  <input type="file" class="form-control pt-3" id="registrarFumigadorImagenCedula" name="imgCedula" isValid="false" accept=".jpg, .jpeg, .png, .pdf">
                  <div class="invalid-tooltip"></div>
                </div>    
              </div>
            </section>
      
            <section class="mb-4 px-1">
              <label class="ps-1" for="registrarFumigadorUbicacion">
                Dirección del fumigador
                <i 
                  class="fa-solid fa-circle-info añadir-servicio" 
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Esta es la direccion de google que usaremos para fines administrativos y facilitar tu ubicacion hacia los clientes, puedes cambiarla en cualquier momento en el panel de configuración."
                ></i>
              </label>
              <div class="form-floating position-relative">
                <input type="text" class="form-control" id="registrarFumigadorUbicacion" name="direccion" isValid="false">
                <label for="registrarFumigadorUbicacion">Dirección:</label>
                <div class="invalid-tooltip"></div>
              </div>
            </section>
      
            <section class="row px-3 mb-4 regFumig-map-wrapper">
              <div class="col-md-6 ps-0 pe-md-3 pe-0"> 
                <div class="mb-4">
                  <label for="registrarFumigadorEstado">
                    Estado
                    <i 
                      class="fa-solid fa-circle-info añadir-servicio" 
                      data-bs-toggle="tooltip" 
                      data-bs-placement="top"
                      data-bs-custom-class="custom-tooltip-dark"
                      data-bs-title="Este es el estado al que pertenece dicha dirección que ingresaste o seleccionaste desde el mapa."
                    ></i>
                  </label>
                  <div class="form-floating position-relative">
                    <select class="flex-fill" id="registrarFumigadorEstado" style="height: 56px !important; width: 100% !important;"></select>
                    <div class="invalid-tooltip"></div>
                  </div>
                </div>
      
                <div class="mb-4">
                  <label for="registrarFumigadorCiudad">
                    Ciudad
                    <i 
                      class="fa-solid fa-circle-info añadir-servicio" 
                      data-bs-toggle="tooltip" 
                      data-bs-placement="top"
                      data-bs-custom-class="custom-tooltip-dark"
                      data-bs-title="Ciudad a la que pertenece la dirección que ingresaste o seleccionaste desde el mapa."
                    ></i>
                  </label>
                  <div class="form-floating position-relative">
                    <select class="flex-fill" id="registrarFumigadorCiudad" style="height: 56px !important; width: 100% !important;"></select>
                    <div class="invalid-tooltip"></div>
                  </div>
                </div>
      
              </div>
      
              <div class="col-md-6 p-0">
                <div id="registrarFumigador-map" class="registrarFumigador-map"></div>
              </div>
            </section>
      
            <section class="mb-4 px-1">
              <label for="registrarFumigadorDescripcion">
                Descripción
                <i 
                  class="fa-solid fa-circle-info añadir-servicio" 
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Esta será la descripcion que verán todos los clientes antes de contratar tus servicios, puedes cambiarla en cualquier momento desde tu perfil."
                ></i>
              </label>
              <div class="form-floating position-relative">
                <input type="text" class="form-control" id="registrarFumigadorDescripcion" name="descripcion" isValid="false">
                <label for="registrarFumigadorDescripcion">Ej: Soy un fumigador con mucha exp...</label>
                <div class="invalid-tooltip"></div>
              </div>
            </section>
      
            <section class="row px-3 mb-4">
      
              <div class="col-md-6 pe-md-3 p-0">
                <label for="registrarFumigadorTelefono">
                  Nro de telefono
                  <i 
                    class="fa-solid fa-circle-info añadir-servicio" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip-dark"
                    data-bs-title="Tu telefono será mostrado a los clientes que soliciten tus servicios, ingresa unicamente los números."
                  ></i>
                </label>
                <div class="form-floating position-relative mb-2">
                  <input type="text" class="form-control" id="registrarFumigadorTelefono" name="telefono" isValid="false">
                  <label for="registrarFumigadorTelefono">Ej: 04145598216</label>
                  <div class="invalid-tooltip"></div>
                </div>
              </div>
      
              <div class="col-md-6 p-0">
                <label for="registrarFumigadorNacimiento">Fecha de Nacimiento:</label>
                <div class="form-floating position-relative">
                  <input type="date" class="form-control" id="registrarFumigadorNacimiento" name="fechaNacimiento" isValid="false">
                  <label for="registrarFumigadorNacimiento">Nacimiento:</label>
                  <div class="invalid-tooltip"></div>
                </div>
              </div>
      
            </section>
      
            <button id="registrarFumigador-btn">
              Enviar solicitud de registro
              <i class="fa-solid fa-user-plus"></i>
            </button>
          </form>
        </div>
      </div>

    </div>
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/registrarFumigador.js"></script>
</body>

</html>