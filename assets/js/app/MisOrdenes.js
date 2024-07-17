$(document).ready(async ()=>{
    let user = getUser();
    if(!_.isUndefined(user)){
      const getOrdenes= await service.post("Mis-Ordenes",{opcion:user.clientID});
      var columnas= [
        {"data":"idOrdenes"},
        {"data":"fechaServicio",
        "render":function(data,type,row){
          var [dia,horaO]=data.split(" ");
            let fechaT=fecha(dia);
            return fechaT;
        }},
        {"data":"fechaServicio",
        "render":function(data,type,row){
          var [dia,horaO]=data.split(" ");
            let horat=hora(horaO);
            return horat;
        }},
        {"data":"status",
          "render":function(data,type,row){
            return statusOrder[data];
          }},
          {"data": null,
          "render": function(data, type, row) {
            if (user.idRol === "CLWGS1") {
              return '<button class="btn btn-info btnDetails" title="Detalles"><i class="fa-solid fa-circle-info"></i></button>';
            } else if (user.idRol === "FGWGS1" && data.status === "Enviada") {
              return `
                <button class="btn btn-success btnAcept" title="Aceptar"
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Aceptar Orden"
                ><i class="fa-solid fa-check"></i></button>
                <button class="btn btn-danger btnDecline" title="Rechazar"
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Rechazar la Orden"
                ><i class="fa-solid fa-x"></i></button>
                <button class="btn btn-info btnDetails" title="Detalles"
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Ver detalles de la Orden"
                ><i class="fa-solid fa-circle-info"></i></button>
              `;
            }else if(user.idRol === "FGWGS1" && data.status === "Agendada"){
              return `
                <button class="btn btn-success btnComp" title="Finalizar"
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Finalizar Orden"
                ><i class="fa-solid fa-check"></i></button>
                <button class="btn btn-danger btnDecline" title="Cancelar"
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Cancelar la Orden"
                ><i class="fa-solid fa-x"></i></button>
                <button class="btn btn-info btnDetails" title="Detalles"
                  data-bs-toggle="tooltip" 
                  data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip-dark"
                  data-bs-title="Ver detalles de la Orden"
                ><i class="fa-solid fa-circle-info"></i></button>
                <button 
                  class="btn btn-warning btnSobrecargo p-1" 
                  title="Añadir Sobrecargo"
                  data-bs-toggle="modal" 
                  data-bs-target="#add-sobrecargo" 
                  idOrden="${data.idOrdenes}"
                >
                  <i 
                    class="fa-solid fa-plus p-2"
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip-dark"
                    data-bs-title="Añadir un sobrecargo a la Orden"
                  ></i>
                </button>
              `;
            } else if(user.idRol==="FGWGS1" && data.status==="Finalizada"){
              return `
              <button class="btn btn-info btnDetails" title="Detalles"
                data-bs-toggle="tooltip" 
                data-bs-placement="top"
                data-bs-custom-class="custom-tooltip-dark"
                data-bs-title="Ver detalles de la Orden"
              ><i class="fa-solid fa-circle-info"></i></button>
            `;
            }
             else {
              return `<button class="btn btn-info btnDetails" title="Detalles"
                data-bs-toggle="tooltip" 
                data-bs-placement="top"
                data-bs-custom-class="custom-tooltip-dark"
                data-bs-title="Ver detalles de la Orden"
              ><i class="fa-solid fa-circle-info"></i></button>`; // or some default value
            }
          }
        }
      ]
      TablaOrdenes=iniciarTabla(columnas,"Mis-Ordenes",user.clientID);
    }
    $('#TableData').on('click', '.btnAcept,.btnDecline,.btnComp', async function() {
      var tr = $(this).closest('tr');
      var table = $('#TableData').DataTable();
      var row = table.row(tr);
      var data = row.data();
      var mensaje;
      var buttonClass;
      var statu = $(this).hasClass('btnComp') ? 'finalizar' : 'cancelar';
      if(data.status==="Enviada"){
        var buttonClass = $(this).hasClass('btnAcept') ? 'agendar' : 'cancelar';
        mensaje=buttonClass;}
      else{mensaje=statu}
      swal.fire({
        title: 'Confirmación',
        text: `¿Estás seguro de ${mensaje} esta orden?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: `Sí, ${mensaje} esta orden`,
        cancelButtonText: 'No, cancelar accion'
      }).then(async (result) => {
        if (result.isConfirmed) {
          const respuesta = await service.post("Mis-Ordenes", {updateOrdenFumi: true, newStatus: mensaje, idOrden: data.idOrdenes, IdF: user.clientID,fechaServicio: data.fechaServicio.split(" ").shift()});
          if ("error" in respuesta) {
            swal.fire({
              title: "Error",
              text: respuesta[0].error,
              icon: "error"
            });
          } else {
            TablaOrdenes.ajax.reload(null, false);
            Swal.fire({
              title: "Exito!",
              text: "se ha ingresado la entrada con exito!",
              icon: "success"
            });
          }
        }
      });
    });

    $('#TableData').on( 'init.dt', function ( e, settings ) {
      initTooltips();
    } );

    $(document).on('click', '.btnDetails', async function() {
      var tr = $(this).closest('tr');
      var table = $('#TableData').DataTable();
      var row = table.row(tr);
      var data = row.data();
        const orderId = data.idOrdenes;
        let google=$('#gclient-key').val();
        // Show the modal with the order information
        // You can use the orderId to retrieve the order information from your database or API
        const serviciosOrden = await service.post("Mis-Ordenes",{getPrecioServicio:true,idOrden:orderId});
        const fumigdorOrden = await service.post("Mis-Ordenes",{getFumigadorServicio:true,idOrden:orderId});
        const factura = await service.post("Mis-Ordenes",{getFacturaInfo:true, idOrden:orderId});
        const direction1=await service.post("Mis-Ordenes",{getDireccion:true,idDir:orderId});
        let fumigador=fumigdorOrden[0];
        let direction=direction1[0];
        $('#modalHead').html(`<h1 class="modal-title fs-5" id="ordenDetailsModalLabel"> Detalles de mi orden ${orderId} <i class="fa-solid fa-clipboard-list"></i>
        </h1> <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>`);
        $("#ordenDetailsAccordion").html("");
    
        serviciosOrden.forEach(e =>{
            $("#ordenDetailsAccordion").append(`
            <div class="accordion-item details-item-${e.id}">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item-${e.id}" aria-expanded="false" aria-controls="item-${e.id}">
                  <div class="servicio-icons">
                    <img 
                      src="${e.IconoE}" 
                      alt="establecimiento"
                      data-bs-toggle="tooltip" 
                      data-bs-placement="top"
                      data-bs-custom-class="custom-tooltip-primary"
                      data-bs-title="sin definir"
                    />
                    <i class="fa-solid fa-plus mx-3"></i>
                    <img 
                      src="${e.fotoServicio}" 
                      alt="plaga"
                      data-bs-toggle="tooltip" 
                      data-bs-placement="top"
                      data-bs-custom-class="custom-tooltip-primary"
                      data-bs-title="${e.nombre}"
                    />
                  </div>
                  <div class="servicio-actions">
                    <span class="monto">${e.precio}$</span>
                  </div>
                </button>
              </h2>
              <div id="item-${e.id}" class="accordion-collapse collapse" data-bs-parent="#ordenDetailsAccordion">
                <div class="accordion-body">
                  <strong>Fumigación de ${e.nombre} en ${e.Establecimiento}:</strong> se exterminará la plaga <b>${e.nombre}</b> en el tipo de establecimiento <b>${e.Establecimiento}</b>, por un costo de <b>${e.precio}$</b>
                </div>
              </div>
            </div>
            <hr class="m-0 p-0"/>
          `);
        });
        $("#ordenDetailsAccordion").append(`
        <div class="accordion-item details-item-detalles">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item-detalles" aria-expanded="false" aria-controls="item-detalles">
              <div class="servicio-icons">
              <i class="fa-solid fa-clipboard-list"></i>Detalles
              </div>
              <div class="servicio-actions">
                <i class="fa-solid fa-circle-info"></i>
              </div>
            </button>
          </h2>
          <div id="item-detalles" class="accordion-collapse collapse" data-bs-parent="#ordenDetailsAccordion">
            <div class="accordion-body">
              <div class="row">
                <div class="col-6">
                    <label for="Fumigador" class="form-label">Fumigador</label>
                </div>
                <div class="col-6">
                  <span class="Fumigador">
                    ${fumigador.fumigador}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label for="direccion class="form-label">Direccion</label>
                </div>
                <div class="col-6">
                  <span class="direccion">
                  ${direction.direccion}
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <iframe width="100%" height="100%" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=${google}&q=${direction.latitud},${direction.longitud}" allowfullscreen>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="m-0 p-0"/>
      `);
      $(".orden-details-monto-total .monto").text(`${factura.factura.precioFinal}$`)
      $('#ordenDetailsModal').modal("show");

    });
    
    let idOrden = null;
    $(document).on("click", ".btnSobrecargo", (e)=>{
      idOrden = $(e.currentTarget).attr("idOrden");
    });

    $(".add-sobrecargo-submit").click(()=> $("#add-sobrecargo-form").trigger("submit"));

  /* Formulario */
  validarNumeros($("#addSobrecargoPrecio"),true,3);
  $("#addSobrecargoPrecio").keydown((e)=>soloNumeros(e))
  validarDescripcion($("#addSobrecargoDescripcion"));

  $("#add-sobrecargo-form").on("submit",async (event)=>{
    event.preventDefault();
    const form = $("#add-sobrecargo-form");

    const formValid = checkFormValidity(form)
    
    if(formValid){
      
      const formHTML = document.getElementById("add-sobrecargo-form")
      const data = new FormData(formHTML)
          
      toggleLoading(true)
      
      data.append("addSobrecargo",JSON.stringify(true))
      data.append("idOrden",idOrden)

      const respuesta = await service.post("Mis-Ordenes",data)    
      toggleLoading(false)

      if("error" in respuesta){
        showFormAlerts(form,respuesta.error);
        blankForm(form);
      }else if("success" in respuesta){
        document.getElementById("close-sobrecargo-modal").click();
        Toast.fire({icon: "success", title: respuesta.success});
      }
    }
  })
});
function CreateList(ordenes){
    ordenes.forEach(e => {
        const [dia,horaO]=e.fechaServicio.split(" ");
        let fechaT=fecha(dia);
        let horat=hora(horaO);
        let label=statusOrder[e.status];
        const list=`           <li id="orden-${e.idOrdenes}" class="list-group-item">
        <div class="row justify-content-center">
          <div class="col-md-2 text-center">
            <P><i class="fa-solid fa-calendar-days"></i>Dia:${fechaT}</P>
          </div>
          <div class="col-md-2 text-center">
            <p><i class="fa-regular fa-clock"></i>Hora:${horat}</p>
          </div>
          <div class="col-md-2 text-center">
          ${label}
          </div>
          <div class="col-md-2 text-center">
          <button type="button" class="btn btn-primary btnDetails" data-id="${e.idOrdenes}"><i class="fa-solid fa-info"></i></button>
          </div>
        </div>
      </li>`;
      $(".list-group").append(list);
    });
}
const emtpyList='<span class="no-available-services text-center">No tienes servicios agendados<i class="fa-regular fa-face-sad-cry"></i>, Tus citas agendadas apareceran aqui.</span>';
const statusOrder = {
  Enviada: '<label class="btn btn-primary">Enviada</label>',
  Cancelada: '<label class="btn btn-danger">Cancelada</label>',
  Agendada: '<label class="btn btn-warning">Agendada</label>',
  Finalizada: '<label class="btn btn-success">Finalizada</label>'
}

function hora(data){
    const [hours, minutes, seconds] = data.split(':');
    // Convierte las horas a formato 12 horas con AM/PM
    let formattedHours = (parseInt(hours) % 12).toString();
    formattedHours = formattedHours === '0' ? '12' : formattedHours; // Ajuste para 12:00:00
    const formattedTime = `${formattedHours.padStart(2, '0')}:${minutes} ${hours >= 12 ? 'PM' : 'AM'}`;
    return formattedTime;
}

function fecha(data){
    const [year, month, day] = data.split('-');
    // Formatea la fecha en el formato deseado (por ejemplo, "DD-MM-YY")
    const formattedDate = `${day}-${month}-${year.slice(-2)}`;
    return formattedDate;
}

function getUser(){
    try{
     let   user = JSON.parse(localStorage.getItem("user"));
     return user;
    }catch(e){
        showAlert("error", "Oops, ocurrió un error", "Error al recuperar el usuario logueado")
        //return setTimeout(() => window.location = "", 4000);
    }
}
/* // Get the list group element
const listGroup = document.querySelector('.list-group');

// Create a new list group item
const newListItem = document.createElement('a');
newListItem.className = 'list-group-item list-group-item-action';
newListItem.textContent = 'New Item';

// Create a button to show a modal
const button = document.createElement('button');
button.type = 'button';
button.className = 'btn btn-primary btn-sm float-right';
button.dataset.toggle = 'modal';
button.dataset.target = '#newModal';
button.textContent = 'Show Modal';

// Add the button to the list group item
newListItem.appendChild(button);

// Add the list group item to the list group
listGroup.appendChild(newListItem); */