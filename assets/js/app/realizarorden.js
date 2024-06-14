$(document).ready(async ()=>{
  // Obteniendo el id del fumigador pasado por get en la URL
  const urlParams = new URLSearchParams(window.location.search);
  const fumigadorID = urlParams.get('fumigador');

  toggleLoading(true)
  const currentFumigador = await service.post("realizarorden",{getCurrentFumigador: true, fumigadorID: fumigadorID});
  const establecimientos = await service.post("realizarorden", {getAllEstablecimientos: true});
  const preciosServicios = await service.post("realizarorden", {getAllPreciosServicios: true});
  let   user             = null;
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
  const dias  = moment().diff(moment(currentFumigador.fechaValidado), 'days');
  const meses = moment().diff(moment(currentFumigador.fechaValidado), 'months');
  const años  = moment().diff(moment(currentFumigador.fechaValidado), 'years');
  $(".info-fumigador-container .presentation-card .header .fotoPerfil").attr("src",currentFumigador.fotoPerfil)
  $(".info-fumigador-container .presentation-card .header .nombre").text(`${currentFumigador.nombre} ${currentFumigador.apellido}`)
  $(".info-fumigador-container .presentation-card .header .nombre").text(`${currentFumigador.nombre} ${currentFumigador.apellido}`)
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
  $(".fumigador-info-section .descripcion").text(currentFumigador.descripcion)
  _.map(currentFumigador.servicios,(servicio)=>{
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
 
  // Orden Tabs
  const serviciosTab      = new bootstrap.Tab(document.getElementById("pills-choose-servicios-tab"))
  const disponibilidadTab = new bootstrap.Tab(document.getElementById("pills-choose-disponibilidad-tab"))
  const detallesOrdenTabs = new bootstrap.Tab(document.getElementById("pills-validar-orden-tab"))

  // Servicios Tab
  let selectedService = null;
  let selectedEstablecimiento = null;
  let selectedPrecioServicio = null;
  let precioServiciosArray = [];

  $('#ordenServiciosAutocomplete').select2({
    placeholder: 'Plaga',
    data: _.map(currentFumigador.servicios,(servicio)=>({id: servicio.idServicio, text: servicio.nombre}))
  });

  $('#ordenEstablecimientosAutocomplete').select2({
    placeholder: 'Lugar',
    data: _.map(establecimientos,(establecimiento)=>({id: establecimiento.idEstablecimientos, text: establecimiento.nombre}))
  });

  // Clearing all selections
  $('#ordenServiciosAutocomplete').val(null).trigger('change');
  $('#ordenEstablecimientosAutocomplete').val(null).trigger('change');

  // Eventos de los selects
  $('#ordenServiciosAutocomplete').on('select2:select', function (e) {
    selectedService = _.find(currentFumigador.servicios,(servicio)=>(servicio.idServicio === e.params.data.id));
    
    if(!_.isEmpty(selectedEstablecimiento)){
      selectedPrecioServicio = _.find(preciosServicios,(item)=>(item.servicio === selectedService.idServicio && item.establecimiento === selectedEstablecimiento.idEstablecimientos))
      if(!_.isEmpty(selectedPrecioServicio)){
        $(".servicio-selected .service-notfound").html("")
        $(".servicio-selected .title").html(`${selectedService.nombre} <i class="fa-solid fa-plus"></i> ${selectedEstablecimiento.nombre}`)
        $(".servicio-selected .monto").text(`${selectedPrecioServicio.precio}$`)
      }else{
        $(".servicio-selected .title").text("")
        $(".servicio-selected .monto").text("")
        $(".servicio-selected .service-notfound").html('Servicio no disponible o inhabilitado <i class="fa-regular fa-face-sad-cry"></i>')
      }
    }
  });

  $('#ordenEstablecimientosAutocomplete').on('select2:select', function (e) {
    selectedEstablecimiento = _.find(establecimientos,(establecimiento)=>(establecimiento.idEstablecimientos === e.params.data.id));
    
    if(!_.isEmpty(selectedService)){
      selectedPrecioServicio = _.find(preciosServicios,(item)=>(item.servicio === selectedService.idServicio && item.establecimiento === selectedEstablecimiento.idEstablecimientos))
      if(!_.isEmpty(selectedPrecioServicio)){
        $(".servicio-selected .service-notfound").html("")
        $(".servicio-selected .title").html(`${selectedService.nombre} <i class="fa-solid fa-plus"></i> ${selectedEstablecimiento.nombre}`)
        $(".servicio-selected .monto").text(`${selectedPrecioServicio.precio}$`)
      }else{
        $(".servicio-selected .title").text("")
        $(".servicio-selected .monto").text("")
        $(".servicio-selected .service-notfound").html('Servicio no disponible o inhabilitado <i class="fa-regular fa-face-sad-cry"></i>')
      }
    }
  });

  // Añadir un servicio a la orden
  $(".añadir-servicio").click(()=>{
    if(!_.isEmpty(selectedEstablecimiento) && !_.isEmpty(selectedService) && !_.isEmpty(selectedPrecioServicio)){
      if(_.isEmpty(_.find(precioServiciosArray,(item)=>(item.id === selectedPrecioServicio.id)))){
        $(".servicios-seleccionados-container").append(`
          <li class="servicio-selected-item servicio-selected-${selectedPrecioServicio.id}">
            <div class="info-servicio">
              <img src="${selectedService.fotoServicio}" alt="imagen del servicio">
              <span class="nombre">${selectedService.nombre} <i class="fa-solid fa-plus"></i></span>
              <span class="nombre">${selectedEstablecimiento.nombre}</span>
            </div>
            <div class="extra-info">
              <span class="monto">${selectedPrecioServicio.precio}$</span>
              <a class="eliminar-servicio" idPrecioServicio="${selectedPrecioServicio.id}">
                <i class="fa-solid fa-trash"></i>
              </a>
            </div>
          </li>
        `)
  
        precioServiciosArray.push(selectedPrecioServicio);
        selectedService = null;
        selectedEstablecimiento = null;
        selectedPrecioServicio = null;
  
        $(".total-container .monto").empty();
        $(".total-container .monto").text(`${_.sum(_.map(precioServiciosArray,(item)=>parseFloat(item.precio)))}$`);
        $(".orden-details").show();
        $(".servicio-selected .title").text("")
        $(".servicio-selected .monto").text("")
        $(".servicio-selected .service-notfound").html("")
        $(".no-services-selected").text("")
        $('#ordenServiciosAutocomplete').val(null).trigger('change');
        $('#ordenEstablecimientosAutocomplete').val(null).trigger('change');
      }else{
        Toast.fire({
          icon: "info",
          title: "Ya añadiste esta selección a la orden."
        });
      }
    }
  })

  $(document).on('click','.eliminar-servicio', (e) => {
    const idPrecioServicio = $($(e.target).parent()).attr("idPrecioServicio");
    precioServiciosArray = _.filter(precioServiciosArray,(item)=>(item.id != idPrecioServicio))

    $(".total-container .monto").empty();
    $(".total-container .monto").text(`${_.sum(_.map(precioServiciosArray,(item)=>parseFloat(item.precio)))}$`);

    $(`.servicio-selected-${idPrecioServicio}`).remove();
    if(_.isEmpty(precioServiciosArray)) $(".orden-details").hide();
  });

  $(".volver-serviciosTab").click(()=>serviciosTab.show())
  $(".verOrdenDisponibilidad").click(()=>{
    if(_.isEmpty(precioServiciosArray)){
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
    if(!_.isEmpty(selectedDateTime) && !_.isEmpty(precioServiciosArray)){
      // const respuesta = await service.post("realizarorden",{
      //   createOrden:   true,
      //   fumigador:     currentFumigador.cedula,
      //   cliente:       user.email,
      //   fechaServicio: selectedDateTime
      // });
      window.location = "pagarorden";
    }else{
      serviciosTab.show()
      Toast.fire({
        icon: "error",
        title: "Ocurrió un error inesperado, porfavor vuelve a llenar los datos."
      });
    }
  })
})