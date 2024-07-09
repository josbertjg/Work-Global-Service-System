$(document).ready(async ()=>{
    let user = null;
    try{
        user = JSON.parse(localStorage.getItem("user"));
        if(user.idRol==="CLWGS1"){
            const getOrdenes = await service.post("Mis-Ordenes",{getOrdenesByClient:true,ID:user.ClientID});
            CreateList(getOrdenes);
        }else{
            const getOrdenes = await service.post("Mis-Ordenes",{getOrdenesFumi:true,ID:user.ClientID});
            CreateList(getOrdenes);
        }
        
    }catch(e){
        showAlert("error", "Oops, ocurrió un error", "Error al recuperar el usuario logueado")
        //return setTimeout(() => window.location = "", 4000);
    }

    $(document).on('click', '.btnDetails', async function() {
        const orderId = $(this).data('id');
        // Show the modal with the order information
        // You can use the orderId to retrieve the order information from your database or API
        console.log(`Showing modal for order ${orderId}`);
    });
    
});
function CreateList(ordenes){
    ordenes.forEach(e => {
        const [dia,horaO]=e.fechaServicio.split(" ");
        let fechaT=fecha(dia);
        let horat=hora(horaO);
        let label=statusOrder[e.status];
        const list=`           <li id="orden-${e.idOrden}" class="list-group-item">
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
          <button type="button" class="btn btn-primary btnDetails" data-id="${e.idOrden}"><i class="fa-solid fa-info"></i></button>
          </div>
        </div>
      </li>`;
      $(".list-group").append(list);
    });
}
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