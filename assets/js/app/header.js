$(document).ready(()=>{
  let mapDropdownHeader = null
  let showMap = false;
  // Header dropdown
  if(!!document.getElementById("map-toggle")){

    mapDropdownHeader = new bootstrap.Dropdown(document.getElementById("map-toggle"))
  
    /* HEADER MAP */
    const center = {
      // lat: countryPlace.results[0].geometry.location.lat(),
      // lng: countryPlace.results[0].geometry.location.lng()
  
      /* Coords of Barquisimeto */
      lat: 10.0677719,
      lng: -69.3473509
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
  
    // INIT MARKER
    const markerHeader = new google.maps.Marker({
      map: mapHeader
    })
  
    // PLACE CHANGED BY AUTOCOMPLETE SO MARKER IS SETTED
    autocompleteHeader.addListener('place_changed', ()=>{
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
    })
  
    // CLICK EVENT ON MAP
    mapHeader.addListener('click', async (event) => {
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
          console.log(cityObj)
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


  if(!!document.getElementById("services-toggle")){

    const availableServices = [
      "Cucarachas",
      "Termitas",
      "Zancudos",
      "Hormigas",
      "Chiripas",
    ];

    let selectedServices = [];
    let servicesMenuHovered = false;
    let servicesInputBlur = false;
    const servicesDropdown = new bootstrap.Dropdown(document.getElementById("services-toggle"))

    // Services Autocomplete
    $( "#servicios" ).autocomplete({
      source: availableServices,
      select: (e, ui)=>{
        e.preventDefault();
        
        if(!_.find(selectedServices,(item)=> ui.item.label == item.label)){
          selectedServices.push(ui.item)
          $(".services-dropdown-body").append(`
            <span class="badge rounded-pill bg-dark me-1" service="${ui.item.label}">
              ${ui.item.label}
              <i class="fa-solid fa-x btn-delete-service"></i>
            </span>`)
        }
        if(selectedServices.length == 0) {
          $(".no-services").show();
          $(".badge-services-count").hide();
        }else{
          $(".no-services").hide();
        }
        servicesDropdown.show();
        $( "#servicios" ).val("");
        $(".badge-services-count").show()
        $(".badge-count-number").text(selectedServices.length)
  
      }
    });
  
    // Services Dropdown
    $( "#servicios" ).click(()=> {   
      // Searching on autocomplete
      $( "#servicios" ).autocomplete( "search" )
      
      servicesInputBlur = false;
      if(!_.isEmpty(selectedServices)){
        servicesDropdown.show();
      }
    });
    
    $( "#servicios" ).blur(()=> {
      if(!servicesMenuHovered){ 
        servicesDropdown.hide();
        servicesMenuHovered = false;
      }
      servicesInputBlur = true;
    });
  
    $(".services-dropdown-menu").click(()=>{
      servicesDropdown.show();
      servicesInputBlur = true;
    })
  
    $(".services-dropdown-menu").mousemove(()=>{
      servicesMenuHovered = true;
    })
  
    $(".services-dropdown-menu").mouseleave(()=>{
      if(servicesInputBlur){
        servicesDropdown.hide();
      }
      servicesMenuHovered = false;
    })
  
    $(".services-dropdown-body").click((e)=>{
      if($(e.target).hasClass("btn-delete-service")){
        const service = $($(e.target).parent()[0]).attr("service");
        selectedServices = selectedServices.filter((item)=>item.label != service)
        $(".badge-count-number").text(selectedServices.length)
        $($(e.target).parent()[0]).remove();
        if(selectedServices.length == 0) {
          $(".badge-services-count").hide();
          $(".no-services").show();
        }
      }
    })
  
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
 
})