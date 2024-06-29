$(document).ready(async ()=>{
    var columnas = [
        {"data":"NroOrden"},
        {"data":"Cliente"},
        {"data":"Email"},
        {"data":"Dia",
         "render":function(data,type,row){
            var fechaT=fecha(data);
            return fechaT;
         }},
        {"data":"Hora",
         "render":function(data,type,row){
           var horat= hora(data);
           return horat;
         }},
         {"data":"Ubicacion"},
        {"data":"Estado"},
        {"defaultContent":"<div class='text-center'><button class='btn btn-primary btn-sm btnDetalles'><i class='fa-solid fa-info'></i></button></div>"}   
    ]
    let datos=2;
    TablaOrdenes=iniciarTabla(columnas,'ordenes',datos);
    //const getOrdenes = service.post('ordenes',{opcion:2});
    //console.log(getOrdenes);
    //funcion para editar un row con el boton editar
    $(document).on("click", ".btnDetalles", async function(){		        
        var tr = $(this).closest('tr');
        var table = $('#TableData').DataTable();
        var row = table.row(tr);
        var data = row.data(); // Obtiene todos los datos de la fila
        console.log(data);
        const serviciosOrden = await service.post("ordenes",{getPrecioServicio:true,idOrden:data.NroOrden});
        console.log(serviciosOrden);
        $('#contenidoModal').empty();
        console.log(data.Establecimiento);
        var body=`
        <div class="modal-body">
            <table class="table table-borderless">
              <thead>
                <th scope="col"></th>
                <th scope="col"></th>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Nro Orden</th>
                  <td>${data.NroOrden}</td>
                </tr>
                <tr>
                  <th scope="row">Cliente</th>
                  <td>${data.Cliente}</td>
                </tr>
                <tr>
                  <th scope="row">Fecha y Hora</th>
                  <td>${fecha(data.Dia)} ${hora(data.Hora)}</td>
                </tr>
                <tr>
                  <th scope="row">Ubicacion</th>
                  <td>${data.Ubicacion}</td>
                </tr>
                <tr>
                  <th scope="row">Establecimiento</th>
                  <td>${data.Establecimiento}</td>
                </tr>
                <tr>
                  <th scope="row">fumigador asignado</th>
                  <td>xxxxxx</td>
                </tr>
                <tr>
                  <th scope="row">----------</th>
                  <td>-----------</td>
                </tr>
                <tr>
                  <th scope="row">Servicios</th>
                </tr>
                `;
                var servicios=`
                <tr>
                  <th scope="row">Curacachas</th>
                  <td>$45</td>
                </tr>
                <tr>
                  <th scope="row">Cien Pies</th>
                  <td>$50</td>
                </tr>`;
          var bodyend=`</tbody></table></div>`;
          var precioFinal=0
          serviciosOrden.forEach(element => {
            body=body+`
            <tr>
              <th scope="row">${element.nombre}</th>
              <td>$ ${element.precio}</td>
            </tr>`;
            precioFinal+=element.precio;
        });
        body+=`
        <tr>
          <th scope="row">Total</th>
          <td>$ ${precioFinal}</td>
        </tr>`
        body+=bodyend;
        $('#contenidoModal').append(`<div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>`);
      $(".modal-header").css("background-color", "#d32535");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Orden"+" "+data.NroOrden);	
        $('#contenidoModal').append(body);	
        $('#contenidoModal').append(`<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>`)
        $('#modalCRUD').modal('show');		   
    });
})

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
