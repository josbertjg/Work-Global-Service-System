$(document).ready(async ()=>{
  // Obteniendo el id del fumigador pasado por get en la URL
  const urlParams = new URLSearchParams(window.location.search);
  const fumigadorID = urlParams.get('fumigador');

  toggleLoading(true)
  const currentFumigador = await service.post("realizarorden",{getCurrentFumigador: true, fumigadorID: fumigadorID});
  const establecimientos = await service.post("realizarorden", {getAllEstablecimientos: true});
  const preciosServicios = await service.post("realizarorden", {getAllPreciosServicios: true});
  let user               = null;
  try{
    user = JSON.parse(localStorage.getItem("user"));
  }catch(e){
    showAlert("error", "Oops, ocurrió un error", "Error al recuperar el usuario logueado")
    return setTimeout(() => window.location = "fumigadores", 4000);
  }
  toggleLoading(false)

  if("error" in establecimientos){
    showAlert("error", "Oops, ocurrió un error", establecimientos.error)
    return setTimeout(() => window.location = "fumigadores", 4000);
  }
  if("error" in currentFumigador){
    showAlert("error", "Oops, ocurrió un error", currentFumigador.error)
    return setTimeout(() => window.location = "fumigadores", 4000);
  }

  // Mostrando la info del fumigador
  mostrarInfoFumigador(currentFumigador);
 
  // Orden Tabs
  const serviciosTab      = new bootstrap.Tab(document.getElementById("pills-choose-servicios-tab"))
  const disponibilidadTab = new bootstrap.Tab(document.getElementById("pills-choose-disponibilidad-tab"))
  const detallesOrdenTabs = new bootstrap.Tab(document.getElementById("pills-validar-orden-tab"))

  // Servicios Tab
  let selectedEstablecimiento = null;
  let precioServiciosArray = null;
  let selectedPrecioServiciosArray = [];

  $('#ordenEstablecimientosAutocomplete').select2({
    placeholder: 'Vivienda/Lugar',
    data: _.map(establecimientos,(establecimiento)=>({id: establecimiento.idEstablecimientos, text: establecimiento.nombre}))
  });

  // Clearing all selections
  $('#ordenEstablecimientosAutocomplete').val(null).trigger('change');

  // Eventos del autocomplete
  $('#ordenEstablecimientosAutocomplete').on('select2:select', function (e) {
    selectedEstablecimiento = _.find(establecimientos,(establecimiento)=>(establecimiento.idEstablecimientos === e.params.data.id));
    if(!_.isEmpty(selectedEstablecimiento)){
      precioServiciosArray = _.filter(preciosServicios,(item)=>(item.establecimiento === selectedEstablecimiento.idEstablecimientos))
      if(!_.isEmpty(precioServiciosArray)){
        $(".available-services-list").empty();

        _.map(precioServiciosArray,(item)=>{
          const servicio = _.find(currentFumigador.servicios,(servicio)=>(servicio.idServicio == item.servicio))
          if(_.isEmpty(servicio)) return;

          $(".available-services-list").append(`
            <li class="available-services-item">
              <div class="available-service-info">
                <img 
                  src="assets/img/servicios/cienpies.svg"
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="${selectedEstablecimiento.nombre}"
                />
                <i class="fa-solid fa-plus"></i>
                ${servicio.nombre}
              </div>
              <div class="available-service-actions">
                <i 
                  class="fa-solid fa-circle-info"
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Exterminación de ${servicio.nombre} en ${selectedEstablecimiento.nombre}"
                ></i>
                <i class="fa-solid fa-plus añadir-servicio" idPrecioServicio="${item.id}"></i>
              </div>
            </li>
          `);
        })
        initTooltips();
      }else{
        $(".available-services-label").show();
        $(".available-services-list").empty();
        $(".available-services-list").html('<span class="no-available-services">Este fumigador no tiene servicios disponibles para dicho tipo de vivienda/establecimiento <i class="fa-regular fa-face-sad-cry"></i>, intenta con otro tipo o selecciona otro fumigador.</span>');
      }
    }
  });

  // Añadir un servicio a la orden
  $(document).on('click','.añadir-servicio', (event) => {
    if(!_.isEmpty(selectedEstablecimiento)){
      const percioServicioId = $(event.target).attr("idPrecioServicio");
      if(_.isEmpty(_.find(selectedPrecioServiciosArray,(item)=>(item.id === percioServicioId)))){

  
        selectedPrecioServiciosArray.push(_.find(precioServiciosArray,(item)=>(item.id === percioServicioId)));
  
        // $(".total-container .monto").empty();
        // $(".total-container .monto").text(`${_.sum(_.map(precioServiciosArray,(item)=>parseFloat(item.precio)))}$`);
      }else{
        Toast.fire({
          icon: "info",
          title: "Ya añadiste esta selección a la orden."
        });
      }
      console.log(selectedPrecioServiciosArray)
    }
  });

  $(".volver-serviciosTab").click(()=>serviciosTab.show())
  $(".verOrdenDisponibilidad").click(()=>{
    if(_.isEmpty(selectedPrecioServiciosArray)){
      Toast.fire({
        icon: "warning",
        title: "Debes añadir al menos un servicio para poder proceder."
      });
    }else{
      disponibilidadTab.show()
    }
  })

  // Disponibilidad Tab
  let selectedDate     = null;
  let selectedHour     = null;
  let selectedDateTime = null;
  $("#choose-date").flatpickr({
    onChange: function(selectedDates, dateStr, instance) {
      selectedDate = dateStr;
      if(!_.isEmpty(selectedHour)){
        selectedDateTime = `${selectedDate} ${selectedHour}`;
        $(".date-orden-selected").empty();
        $(".date-orden-selected").append(`${selectedDate} a las ${selectedHour}`)
      }
    },
    "disable": [
      function(date) {
          // return true to disable
          return (date.getDay() === 0 || date.getDay() === 6);

      }
    ],
    "locale": {
      "firstDayOfWeek": 1 // start week on Monday
    },
    minDate: moment().format()
  });

  $("#choose-time").flatpickr({
    enableTime: true,
    noCalendar: true,
    minTime: "08:00",
    maxTime: "16:00",
    onChange: function(selectedDates, dateStr, instance) {
      selectedHour = dateStr
      if(!_.isEmpty(selectedDate)){
        selectedDateTime = `${selectedDate} ${selectedHour}`;
        $(".date-orden-selected").empty();
        $(".date-orden-selected").append(`${selectedDate} a las ${selectedHour}`)
      }
    }
  });

  $(".volver-disponibilidadTab").click(()=>disponibilidadTab.show())

  // Form Disponibilidad
  required($("#choose-date"));
  required($("#choose-time"));

  $("#formOrdenDisponibilidad").on("submit",async (event)=>{
    event.preventDefault();
    const form = $("#formOrdenDisponibilidad");

    const formValid = checkFormValidity(form)
    
    if(formValid){
      detallesOrdenTabs.show();
    }
  })

  // Ir a pagar Orden
  $(".pagarOrden").click(async ()=>{
    if(!_.isEmpty(selectedDateTime) && !_.isEmpty(selectedPrecioServiciosArray)){
      toggleLoading(true);
      const dataToSend = {
        createOrden:     true,
        fumigador:       currentFumigador.cedula,
        clienteID:       user.clientID,
        clienteEmail:    user.email,
        fechaServicio:   selectedDateTime,
        ubicacion:       "123",
        establecimiento: selectedEstablecimiento.idEstablecimientos,
        servicios:       JSON.stringify(_.map(selectedPrecioServiciosArray,(item)=>(item.servicio)))
      }
      const respuesta = await service.post("realizarorden",dataToSend);
      if("error" in respuesta){
        showAlert("error","Upss, ocurrió un error inesperado.", respuesta.error)
      }else{
        Toast.fire({
          icon: "success",
          title: respuesta.success
        });
      }
      toggleLoading(false);
      // window.location = "pagarorden";
    }else{
      serviciosTab.show()
      Toast.fire({
        icon: "error",
        title: "Ocurrió un error inesperado, porfavor vuelve a llenar los datos."
      });
    }
  })
})

function mostrarInfoFumigador(fumigador){
  const dias  = moment().diff(moment(fumigador.fechaValidado), 'days');
  const meses = moment().diff(moment(fumigador.fechaValidado), 'months');
  const años  = moment().diff(moment(fumigador.fechaValidado), 'years');
  $(".info-fumigador-container .presentation-card .header .fotoPerfil").attr("src",fumigador.fotoPerfil)
  $(".info-fumigador-container .presentation-card .header .nombre").text(`${fumigador.nombre} ${fumigador.apellido}`)
  $(".info-fumigador-container .presentation-card .header .nombre").text(`${fumigador.nombre} ${fumigador.apellido}`)
  $(".info-fumigador-container .presentation-card .header .servicios-count").text(`0 Servicios realizados`)
  $(".info-fumigador-container .presentation-card .header .tiempo").text(`
    ${años <= 0 ?
      meses <= 0 ? 
        dias > 1 ? dias+" días" : dias+" día"
      :
        meses > 1 ? meses+" meses" : meses+" mes"
    :
      años > 1 ? años+" años" : años+" año"}
    en Work Global Service
  `)
  $(".fumigador-info-section .descripcion").text(fumigador.descripcion)
  _.map(fumigador.servicios,(servicio)=>{
    $("#accordionServiciosFumigador").append(`
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#servicio-${servicio.idServicio}" aria-expanded="false" aria-controls="servicio-${servicio.idServicio}">
          <img src="${servicio.fotoServicio}" alt="servicio fumigador">
          <span>${servicio.nombre}</span>
        </button>
      </h2>
      <div id="servicio-${servicio.idServicio}" class="accordion-collapse collapse" data-bs-parent="#accordionServiciosFumigador">
        <div class="accordion-body">${servicio.descripcion}</div>
      </div>
    </div>
    `)
  })
}