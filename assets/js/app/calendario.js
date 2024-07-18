$(document).ready(async ()=>{

  toggleLoading(true);
  const disponibilidad = await service.post("calendario",{getUserCalendar: true})
  toggleLoading(false);

  const diasDeSemana = [
    {id: 1, text: "Lunes"},
    {id: 2, text: "Martes"},
    {id: 3, text: "Miercoles"},
    {id: 4, text: "Jueves"},
    {id: 5, text: "Viernes"},
    {id: 6, text: "Sábado"},
    {id: 0, text: "Domingo"},
  ]

  // Dia inicio
  $('#calendarioDiaInicio').select2({
    placeholder: 'Dia inicio',
    data: _.map(diasDeSemana,(item)=>({...item, selected: item.id == disponibilidad.calendario.diaInicio}))
  });

  // Dia Fin
  $('#calendarioDiaFin').select2({
    placeholder: 'Dia Fin',
    data: _.map(diasDeSemana,(item)=>({...item, selected: item.id == disponibilidad.calendario.diaFin}))
  });

  // Hora Inicio
  let horaInicio = disponibilidad.calendario.inicioHora.split(":")
  horaInicio.pop();
  horaInicio = horaInicio.join(":")
  $("#calendarioHoraInicio").val(horaInicio);


  //Hora Fin
  let horaFin = disponibilidad.calendario.finHora.split(":")
  horaFin.pop();
  horaFin = horaFin.join(":")
  $("#calendarioHoraFin").val(horaFin);

  // Días Recurrentes
  let diasRecurrentes = _.map(_.filter(disponibilidad.excepciones,(item)=>(item.recurrente == "1")),(item)=>({dia: item.dia, recurrente: item.recurrente}));
  if(_.isEmpty(diasRecurrentes)) $("#dias-recurrentes-list, #recurrentes-added-list").append('<span class="no-results">Ninguno, me gusta trabajar <i class="fa-solid fa-face-laugh-beam"></i></span>');
  else{
    _.map(diasRecurrentes,(dia)=>{
      const diaNombre = _.find(diasDeSemana,(item)=>item.id == dia.dia).text
      $("#dias-recurrentes-list, #recurrentes-added-list").append(`
        <li class="dia-item recurrente-${dia.dia}">
          <span>- Todos los días ${diaNombre}</span>
            <i class="btn bg-danger btn-danger p-2 fa-solid fa-trash delete-dia-recurrente ms-2" diaId="${dia.dia}"></i>
        </li>
      `)
    })
  }

  // Días Específicos
  let diasEspecificos = _.map(_.filter(disponibilidad.excepciones,(item)=>(item.recurrente == "0")),(item)=>({fecha: item.fecha, recurrente: item.recurrente}));
  if(_.isEmpty(diasEspecificos)) $("#dias-especificos-list, #especificos-added-list").append('<span class="no-results">Ninguno, me gusta trabajar <i class="fa-solid fa-face-laugh-beam"></i></span>');
  else{
    _.map(diasEspecificos,(dia)=>{
      $("#dias-especificos-list, #especificos-added-list").append(`
        <li class="dia-item especifico-${dia.fecha}">
          <span>- El ${formatDate(dia.fecha)} (${dia.fecha})</span>
          <i class="btn bg-danger btn-danger p-2 fa-solid fa-trash delete-dia-especifico ms-2" diaId="${dia.fecha}"></i>
        </li>
      `)
    })
  }

  // Añadir Recurrente
  $('#calendarioAddDiaRecurrente').select2({
    placeholder: 'Añadir dia Recurrente',
    data: diasDeSemana
  });

  $(".add-dia-recurrente").click(()=>{
    if(_.isEmpty(diasRecurrentes)) $("#dias-recurrentes-list, #recurrentes-added-list").empty();

    const diaEncontrado = _.find(diasRecurrentes,(dia)=>(dia.dia == $('#calendarioAddDiaRecurrente').val()))

    if(!_.isEmpty(diaEncontrado)) return Toast.fire({icon: "error", title: "Ya añadiste este día a la lista."});

    diasRecurrentes.push({dia: $('#calendarioAddDiaRecurrente').val()})
    const diaNombre = _.find(diasDeSemana,(item)=>item.id == $('#calendarioAddDiaRecurrente').val()).text
    $("#dias-recurrentes-list, #recurrentes-added-list").append(`
      <li class="dia-item">
        <span>- Todos los días ${diaNombre}</span>
        <button type="button" class="btn bg-danger btn-danger py-1 px-2">
          <i class="fa-solid fa-trash delete-dia-noLaborable" diaId="${$('#calendarioAddDiaRecurrente').val()}"></i>
        </button>
      </li>
    `)
    Toast.fire({icon: "success", title: "Fecha añadida, cierra el modal y presiona guardar para salvar tus datos."});
  })

  // Añadir Especifico
  $("#calendarioAddDiaEspecifico").flatpickr({
    "locale": {
      "firstDayOfWeek": 1 // start week on Monday
    },
    minDate: "today",
  });

  $(".add-dia-especifico").click(()=>{
    if(_.isEmpty($('#calendarioAddDiaEspecifico').val())) return Toast.fire({icon: "error", title: "La fecha no es válida, termina de rellenar el campo y vuelve a intentarlo."});

    if(_.isEmpty(diasEspecificos)) $("#dias-especificos-list, #especificos-added-list").empty();

    const diaEncontrado = _.find(diasEspecificos,(dia)=>(dia.fecha == $('#calendarioAddDiaEspecifico').val()))

    if(!_.isEmpty(diaEncontrado)) return Toast.fire({icon: "error", title: "Ya añadiste este día a la lista."});
    
    diasEspecificos.push({fecha: $('#calendarioAddDiaEspecifico').val()})
    $("#dias-especificos-list, #especificos-added-list").append(`
      <li class="dia-item">
        <span>- El ${formatDate($('#calendarioAddDiaEspecifico').val())} (${$('#calendarioAddDiaEspecifico').val()})</span>
        <button type="button" class="btn bg-danger btn-danger py-1 px-2">
          <i class="fa-solid fa-trash delete-dia-noLaborable" diaId="${$('#calendarioAddDiaEspecifico').val()}"></i>
        </button>
      </li>
    `)
    Toast.fire({icon: "success", title: "Fecha añadida, cierra el modal y presiona guardar para salvar tus datos."});
  })

  // Eliminar Recurrente
  $(".delete-dia-recurrente").click((event)=>{
    const diaID = $(event.currentTarget).attr("diaId");
    diasRecurrentes = _.filter(diasRecurrentes, (item)=>(item.dia != diaID));
    $(`.recurrente-${diaID}`).remove();

    if(_.isEmpty(diasRecurrentes)) $("#dias-recurrentes-list, #recurrentes-added-list").append('<span class="no-results">Ninguno, me gusta trabajar <i class="fa-solid fa-face-laugh-beam"></i></span>');
  })

  // Eliminar Recurrente
  $(".delete-dia-especifico").click((event)=>{
    const diaFecha = $(event.currentTarget).attr("diaId");
    diasEspecificos = _.filter(diasEspecificos, (item)=>(item.fecha != diaFecha));
    $(`.especifico-${diaFecha}`).remove();

    if(_.isEmpty(diasEspecificos)) $("#dias-especificos-list, #especificos-added-list").append('<span class="no-results">Ninguno, me gusta trabajar <i class="fa-solid fa-face-laugh-beam"></i></span>');
  })



  /* Formulario */
  required($("#calendarioDiaInicio"));
  required($("#calendarioDiaFin"));
  required($("#calendarioHoraInicio"));
  required($("#calendarioHoraFin"));

  $("#calendario-form").on("submit",async (event)=>{
    event.preventDefault();
    const form = $("#calendario-form");

    const formValid = checkFormValidity(form)
    
    if(formValid){
      
      const formHTML = document.getElementById("calendario-form")
      const data = new FormData(formHTML)
      
      // Validando que la hora de inicio sea menor a la de fin
      const horaInicio = moment(data.get("horaInicio"), 'HH:mm');
      const horaFin = moment(data.get("horaFin"), 'HH:mm');
      
      if(horaFin.isBefore(horaInicio)) return Toast.fire({icon: "error", title: "La hora de inicio no puede ser mayor a la hora de finalizacion laboral."});

      toggleLoading(true)
      
      data.append("updateCalendario",JSON.stringify(true))
      data.append("diasRecurrentes",JSON.stringify(diasRecurrentes))
      data.append("diasEspecificos",JSON.stringify(diasEspecificos))

      const respuesta = await service.post("calendario",data)    
      toggleLoading(false)

      if("error" in respuesta){
        showFormAlerts(form,respuesta.error);
        // blankForm(form);
      }else if("success" in respuesta){
        Toast.fire({icon: "success", title: respuesta.success});
      }
    }
  })
})