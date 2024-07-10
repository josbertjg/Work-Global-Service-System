<!DOCTYPE html>
<html lang="es">
  <?php $components->head(true); ?>
<body>

  <?php $components->header(false) ?>
 
  <main class=" container-fluid pt-5"> 
    <div class="container">
      <form id="registrarFumigador-form" novalidate>
        <h1>¡Empieza a trabajar con nosotros!</h1>
        <p>Rellena los datos en el formulario de manera clara, honesta y precisa, al finalizar, uno de nuestros administradores validara tus datos y corroborara si eres un candidato apto para comenzar a trabajar con nosotros.</p>

        <section class="row px-3 mb-4">
          <div class="col-md-6 ps-0 pe-md-3 pe-0">
            <label for="registrarFumigadorCedula">Cedula:</label>
            <div class="form-floating position-relative">
              <input type="text" class="form-control" id="registrarFumigadorCedula" name="cedula" placeholder="Ej: 28150010" isValid="false">
              <label for="registrarFumigadorCedula">Ej: 28150010</label>
              <div class="invalid-tooltip"></div>
            </div>
          </div>

          <div class="col-md-6 p-0">
            <label for="registrarFumigadorImagenCedula">Imagen/Foto de la cedula:</label>
            <div class="form-floating position-relative">
              <input type="file" class="form-control pt-3" id="registrarFumigadorImagenCedula" name="imgCedula" isValid="false">
              <div class="invalid-tooltip"></div>
            </div>    
          </div>
        </section>

        <section class="mb-4 px-1">
          <label class="ps-1" for="registrarFumigadorUbicacion">Dirección del fumigador:</label>
          <div class="form-floating position-relative">
            <input type="text" class="form-control" id="registrarFumigadorUbicacion" name="ubicacion" isValid="false">
            <label for="registrarFumigadorUbicacion">Dirección:</label>
            <div class="invalid-tooltip"></div>
          </div>
        </section>

        
        
        <section class="row px-3 mb-4 regFumig-map-wrapper">
          <div class="col-md-6 ps-0 pe-md-3 pe-0"> 
            <div class="mb-4">
              <label for="registrarFumigadorEstado">Estado:</label>
              <div class="form-floating position-relative">
                <select class="flex-fill" id="registrarFumigadorEstado" style="height: 56px !important; width: 100% !important;"></select>
                <div class="invalid-tooltip"></div>
              </div>
            </div>

            <div>
              <label for="registrarFumigadorCiudad">Ciudad:</label>
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
          <label for="registrarFumigadorDescripcion">Descripción:</label>
          <div class="form-floating position-relative">
            <input type="text" class="form-control" id="registrarFumigadorDescripcion" name="descripcion" isValid="false">
            <label for="registrarFumigadorDescripcion">Ej: Soy un fumigador con mucha exp...</label>
            <div class="invalid-tooltip"></div>
          </div>
        </section>

        <section class="row px-3 mb-4">

          <div class="col-md-6 pe-md-3 p-0">
            <label for="registrarFumigadorTelefono">Nro de telefono:</label>
            <div class="form-floating position-relative mb-2">
              <input type="password" class="form-control" id="registrarFumigadorTelefono" name="telefono" isValid="false">
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
  </main>

  <?php $components->footer(); ?>
  <?php $components->js() ?>
  <script src="assets/js/app/registrarFumigador.js"></script>
</body>

</html>