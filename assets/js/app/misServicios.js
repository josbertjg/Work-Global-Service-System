$(document).ready(async ()=>{
  const servicios = await service.post("misServicios",{getAllServicios:true});
  const serviciosFumigador = await service.post("misServicios",{getAllServiciosFumigador:true});
  mostrarBotonesServicio(servicios,serviciosFumigador);

  $(document).on("click",".btn-servicio",(e)=>{
    const idServicioToSend = $(e.currentTarget).attr("idServicio");
    let habilitado = null;

    try{
      habilitado = JSON.parse($(e.currentTarget).attr("habilitado"));
    }catch(error){
      Toast.fire({
        icon: "error",
        title: "Error al recuperar los datos a enviar."
      });
    }

    const texto = habilitado ? 
        "Al dar click en Deshabilitar dicho servicio desaparecerá de tu portafolio de servicios a ofrecer y los clientes no podrán realizarte mas solicitudes sobre este servicio."
      :
        "Al dar click en Habilitar este servicio formará parte de tu portafolio de servicios a ofrecer y los clientes podrán solicitarte la ejecución de este servicio.";
    Swal.fire({
      icon: "warning",
      title: "¿Estas seguro?",
      text: texto,
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: habilitado ? "Deshabilitar" : "Habilitar",
      confirmButtonColor: "#157347",
      denyButtonText: `Cancelar`
    }).then(async (result) => {
      if (result.isConfirmed) {
        const request = habilitado ? {deleteFumigadorService: true} : {createFumigadorService: true}
        const respuesta = await service.post("misServicios",{...request, idServicio: idServicioToSend});
        if("error" in respuesta){
          Toast.fire({
            icon: "error",
            title: respuesta.error
          });
        }else if("success" in respuesta){
          if(habilitado){
            $(e.currentTarget).removeClass("btn-success");
            $(e.currentTarget).addClass("btn-danger");
          }else{
            $(e.currentTarget).removeClass("btn-danger");
            $(e.currentTarget).addClass("btn-success");
          }
          $(e.currentTarget).attr("habilitado",!habilitado)
          Toast.fire({
            icon: "success",
            title: respuesta.success
          });
        }
      }
    });
  })
})

function mostrarBotonesServicio(servicios,fumigadorServicios){
  _.map(servicios,(item)=>{
    const habilitado = !_.isEmpty(_.find(fumigadorServicios,(fumigServ)=>(fumigServ.idServicio == item.idServicio)))
    $(".container-botones-servicios").append(`
      <div class="mb-3 col-md-6 d-flex">
        <button class="w-100 btn btn-${habilitado ? "success" : "danger" }  btn-block py-3 btn-servicio fw-bold" idServicio="${item.idServicio}" habilitado="${!!habilitado}">${item.nombre}</button>
      </div>
    `)
  })
}