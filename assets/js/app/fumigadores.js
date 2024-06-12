$(document).ready(async ()=>{

  if(_.isEmpty(localStorage.getItem("selectedServices")) || _.isEmpty(localStorage.getItem("selectedPlace"))) return window.location = "/";

  // Obteniendo los servicios y la ubicacion seleccionadas
  let services = [];
  let place = {};

  try{
    services = JSON.parse(localStorage.getItem("selectedServices"))
    place = JSON.parse(localStorage.getItem("selectedPlace"))
  }catch(e){
    console.log(e)
  }

  toggleLoading(true);
  const fumigadores = await service.post("fumigadores",{getFumigadoresByServices: true, servicios: services})
  // Renderizando los fumigadores obtenidos
  if(!_.isEmpty(fumigadores)){
    _.map(fumigadores,(fumigador)=>{
      const dias  = moment().diff(moment(fumigador.fechaValidado), 'days');
      const meses = moment().diff(moment(fumigador.fechaValidado), 'months');
      const años  = moment().diff(moment(fumigador.fechaValidado), 'years');
      $(".fumigadores-list-container").append(`
        <article class="fumigador-item-container" fumigadorID="${fumigador.cedula}">
          <div class="fumigador-img-container">
            <img src="${fumigador.fotoPerfil}" alt="fumigador work global service">
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
              <p class="descripcion mb-2">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae reiciendis ut rerum consectetur doloribus, culpa delectus id, suscipit minus molestiae dignissimos earum dolorem quam excepturi corporis optio soluta vitae aut?
              </p>
              <div class="servicios">
                <ul class="servicios-list fumigador-${fumigador.cedula}"></ul>
              </div>
            </div>
          </div>
        </article>
      `)
         
      _.map(fumigador.servicios,(servicio)=>{
        $(`.fumigador-${fumigador.cedula}`).append(`<img src="${servicio.fotoServicio}" alt="${servicio.nombre} fumigacion" ></img>`)
      })
    })
  }else{
    $(".fumigadores-list-container").append(`
      <div class="no-fumigadores-found">
        <p>No se encontraron fumigadores <i class="fa-regular fa-face-sad-cry"></i>, inténtalo con otras categorías.</p>
      </div>`)
  }
  toggleLoading(false);

  $(document).on('click','.fumigador-item-container', (e) => {
    localStorage.setItem("selectedFumigador", $(e.currentTarget).attr("fumigadorID"))
    window.location = "orden"
  });

})