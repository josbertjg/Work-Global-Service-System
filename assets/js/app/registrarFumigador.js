$(document).ready(async ()=>{

  let selectedPlace = null;
  let ciudad = null;
  let estado = null;

  toggleLoading(true);
  const ciudades = await service.post("registrarFumigador",{getAllCiudades: true})
  const estados  = await service.post("registrarFumigador",{getAllEstados: true})
  toggleLoading(false);
  if("error" in ciudades) showAlert("error", "Oops, ocurrió un error al recuperar las ciudades", ciudades.error)
  if("error" in estados) showAlert("error", "Oops, ocurrió un error al recuperar los estados", estados.error)

  /* Registro fumigador Form MAP */
  const center = {
    // Coords of Barquisimeto 
    lat: 10.0677719,
    lng: -69.3473509
  }

  // INIT MAP
  const mapRegFumigador = new google.maps.Map(document.getElementById('registrarFumigador-map'),{
    center: center,
    zoom: 13
  })

  // INIT AUTOCOMPLETE
  const regFumigSearchInput = document.getElementById('registrarFumigadorUbicacion');
  const regFumigAutocomplete = new google.maps.places.Autocomplete(regFumigSearchInput,{
    componentRestrictions: { country: 've' }
  });

  regFumigAutocomplete.bindTo('bounds', mapRegFumigador)

  // INIT MARKER
  const markerHeader = new google.maps.Marker({
    map: mapRegFumigador
  })

  // PLACE CHANGED BY AUTOCOMPLETE SO MARKER IS SETTED
  regFumigAutocomplete.addListener('place_changed', ()=>{
    toggleLoading(true);
    estado = null;
    ciudad = null;
    const place = regFumigAutocomplete.getPlace();
    
    let stateObj = place.address_components.filter((component) => component.types.includes('administrative_area_level_1'))[0];
    if(!_.isEmpty(stateObj)){
      estado = _.find(estados, (state)=>state.estado == stateObj.short_name);
    }

    let cityObj = place.address_components.filter((component) => component.types.includes('locality'))[0];
    if(!_.isEmpty(cityObj)){
      ciudad = _.find(ciudades, (city)=>city.ciudad == cityObj.short_name);
      if(_.isEmpty(estado) && !_.isEmpty(ciudad)) estado = _.find(estados, (state)=>state.id_estado == ciudad.id_estado) 
    }

    if(place.geometry.viewport) mapRegFumigador.fitBounds(place.geometry.viewport)
    else{
      mapRegFumigador.setCenter(place.geometry.location);
      mapRegFumigador.setZoom(10);
    }
    markerHeader.setPosition(place.geometry.location);
    markerHeader.setVisible(true)

    selectedPlace = {
      direccion: place.formatted_address,
      lng: place.geometry.location.lng(), 
      lat: place.geometry.location.lat(),
      estado: (!_.isEmpty(estado)) ? estado.estado : null,
      ciudad: (!_.isEmpty(ciudad)) ? ciudad.ciudad : null,
    }

    // Haciendo aparecer el mapa con los selects
    $(".regFumig-map-wrapper").css({display: "flex"});

    // Creando dinamicamente las opciones del select de ciudades segun el estado
    if(!_.isEmpty(estado) || !_.isEmpty(ciudad)){
      ciudadesAutocomplete.empty().trigger('change');
      let citiesList = [];

      if(!_.isEmpty(estado)) citiesList = _.filter(ciudades,(ciudad)=>(ciudad.id_estado == estado.id_estado));
      else citiesList = _.filter(ciudades,(ciudad)=>(ciudad.id_estado == ciudad.id_estado))

      _.map(citiesList,(city)=>{
        let newCity = new Option(city.ciudad, city.id_ciudad, false, false);
        ciudadesAutocomplete.append(newCity).trigger('change');
      })
    }
    
    // Seleccionando o no el estado o la ciudad devuelta por google
    estadosAutocomplete.val(null).trigger('change');
    ciudadesAutocomplete.val(null).trigger('change');
    
    if(!_.isEmpty(estado)){
      estadosAutocomplete.val([estado.id_estado]).trigger('change');
      estadosAutocomplete.prop('disabled', true).trigger('change');
    }else{
      estadosAutocomplete.prop('disabled', false).trigger('change');
    }
      
    if(!_.isEmpty(ciudad)){
      ciudadesAutocomplete.val([ciudad.id_ciudad]).trigger('change');
      ciudadesAutocomplete.prop('disabled', true).trigger('change');
    }else{
      ciudadesAutocomplete.prop('disabled', false).trigger('change');
    }

    toggleLoading(false);
  })

  // CLICK EVENT ON MAP
  mapRegFumigador.addListener('click', async (event) => {
    toggleLoading(true);
    estado = null;
    ciudad = null;
    ciudadesAutocomplete.empty().trigger('change');
    mapRegFumigador.setCenter(event.latLng);
    markerHeader.setPosition(event.latLng);
    markerHeader.setVisible(true)
    
    const { results } = await geocoder.getPlaceByCoords(event.latLng)

    let stateObj = results[0].address_components.filter((component) => component.types.includes('administrative_area_level_1'))[0];
    if(!_.isEmpty(stateObj)){
      estado = _.find(estados, (state)=>state.estado == stateObj.short_name);
    }

    let cityObj = results[0].address_components.filter((component) => component.types.includes('locality'))[0];
    if(!_.isEmpty(cityObj)){
      ciudad = _.find(ciudades, (city)=>city.ciudad == cityObj.short_name);
      if(_.isEmpty(estado) && !_.isEmpty(ciudad)) estado = _.find(estados, (state)=>state.id_estado == ciudad.id_estado) 
    }
   
    regFumigSearchInput.value = results[0].formatted_address;

    selectedPlace = {
      direccion: results[0].formatted_address,
      lng: results[0].geometry.location.lng(), 
      lat: results[0].geometry.location.lat(),
      estado: (!_.isEmpty(estado)) ? estado.estado : null,
      ciudad: (!_.isEmpty(ciudad)) ? ciudad.ciudad : null,
    }

    // Haciendo aparecer el mapa con los selects
    $(".regFumig-map-wrapper").css({display: "flex"});

    // Creando dinamicamente las opciones del select de ciudades segun el estado
    if(!_.isEmpty(estado) || !_.isEmpty(ciudad)){
      ciudadesAutocomplete.empty().trigger('change');
      let citiesList = [];

      if(!_.isEmpty(estado)) citiesList = _.filter(ciudades,(ciudad)=>(ciudad.id_estado == estado.id_estado));
      else citiesList = _.filter(ciudades,(ciudad)=>(ciudad.id_estado == ciudad.id_estado))

      _.map(citiesList,(city)=>{
        let newCity = new Option(city.ciudad, city.id_ciudad, false, false);
        ciudadesAutocomplete.append(newCity).trigger('change');
      })
    }
    
    // Seleccionando o no el estado o la ciudad devuelta por google
    estadosAutocomplete.val(null).trigger('change');
    ciudadesAutocomplete.val(null).trigger('change');
    
    if(!_.isEmpty(estado)){
      estadosAutocomplete.val([estado.id_estado]).trigger('change');
      estadosAutocomplete.prop('disabled', true).trigger('change');
    }else{
      estadosAutocomplete.prop('disabled', false).trigger('change');
    }
      
    if(!_.isEmpty(ciudad)){
      ciudadesAutocomplete.val([ciudad.id_ciudad]).trigger('change');
      ciudadesAutocomplete.prop('disabled', true).trigger('change');
    }else{
      ciudadesAutocomplete.prop('disabled', false).trigger('change');
    }

    toggleLoading(false);
  })

  // Autocompletes
  const estadosAutocomplete = $('#registrarFumigadorEstado').select2({
    placeholder: 'Estado:',
    data: _.map(estados,(estado)=>({id: estado.id_estado, text: estado.estado})),
  });

  const ciudadesAutocomplete = $('#registrarFumigadorCiudad').select2({
    placeholder: 'Ciudad:',
  });

  // On select Events
  estadosAutocomplete.on('select2:select', function (e) {
    estado = _.find(estados,(estado)=>(estado.id_estado == e.params.data.id));
    ciudadesAutocomplete.val(null).trigger('change');
    ciudadesAutocomplete.empty().trigger('change');

    let citiesList = _.filter(ciudades,(ciudad)=>(ciudad.id_estado == estado.id_estado));

    _.map(citiesList,(city)=>{
      let newCity = new Option(city.ciudad, city.id_ciudad, false, false);
      ciudadesAutocomplete.append(newCity).trigger('change');
    })

    ciudadesAutocomplete.val(null).trigger('change');

  })

  ciudadesAutocomplete.on('select2:select', function (e) {
    ciudad = _.find(ciudad,(ciudad)=>(ciudad.id_ciudad == e.params.data.id));
  })

  // Date picker fecha de nacimiento
  const datePicker = $("#registrarFumigadorNacimiento").flatpickr({
    "locale": {
      "firstDayOfWeek": 1 // start week on Monday
    },
    // Deshabilitando fechas posteriores a 5 años atras
    maxDate: moment().subtract(17, 'years').format('YYYY-MM-DD'),
    onChange: function(selectedDates, dateStr, instance) {
      selectedDate = dateStr;
      if(!_.isEmpty(selectedHour)){
        selectedDateTime = `${selectedDate} ${selectedHour}`;
        setDateTime(selectedDate,selectedHour)
      }
    }
  });

  // Form Registrar fumigador
  validarCedula($("#registrarFumigadorCedula"),8);
  validarFile($("#registrarFumigadorImagenCedula"));
  required($("#registrarFumigadorUbicacion"));
  required($("#registrarFumigadorEstado"));
  required($("#registrarFumigadorCiudad"));
  validarDescripcion($("#registrarFumigadorDescripcion"),1255);
  validarTelefono($("#registrarFumigadorTelefono"));
  required($("#registrarFumigadorNacimiento"));

  $("#registrarFumigador-form").on("submit",async (event)=>{
    event.preventDefault();
    const form = $("#registrarFumigador-form");

    const formValid = checkFormValidity(form)

    if(formValid){
      toggleLoading(true)

      let user = null;

      try{
        user = JSON.parse(localStorage.getItem("user"));
      }catch(e){
        showAlert("error", "Oops, ocurrió un error", "Error al recuperar el usuario logueado")
        return setTimeout(() => window.location = "registrarFumigador", 4000);
      }

      const formHTML = document.getElementById("registrarFumigador-form")
      const data = new FormData(formHTML)
      
      console.log(data.get("fechaNacimiento"), user)
      data.append("registerNewFumigador",JSON.stringify(true))
      data.append("userID",JSON.stringify(user.clientID))

      const respuesta = await service.post("registrarFumigador",data)    
      toggleLoading(false)

      console.log(respuesta);
      
      // if("error" in respuesta){
      //   showFormAlerts(form,respuesta.error);
      //   blankForm(form);
      // }else{
      //   iniciarSesionTab.show();
      //   Toast.fire({
      //     icon: "success",
      //     title: respuesta.success
      //   });
      // }
    }
  })
  
})

// Pedir permisos de ubicacion del usuario
// $(".useUserLocation").click(() => {
//   if (!!navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(async (position) => {
//       const LatLng = {lat: position.coords.latitude, lng: position.coords.longitude}

//       mapRegFumigador.setCenter(LatLng);
//       markerHeader.setPosition(LatLng);
//       markerHeader.setVisible(true)
      
//       const { results } = await geocoder.getPlaceByCoords(LatLng)

//       let cityObj = results[0].address_components.filter((component) => component.types.includes('locality'))[0];
//       const city = cityObj.short_name ? cityObj.short_name : cityObj.long_name;

//       let  stateObj = results[0].address_components.filter((component) => component.types.includes('administrative_area_level_1'))[0];
//       const state = stateObj.short_name ? stateObj.short_name : stateObj.long_name;

//       let countryObj = results[0].address_components.filter((component) => component.types.includes('country'))[0];
//       const country = countryObj.long_name ? countryObj.long_name : countryObj.short_name;

//       console.log(results[0])
//       console.log(`Ciudad: ${city}, Estado: ${state}, País: ${country}`)
      
//       regFumigSearchInput.value = results[0].formatted_address;
//     });
//   }
// });
