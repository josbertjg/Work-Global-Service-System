$(document).ready(async ()=>{

  if(_.isEmpty(localStorage.getItem("selectedServices")) || _.isEmpty(localStorage.getItem("selectedPlace"))) return window.location = "/";

  // Obteniendo los servicios y la ubicacion seleccionadas
  let services = [];
  let place = {};

  try{
    services = JSON.parse(localStorage.getItem("selectedServices"))
    place = JSON.parse(localStorage.getItem("selectedPlace"))
  }catch(e){
    showAlert("error","Error al recuperar la cache",e)
  }

  renderFumigadores(services)

  // $(document).on('click','.fumigador-item-container', (e) => {
  //   localStorage.setItem("selectedFumigador", $(e.currentTarget).attr("fumigadorID"))
  //   window.location = "orden"
  // });

})