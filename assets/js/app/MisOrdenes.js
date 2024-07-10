$(document).ready(async ()=>{
    let user = getUser();
    if(!_.isUndefined(user)){
        if(user.idRol=="CLWGS1"){
            //console.log(user.clientID);
            const getOrdenes = await service.post("Mis-Ordenes",{getOrdenesByClient:true,ID:user.clientID});
            if(_.isEmpty(getOrdenes)){$(".list-group").html(emtpyList); console.log("No hay ordenes")}
            else{CreateList(getOrdenes);}
        }else{
            const getOrdenes = await service.post("Mis-Ordenes",{getOrdenesFumi:true,ID:user.ClientID});
            if(_.isEmpty(getOrdenes)){$(".list-group").html(emtpyList);}
            else{CreateList(getOrdenes);}
        }
    }
    $(document).on('click', '.btnDetails', async function() {
        const orderId = $(this).data('id');
        // Show the modal with the order information
        // You can use the orderId to retrieve the order information from your database or API
        const serviciosOrden = await service.post("Mis-Ordenes",{getPrecioServicio:true,idOrden:orderId});
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
        })
        $(".orden-details-monto-total .monto").text(`${_.sum(_.map(serviciosOrden,(item)=>(parseFloat(item.precio))))}$`)
        $('#ordenDetailsModal').modal("show");

    });
    
});
function CreateList(ordenes){
    ordenes.forEach(e => {
        console.log(e);
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
const statusOrder ={
    Enviada:'<label class="btn btn-danger">Cancelada</label>',
    Cancelada:'<label class="btn btn-danger">Cancelada</label>',
    Agendada:'<label class="btn btn-danger">Cancelada</label>',
    Finalizada:'<label class="btn btn-danger">Cancelada</label>'
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