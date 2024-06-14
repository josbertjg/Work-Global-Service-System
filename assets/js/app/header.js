$(document).ready(async ()=>{
  let mapDropdownHeader = null
  let showMap = false;
  let selectedPlace = null;

  // Header dropdown
  if(!!document.getElementById("map-toggle")){

    mapDropdownHeader = new bootstrap.Dropdown(document.getElementById("map-toggle"))

    // Getting place stored on localstorage
    let placeStored = {};
    if(!_.isEmpty(localStorage.getItem("selectedPlace"))){
      try{
        placeStored = JSON.parse(localStorage.getItem("selectedPlace"));
      }catch(e){
        console.log(e)
      }
    }

    if(!_.isEmpty(placeStored)){
      selectedPlace = placeStored 
      showMap = true;
    }else{
      selectedPlace = {} 
    }
    /* HEADER MAP */
    const center = {
      // lat: countryPlace.results[0].geometry.location.lat(),
      // lng: countryPlace.results[0].geometry.location.lng()
  
      /* Coords of Barquisimeto */
      lat: !_.isEmpty(selectedPlace) ? selectedPlace.lat : 10.0677719,
      lng: !_.isEmpty(selectedPlace) ? selectedPlace.lng : -69.3473509
    }
  
    // INIT MAP
    const mapHeader = new google.maps.Map(document.getElementById('header-map'),{
      center: center,
      zoom: 13
    })
  
    // INIT AUTOCOMPLETE
    const headerSearchInput = document.getElementById('searchHeaderPlaceField');
    const autocompleteHeader = new google.maps.places.Autocomplete(headerSearchInput,{
      componentRestrictions: { country: 've' }
    });
  
    autocompleteHeader.bindTo('bounds', mapHeader)

    // Setting the place value stored on localstorage to the autocomplete
    if(!_.isEmpty(selectedPlace)){
      $("#searchHeaderPlaceField").val(selectedPlace.formatted_address)
    }
  
    // INIT MARKER
    const markerHeader = new google.maps.Marker({
      map: mapHeader
    })
  
    // PLACE CHANGED BY AUTOCOMPLETE SO MARKER IS SETTED
    autocompleteHeader.addListener('place_changed', ()=>{
      toggleLoading(true);
      const place = autocompleteHeader.getPlace();
      
      let cityObj = place.address_components.filter((component) => component.types.includes('locality'))[0];
      const city = cityObj.short_name;
      
      let  stateObj = place.address_components.filter((component) => component.types.includes('administrative_area_level_1'))[0];
      const state = stateObj.short_name;
      
      let countryObj = place.address_components.filter((component) => component.types.includes('country'))[0];
      const country = countryObj.long_name;
      
      console.log(`Ciudad: ${city}, Estado: ${state}, País: ${country}`)
      if(place.geometry.viewport) mapHeader.fitBounds(place.geometry.viewport)
      else{
        mapHeader.setCenter(place.geometry.location);
        mapHeader.setZoom(10);
      }
      markerHeader.setPosition(place.geometry.location);
      markerHeader.setVisible(true)
      mapDropdownHeader.show()
      showMap = true;
      selectedPlace = {
        ...place, 
        lng: place.geometry.location.lng(), 
        lat: place.geometry.location.lat()
      }
      toggleLoading(false);
    })
  
    // CLICK EVENT ON MAP
    mapHeader.addListener('click', async (event) => {
      toggleLoading(true);
      mapHeader.setCenter(event.latLng);
      markerHeader.setPosition(event.latLng);
      markerHeader.setVisible(true)
      
      const { results } = await geocoder.getPlaceByCoords(event.latLng)
  
      let cityObj = results[0].address_components.filter((component) => component.types.includes('locality'))[0];
      const city = cityObj.short_name ? cityObj.short_name : cityObj.long_name;
  
      let  stateObj = results[0].address_components.filter((component) => component.types.includes('administrative_area_level_1'))[0];
      const state = stateObj.short_name ? stateObj.short_name : stateObj.long_name;
  
      let countryObj = results[0].address_components.filter((component) => component.types.includes('country'))[0];
      const country = countryObj.long_name ? countryObj.long_name : countryObj.short_name;
  
      console.log(`Ciudad: ${city}, Estado: ${state}, País: ${country}`)
      
      headerSearchInput.value = results[0].formatted_address;

      selectedPlace = {
        ...results[0], 
        lng: results[0].geometry.location.lng(), 
        lat: results[0].geometry.location.lat()
      }
      toggleLoading(false);
    })
  
    // Pedir permisos de ubicacion del usuario
    $(".useUserLocation").click(() => {
      if (!!navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(async (position) => {
          const LatLng = {lat: position.coords.latitude, lng: position.coords.longitude}
  
          mapHeader.setCenter(LatLng);
          markerHeader.setPosition(LatLng);
          markerHeader.setVisible(true)
          
          const { results } = await geocoder.getPlaceByCoords(LatLng)
  
          let cityObj = results[0].address_components.filter((component) => component.types.includes('locality'))[0];
          const city = cityObj.short_name ? cityObj.short_name : cityObj.long_name;
  
          let  stateObj = results[0].address_components.filter((component) => component.types.includes('administrative_area_level_1'))[0];
          const state = stateObj.short_name ? stateObj.short_name : stateObj.long_name;
  
          let countryObj = results[0].address_components.filter((component) => component.types.includes('country'))[0];
          const country = countryObj.long_name ? countryObj.long_name : countryObj.short_name;
  
          console.log(results[0])
          console.log(`Ciudad: ${city}, Estado: ${state}, País: ${country}`)
          
          headerSearchInput.value = results[0].formatted_address;
        });
      }
    });
  }

  /* /HEADER MAP */

  // Servicios
  if(!!document.getElementById("serviciosAutocomplete")){

    const respuesta = await service.post("servicios",{getAllServicios:true})
    const availableServices = _.map(respuesta,(servicio)=>({id: servicio.idServicio, text: servicio.nombre}));
    let servicesStored = [];
    if(!_.isEmpty(localStorage.getItem("selectedServices"))){
      try{
        servicesStored = JSON.parse(localStorage.getItem("selectedServices"))
      }catch(e){
        console.log(e)
      }
    }

    let selectedServices = !_.isEmpty(servicesStored) ? servicesStored : [] 

    $('#serviciosAutocomplete').select2({
      placeholder: 'Servicios',
      data: _.isEmpty(selectedServices) ? 
          availableServices 
        : 
          _.map(availableServices,(servicio)=>{
            if(selectedServices.includes(servicio.id)) return { ...servicio, selected: true }
            return servicio
          })
    });

    $('#serviciosAutocomplete').on('select2:select', function (e) {
      selectedServices.push(e.params.data.id)
    });

    $('#serviciosAutocomplete').on('select2:unselect', function (e) {
      selectedServices.splice(selectedServices.indexOf(e.params.data.id),1)
    });


    // let selectedServices = [];
    // let servicesMenuHovered = false;
    // let servicesInputBlur = false;
    // const servicesDropdown = new bootstrap.Dropdown(document.getElementById("services-toggle"))

    // Services Autocomplete
    // $( "#servicios" ).autocomplete({
    //   source: availableServices,
    //   select: (e, ui)=>{
    //     e.preventDefault();
        
    //     if(!_.find(selectedServices,(item)=> ui.item.label == item.label)){
    //       selectedServices.push(ui.item)
    //       $(".services-dropdown-body").append(`
    //         <span class="badge rounded-pill bg-dark me-1" service="${ui.item.label}">
    //           ${ui.item.label}
    //           <i class="fa-solid fa-x btn-delete-service"></i>
    //         </span>`)
    //     }
    //     if(selectedServices.length == 0) {
    //       $(".no-services").show();
    //       $(".badge-services-count").hide();
    //     }else{
    //       $(".no-services").hide();
    //     }
    //     servicesDropdown.show();
    //     $( "#servicios" ).val("");
    //     $(".badge-services-count").show()
    //     $(".badge-count-number").text(selectedServices.length)
  
    //   }
    // });
  
    // // Services Dropdown
    // $( "#servicios" ).click(()=> {   
    //   // Searching on autocomplete
    //   $( "#servicios" ).autocomplete( "search" )
      
    //   servicesInputBlur = false;
    //   if(!_.isEmpty(selectedServices)){
    //     servicesDropdown.show();
    //   }
    // });
    
    // $( "#servicios" ).blur(()=> {
    //   if(!servicesMenuHovered){ 
    //     servicesDropdown.hide();
    //     servicesMenuHovered = false;
    //   }
    //   servicesInputBlur = true;
    // });
  
    // $(".services-dropdown-menu").click(()=>{
    //   servicesDropdown.show();
    //   servicesInputBlur = true;
    // })
  
    // $(".services-dropdown-menu").mousemove(()=>{
    //   servicesMenuHovered = true;
    // })
  
    // $(".services-dropdown-menu").mouseleave(()=>{
    //   if(servicesInputBlur){
    //     servicesDropdown.hide();
    //   }
    //   servicesMenuHovered = false;
    // })
  
    // $(".services-dropdown-body").click((e)=>{
    //   if($(e.target).hasClass("btn-delete-service")){
    //     const service = $($(e.target).parent()[0]).attr("service");
    //     selectedServices = selectedServices.filter((item)=>item.label != service)
    //     $(".badge-count-number").text(selectedServices.length)
    //     $($(e.target).parent()[0]).remove();
    //     if(selectedServices.length == 0) {
    //       $(".badge-services-count").hide();
    //       $(".no-services").show();
    //     }
    //   }
    // })
    
  
    // Google Maps Dropdown
    $("#searchHeaderPlaceField").click(()=>{
      if(showMap){ 
        mapDropdownHeader.show()
      }
    })
  
    $(".close-map-btn").click(()=>{
      mapDropdownHeader.hide()
    })
  
    $(".back-map-btn").click(()=>{
      mapDropdownHeader.hide()
      showMap = false;
  
      let textArray = Array.from($("#searchHeaderPlaceField").val())
      let lastLetter = textArray.pop();
      $("#searchHeaderPlaceField").val(textArray.join(""))
      $("#searchHeaderPlaceField").trigger("focus")
      textArray.push(lastLetter)
      $("#searchHeaderPlaceField").val(textArray.join(""))
    })

    // Buscar fumigadores
    const searchPlacesInputTooltip = new bootstrap.Tooltip('#searchInputFloatingContainer', {trigger: "manual"})
    $("#searchInputFloatingContainer").hover(()=>{
      searchPlacesInputTooltip.hide();
    })

    $(".btn-buscar").click(()=>{
      // No se ha seleccionado ninguna ubicacion
      if(_.isEmpty(selectedPlace)) searchPlacesInputTooltip.show();

      // No se ha seleccionado ningun servicio
      if(_.isEmpty(selectedServices)) return servicesTooltip.show();

      // User no logueado
      if(_.isEmpty(localStorage.getItem("user"))){
        accederModal.show();
        const form = $("#iniciarSesion-form");
        return showFormAlerts(form,"Debes iniciar sesión para poder realizar la búsqueda de fumigadores.");
      }

      if(!_.isEmpty(selectedPlace) && !_.selectedServices){
        localStorage.setItem("selectedPlace",    JSON.stringify(selectedPlace));
        localStorage.setItem("selectedServices", JSON.stringify(selectedServices));

        if(window.location.pathname != "fumigadores" && window.location.pathname != "/fumigadores") return window.location = "fumigadores";

        renderFumigadores(selectedServices);
      }
    })

    // Confirmar Direccion para buscar fumigadores
    const servicesTooltip = new bootstrap.Tooltip('#servicios-autocomplete-container', {trigger: "manual"})
    $("#servicios-autocomplete-container").hover(()=>{
      servicesTooltip.hide();
    })

    $(".confirm-address").click(()=>{
      // No se ha seleccionado ningún servicio
      if(_.isEmpty(selectedServices)) return servicesTooltip.show();

      // User no logueado
      if(_.isEmpty(localStorage.getItem("user"))){
        accederModal.show();
        const form = $("#iniciarSesion-form");
        return showFormAlerts(form,"Debes iniciar sesión para poder realizar la búsqueda de fumigadores.");
      }

      localStorage.setItem("selectedPlace",    JSON.stringify(selectedPlace));
      localStorage.setItem("selectedServices", JSON.stringify(selectedServices));

      if(window.location.pathname != "fumigadores" && window.location.pathname != "/fumigadores") return window.location = "fumigadores"

      renderFumigadores(selectedServices)
    })

  }

  // Alerts Dropdown
  const alertsDropdown = new bootstrap.Dropdown(document.getElementById("alerts-toggle"))
  let showAlerts = true;

  $("#alerts-toggle").click(()=>{
    if(showAlerts){
      alertsDropdown.show()
      showAlerts = false;
    }else{
      alertsDropdown.hide()
      showAlerts = true;
    }
  })

  $(".close-alerts").click(()=>{
    alertsDropdown.hide()
    showAlerts = true;
  })


  // Acceder modal Tabs
  const iniciarSesionTab = new bootstrap.Tab(document.getElementById("iniciar-sesion-tab"))
  const selectUserTab    = new bootstrap.Tab(document.getElementById("select-user-type-tab"))
  const crearCuentaTab   = new bootstrap.Tab(document.getElementById("crear-cuenta-tab"))

  $(".goToIniciarSesion").click(()=>{
    iniciarSesionTab.show();
  })
  $(".goToSeleccionarUser").click(()=>{
    selectUserTab.show();
  })
  $(".goToCrearCuenta").click(()=>{
    crearCuentaTab.show();
  })
  $(document).on('click','.iniciarSesion-btn', () => iniciarSesionTab.show());
  $(document).on('click','.crearCuenta-btn',   () => selectUserTab.show());

  // Modal para acceder
  const accederModal = new bootstrap.Modal(document.getElementById('acceder-modal'))

  $(document).on('click','.iniciarSesion-footer-btn', () => {
    accederModal.show();
    iniciarSesionTab.show();
  });
  $(document).on('click','.crearCuenta-footer-btn',   () => {
    accederModal.show();
    selectUserTab.show();
  });

  // Form Login
  validarContraseña($("#iniciarSesionUserPassword"));
  validarCorreo($("#iniciarSesionUserEmail"));

  $("#iniciarSesion-form").on("submit",async (event)=>{
    event.preventDefault();
    const form = $("#iniciarSesion-form");

    const formValid = checkFormValidity(form)
    
    if(formValid){
      const formHTML = document.getElementById("iniciarSesion-form")
      const data = new FormData(formHTML)

      data.append("account_password_login",JSON.stringify(true))

      toggleLoading(true);
      const respuesta = await service.post("oauth",data)
      toggleLoading(false);

      if("error" in respuesta){
        console.log(respuesta)
        showFormAlerts(form,respuesta.error);
        blankForm(form);
      }else{
        accederModal.hide();
        loginUser(respuesta);
      }
    }
  })

  // Form Crear Cuenta
  validarNombre($("#crearCuentaUserNombre"));
  validarNombre($("#crearCuentaUserApellido"));
  validarCorreo($("#crearCuentaUserEmail"));
  validarContraseña($("#crearCuentaUserPassword"));
  validarConfirmarContraseña($("#crearCuentaUserConfirmPassword"),$("#crearCuentaUserPassword"));

  $("#crearCuenta-form").on("submit",async (event)=>{
    event.preventDefault();
    const form = $("#crearCuenta-form");

    const formValid = checkFormValidity(form)
    
    if(formValid){
      const formHTML = document.getElementById("crearCuenta-form")
      const data = new FormData(formHTML)

      data.append("account_password_register",JSON.stringify(true))
      const respuesta = await service.post("oauth",data)
      
      if("error" in respuesta){
        showFormAlerts(form,respuesta.error);
        blankForm(form);
      }else{
        iniciarSesionTab.show();
        Toast.fire({
          icon: "success",
          title: respuesta.success
        });
      }
    }
  })

  // Logout
  $(document).on('click','.logout', () => logoutUser());
})

async function renderFumigadores(selectedServices){
  toggleLoading(true);
  $(".fumigadores-list-container").empty()
  const fumigadores = await service.post("fumigadores",{getFumigadoresByServices: true, servicios: selectedServices})
  // Renderizando los fumigadores obtenidos
  if(!_.isEmpty(fumigadores)){
    _.map(fumigadores,(fumigador)=>{
      const dias  = moment().diff(moment(fumigador.fechaValidado), 'days');
      const meses = moment().diff(moment(fumigador.fechaValidado), 'months');
      const años  = moment().diff(moment(fumigador.fechaValidado), 'years');
      $(".fumigadores-list-container").append(`
        <a href="realizarorden?fumigador=${fumigador.cedula}" class="fumigador-item-container" fumigadorID="${fumigador.cedula}">
          <div class="fumigador-img-container">
            <img src="${fumigador.fotoPerfil}" alt="fumigador">
          </div>
          <div class="fumigador-info-container">
            <div class="header mb-2">
              <h1 class="nombre">
                ${fumigador.nombre+" "+fumigador.apellido}
                <i class="fa-solid fa-circle-check"></i>
              </h1>
              <img src="assets/img/fumigador.svg" alt="">
            </div>
            <div class="body mb-2">
              <div class="info-general">
                <span>${
                  años <= 0 ?
                    meses <= 0 ? 
                      dias > 1 ? dias+" días" : dias+" día"
                    :
                      meses > 1 ? meses+" meses" : meses+" mes"
                  :
                    años > 1 ? años+" años" : años+" año"
                } en Work Global Service</span>
              </div>
            </div>
            <div class="footer">
              <p class="descripcion mb-2">${fumigador.descripcion}</p>
              <div class="servicios">
                <ul class="servicios-list fumigador-${fumigador.cedula}"></ul>
              </div>
            </div>
          </div>
        </a>
      `)
         
      _.map(fumigador.servicios,(servicio)=>{
        $(`.fumigador-${fumigador.cedula}`).append(`<img src="${servicio.fotoServicio}" alt=""></img>`)
      })
    })
  }else{
    $(".fumigadores-list-container").append(`
      <div class="no-fumigadores-found">
        <p>No se encontraron fumigadores <i class="fa-regular fa-face-sad-cry"></i>, inténtalo con otras categorías.</p>
      </div>`)
  }
  toggleLoading(false);
}